<?php

namespace App\Livewire\Ia;

use App\Models\Notif;
use App\Models\ProgramAuditInternal as ModelsProgramAuditInternal;
use App\Services\NotifiService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Route;




class ProgramAuditInternal extends Component
{
    public $tahun;
    public $form = [];
    public $model = ModelsProgramAuditInternal::class;

    public function mount()
    {
        $this->tahun = date('Y');
    }

    #[Computed]
    public function getField($i, $id)
    {
        $field = 'bulan_' . $i; // Nama kolom di database
        $cek = $this->model::where('id', $id)
            ->where('tahun', $this->tahun)
            ->value($field);
        return $cek;
    }

    #[Computed]
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
    

    public function toggleBulan($auditId, $bulan, $departemen, $audite, $auditor)
    {
        
        $kolomBulan = "bulan_$bulan";
        $audit = $this->model::where('id', $auditId)->where('tahun', $this->tahun)->first();
        if (!$audit) {
            $this->model::create([
                'departemen' => $departemen,
                'audite' => $audite,
                'auditor' => $auditor,
                'tahun' => $this->tahun,
                $kolomBulan => 1,
                'admin' => auth()->user()->name,
            ]);
        } else {
            $audit->$kolomBulan = $audit->$kolomBulan == 1 ? 0 : 1;
            $audit->admin = auth()->user()->name;
            $audit->save();
        }
        NotifiService::create('ia.1.index','IA 1.1 Program Audit Internal', $departemen, $bulan, $this->tahun);
        $this->dispatch('refresh');

    }

    public function add()
    {
        $this->model::create([
            'departemen' => $this->form['departemen'],
            'audite' => $this->form['audite'],
            'auditor' => $this->form['auditor'],
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

    public function render()
    {
        $data = [
            'datas' => ModelsProgramAuditInternal::where('tahun', $this->tahun)->get()
        ];
        return view('livewire.ia.program-audit-internal', $data);
    }
}
