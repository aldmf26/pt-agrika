<?php

namespace App\Livewire\Qc;

use App\Models\PerencanaanSwab;
use Livewire\Component;
use App\Traits\WithAlert;
use App\Models\Notif;
use App\Services\NotifiService;

class PerencaaanSwab extends Component
{
    use WithAlert;
    public $tahun;
    public $form = [];
    public $model = PerencanaanSwab::class;

    public function mount()
    {
        $this->tahun = date('Y');
    }
    public function getField($i, $id)
    {
        $field = 'bulan_' . $i; // Nama kolom di database
        $cek = $this->model::where('id', $id)
            ->where('tahun', $this->tahun)
            ->value($field);
        return $cek;
    }


    public function cekSelesai($nama, $month)
    {
        $cek = Notif::where([
            ['nama', $nama],
            ['month', $month],
            ['year', $this->tahun],
            ['user_id', auth()->user()->id],
            ['is_read', 1]
        ])->first();

        return $cek;
    }
    public function toggleBulan($auditId, $bulan, $jenis_kegiatan)
    {


        $kolomBulan = "bulan_$bulan";
        $audit = $this->model::where('id', $auditId)->where('tahun', $this->tahun)->first();

        if (!$audit) {
            $this->model::create([
                'jenis_kegiatan' => $jenis_kegiatan,

                'tahun' => $this->tahun,
                $kolomBulan => 1,
                'admin' => auth()->user()->name,
            ]);
        } else {
            $audit->$kolomBulan = $audit->$kolomBulan == 1 ? 0 : 1;
            $audit->admin = auth()->user()->name;
            $audit->save();
        }
        NotifiService::create('qa.jadwal_verifikasi.index', 'QC 1.7 Perencanaan Swab', $jenis_kegiatan, $bulan, $this->tahun);
        $this->dispatch('refresh');
    }

    public function add()
    {
        $this->model::create([
            'jenis_kegiatan' => $this->form['jenis_kegiatan'],
            'lokasi' => $this->form['lokasi'],
            'tahun' => $this->tahun,
            'admin' => auth()->user()->name,
        ]);
        $this->reset('form');
        $this->alert('sukses', 'Data Berhasil disimpan');
        $this->dispatch('hideAdd');
    }
    public function updateTahun($tahun)
    {
        $this->tahun = $tahun;
    }
    public function selesai($jenis_kegiatan, $bulan)
    {

        Notif::where('nama', $jenis_kegiatan)->where('month', $bulan)->where('year', $this->tahun)->update(['is_read' => 1]);
        $this->alert('sukses', 'Data Berhasil diselesaikan');
        $this->dispatch('refresh');
    }
    public function cancel($item, $bulan)
    {
        Notif::where('nama', $item)->where('month', $bulan)->where('year', $this->tahun)->update(['is_read' => 0]);
        $this->alert('sukses', 'Data Berhasil diselesaikan');
        $this->dispatch('refresh');
    }


    public function render()
    {
        $data = [
            'datas' => PerencanaanSwab::where('tahun', $this->tahun)->get()
        ];
        return view('livewire.qc.perencaaan-swab', $data);
    }
}
