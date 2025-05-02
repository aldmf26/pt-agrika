<?php

namespace App\Livewire\Qa;

use App\Models\JadwalVerifikasi as ModelsJadwalVerifikasi;
use Livewire\Component;
use App\Models\Notif;
use App\Services\NotifiService;
use App\Traits\WithAlert;

class JadwalVerifikasi extends Component
{
    use WithAlert;
    public $tahun;
    public $form = [];
    public $model = ModelsJadwalVerifikasi::class;

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

    public function toggleBulan($auditId, $bulan, $item, $aktivitas, $frek, $departemen)
    {

        $kolomBulan = "bulan_$bulan";
        $audit = $this->model::where('id', $auditId)->where('tahun', $this->tahun)->first();
        if (!$audit) {
            $this->model::create([
                'item' => $item,
                'aktivitas' => $aktivitas,
                'frek' => $frek,
                'departemen' => $departemen,
                'tahun' => $this->tahun,
                $kolomBulan => 1,
                'admin' => auth()->user()->name,
            ]);
        } else {
            $audit->$kolomBulan = $audit->$kolomBulan == 1 ? 0 : 1;
            $audit->admin = auth()->user()->name;
            $audit->save();
        }
        NotifiService::create('qa.jadwal_verifikasi.index', 'QA 6.1 Jadwal Verifikasi', $item, $bulan, $this->tahun);
        $this->dispatch('refresh');
    }

    public function add()
    {
        $this->model::create([
            'item' => $this->form['item'],
            'aktivitas' => $this->form['aktivitas'],
            'frek' => $this->form['frek'],
            'departemen' => $this->form['departemen'],
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
    public function selesai($item, $bulan)
    {
        Notif::where('nama', $item)->where('month', $bulan)->where('year', $this->tahun)->update(['is_read' => 1]);
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
            'datas' => ModelsJadwalVerifikasi::where('tahun', $this->tahun)->get()
        ];
        return view('livewire.qa.jadwal-verifikasi', $data);
    }
}
