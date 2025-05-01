<?php

namespace App\Livewire;

use App\Livewire\Pur\CreatePo;
use App\Models\HasilChecklist;
use App\Models\Heading;
use App\Models\Notif;
use App\Services\NotifiService;
use App\Traits\WithAlert;
use Livewire\Component;
use Livewire\Attributes\Url;
use Spatie\LivewireWizard\Components\WizardComponent;

class AuditWizard extends Component
{
    use WithAlert;

    #[Url]
    public $bulan;
    #[Url]
    public $tahun;

    #[Url]
    public $departemen;

    public $headings;
    public $hasilChecklist = [];

    public function mount()
    {
        $departementBk = ['bk', 'cabut', 'cetak', 'steamer', 'packing'];
        $departemen = in_array($this->departemen, $departementBk) ? 'bk' : $this->departemen;
        $this->headings = Heading::with('subHeadings.pertanyaan.hasilChecklist')
            ->where('departemen', $departemen)
            ->get();

        foreach ($this->headings as $heading) {
            foreach ($heading->subHeadings as $sub) {
                foreach ($sub->pertanyaan as $pertanyaan) {
                    $hasil = $pertanyaan->hasilChecklist->first();
                    $this->hasilChecklist[$pertanyaan->id] = [
                        'min' => $hasil ? (bool) $hasil->min : false,
                        'maj' => $hasil ? (bool) $hasil->maj : false,
                        'sr' => $hasil ? (bool) $hasil->sr : false,
                        'kt' => $hasil ? (bool) $hasil->kt : false,
                        'ok' => $hasil ? (bool) $hasil->ok : false,
                        'keterangan' => $hasil ? $hasil->keterangan : ''
                    ];
                }
            }
        }
    }

    public function updatedHasilChecklist($value, $key)
    {
        // Parse key, contoh: "1.min" atau "1.keterangan"
        [$pertanyaanId, $field] = explode('.', $key);

        // Ambil atau buat record hasil checklist
        $hasil = HasilChecklist::firstOrNew(['pertanyaan_id' => $pertanyaanId]);

        // Update nilai berdasarkan field
        if ($field === 'keterangan') {
            $hasil->keterangan = $value;
        } else {
            // Checkbox: Set nilai true/false untuk field yang sesuai
            $hasil->min = $field === 'min' ? $value : ($hasil->min ?? false);
            $hasil->maj = $field === 'maj' ? $value : ($hasil->maj ?? false);
            $hasil->sr = $field === 'sr' ? $value : ($hasil->sr ?? false);
            $hasil->kt = $field === 'kt' ? $value : ($hasil->kt ?? false);
            $hasil->ok = $field === 'ok' ? $value : ($hasil->ok ?? false);
        }

        // Set tanggal audit
        $hasil->tanggal_audit = now();

        // Simpan ke database
        $hasil->save();
        $this->alert('sukses', 'Data Berhasil disimpan');
    }

    public function finish()
    {
        NotifiService::create('ia.1.index','IA 1.1 Program Audit Internal', $this->departemen, $this->bulan, $this->tahun);
        NotifiService::readNotification($this->bulan, $this->departemen);
        $this->alert('sukses', 'Audit Selesai');
        $this->dispatch('refresh');
        $this->redirectRoute('ia.1.index', navigate: true);
    }

    public function render()
    {
        $pertanyaan = Heading::with('subHeadings.pertanyaan')->where('departemen', $this->departemen)->get();

        $data = [
            'headings' => $pertanyaan
        ];
        return view('livewire.audit-wizard', $data);
    }
}
