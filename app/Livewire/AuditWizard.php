<?php

namespace App\Livewire;

use App\Livewire\Pur\CreatePo;
use App\Models\HasilChecklist;
use App\Models\Heading;
use App\Models\Notif;
use App\Models\ProgramAuditInternal;
use App\Services\NotifiService;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;
use Spatie\LivewireWizard\Components\WizardComponent;

class AuditWizard extends Component
{
    use WithAlert;

    #[Url]
    public $id, $bulan, $tahun, $departemen;

    public $headings, $namaBulan, $tanggalValue;
    public $hasilChecklist = [];

    public function alert($type, $message)
    {
        $this->dispatch('showAlert', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function mount()
    {
        $this->namaBulan = DB::table('bulan')->where('bulan', $this->bulan)->first()->nm_bulan;
        $this->tanggalValue = ProgramAuditInternal::find($this->id)->created_at->format('d');
        $headings = Heading::groupBy('departemen')->pluck('departemen')->toArray();
        if (!in_array($this->departemen, $headings)) {
            $this->alert('error', 'Departemen tidak cocok', route('ia.1.index'));
            return;
        }

        $this->headings = Heading::with('subHeadings.pertanyaan')
            ->where('departemen', $this->departemen)
            ->get();

        // Load hasil checklist dengan filter berdasarkan bulan dan tahun
        foreach ($this->headings as $heading) {
            foreach ($heading->subHeadings as $sub) {
                foreach ($sub->pertanyaan as $pertanyaan) {
                    // Query hasil checklist dengan filter periode
                    $hasil = HasilChecklist::where('pertanyaan_id', $pertanyaan->id)
                        ->whereYear('tanggal_audit', $this->tahun)
                        ->whereMonth('tanggal_audit', $this->bulan)
                        ->first();
                    // Jika tidak ada hasil untuk periode ini, set default false/empty
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

    public function updatedTanggalValue($value)
    {
        $datas = "{$this->tahun}-{$this->bulan}-{$value}";
        ProgramAuditInternal::find($this->id)->update(['created_at' => $datas]);

        $this->alert('sukses', 'Tanggal Audit Berhasil diubah');
    }
    // Update tanggal audit untuk semua hasil checklist

    public function updatedHasilChecklist($value, $key)
    {
        $tgl = "{$this->tahun}-{$this->bulan}-{$this->tanggalValue}";

        // Parse key, contoh: "1.min" atau "1.keterangan"
        [$pertanyaanId, $field] = explode('.', $key);

        // Cari hasil checklist untuk periode ini (bulan & tahun)
        $hasil = HasilChecklist::where('pertanyaan_id', $pertanyaanId)
            ->whereYear('tanggal_audit', $this->tahun)
            ->whereMonth('tanggal_audit', $this->bulan)
            ->first();

        // Jika tidak ada, buat baru
        if (!$hasil) {
            $hasil = new HasilChecklist();
            $hasil->pertanyaan_id = $pertanyaanId;
            $hasil->tanggal_audit = $tgl;
        }

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

        // Update tanggal audit sesuai dengan periode saat ini
        $hasil->tanggal_audit = $tgl;

        // Simpan ke database
        $hasil->save();
        $this->alert('sukses', 'Data Berhasil disimpan');
    }

    public function finish()
    {
        NotifiService::create('ia.1.index', 'IA 1.1 Program Audit Internal', $this->departemen, $this->bulan, $this->tahun);
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
