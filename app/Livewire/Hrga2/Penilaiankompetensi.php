<?php

namespace App\Livewire\Hrga2;

use App\Models\SumPenilaianKompetensi;
use App\Models\PenilaianParameter;
use App\Models\CatatanKehadiran;
use App\Models\PenilaianKompetensi as ModelsPenilaianKompetensi;
use App\Models\PenilaianSp;
use App\Models\SuratPeringatan;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Penilaiankompetensi extends Component
{
    use WithAlert;

    public $karyawan;
    public $tahun;
    public $penilaian_id;

    // Data Form
    public $kompetensi = [];
    public $kehadiran = [];
    public $parameter = [];

    // EDIT: Property baru untuk keterangan SP (default "tidak pernah" atau kosong)
    public $spKeterangan = [
        'sp_1' => '',
        'sp_2' => '',
        'sp_3' => ''
    ];

    // EDIT: Property untuk track level SP yang lagi diedit (null = nggak edit)
    public $editingSp = null; // 1, 2, atau 3

    public $totalNilai = 0;
    public $kategoriNilai = '';
    public $rekomendasi = '';
    public $totalParameter = 0;
    public $totalSP = 0;

    public $showSaved = false;

    protected $masterKompetensi = [
        'Menguasai pekerjaan di divisinya',
        'Tidak pernah melakukan kecerobohan dalam pekerjaannya',
        'Telah mendapat training HACCP, GMP, CCP'
    ];

    protected $masterParameter = [
        'Disiplin',
        'Sikap Kerja',
        'Kerjasama',
        'Tanggung Jawab',
        'Kesopanan',
        'Kejujuran',
        'Kerapian',
        'Inisiatif',
        'Pengetahuan',
        'Keahlian',
        'Leadership',
        'Manajerial'
    ];

    protected $keteranganKehadiran = ['Terlambat', 'Sakit', 'Tanpa Keterangan', 'Izin'];

    public function mount($karyawan)
    {
        $this->karyawan = $karyawan;
        $this->tahun = date('Y');

        // Initialize kompetensi
        foreach ($this->masterKompetensi as $komp) {
            $this->kompetensi[$komp] = [
                'aktual' => false,
                'tidak_lanjut' => false
            ];
        }

        // Initialize kehadiran (4 jenis x 12 bulan)
        foreach ($this->keteranganKehadiran as $ket) {
            for ($i = 1; $i <= 12; $i++) {
                $this->kehadiran[$ket][$i] = [
                    'hari' => 0,
                    'jam' => 0
                ];
            }
        }

        // Initialize parameter
        foreach ($this->masterParameter as $param) {
            $this->parameter[$param] = 0;
        }

        // Load data jika sudah ada
        $this->loadData();
    }

    public function loadData()
    {
        if (!$this->karyawan) return;

        $penilaian = SumPenilaianKompetensi::with(['kompetensi', 'kehadiran', 'parameter', 'suratPeringatan'])
            ->where('karyawan_id', $this->karyawan->id) // Cek: Apakah ini match kolom DB? Kalau nggak, ganti ke 'data_pegawai_id' atau sesuai
            ->where('tahun', $this->tahun)
            ->first();


        if ($penilaian) {
            $this->penilaian_id = $penilaian->id;

            // Load kompetensi (EDIT: Tambah log/debug & validasi)
            if ($penilaian->kompetensi && $penilaian->kompetensi->count() > 0) {
                foreach ($penilaian->kompetensi as $komp) {
                    if (isset($this->kompetensi[$komp->kompetensi])) {
                        $this->kompetensi[$komp->kompetensi] = [
                            'aktual' => (bool) $komp->aktual, // Cast ke bool biar checkbox bener
                            'tidak_lanjut' => (bool) $komp->tidak_lanjut
                        ];
                    } else {
                        // Kalau kompetensi baru, init dulu
                        $this->kompetensi[$komp->kompetensi] = [
                            'aktual' => (bool) $komp->aktual,
                            'tidak_lanjut' => (bool) $komp->tidak_lanjut
                        ];
                    }
                }
            } else {
                // DEBUG: Log kalau nggak ada data (cek di storage/logs/laravel.log)
                Log::info('No kompetensi data loaded for karyawan_id: ' . $this->karyawan->id . ', tahun: ' . $this->tahun);
            }

            if ($penilaian->kehadiran && $penilaian->kehadiran->count() > 0) {
                foreach ($penilaian->kehadiran as $hadir) {
                    if (isset($this->kehadiran[$hadir->keterangan][$hadir->bulan])) {
                        $this->kehadiran[$hadir->keterangan][$hadir->bulan] = [
                            'hari' => (int) $hadir->hari, // Cast ke int
                            'jam' => (int) $hadir->jam
                        ];
                    } else {
                        // Init kalau belum ada
                        $this->kehadiran[$hadir->keterangan][$hadir->bulan] = [
                            'hari' => (int) $hadir->hari,
                            'jam' => (int) $hadir->jam
                        ];
                    }
                }
            } else {
                Log::info('No kehadiran data loaded for karyawan_id: ' . $this->karyawan->id);
            }

            // Load parameter
            foreach ($penilaian->parameter as $param) {
                if (isset($this->parameter[$param->parameter])) {
                    $this->parameter[$param->parameter] = $param->nilai;
                }
            }

            // Load SP (EDIT: Hapus load $sp, fokus alasan & hitung total SP dari alasan)
            if ($penilaian->suratPeringatan) {
                // EDIT: Parse keterangan seperti sebelumnya
                $keteranganDb = $penilaian->suratPeringatan->keterangan ?? '';
                $keterangans = array_map('trim', explode('; ', $keteranganDb));
                $this->spKeterangan = [
                    'sp_1' => $keterangans[0] ?? '',
                    'sp_2' => $keterangans[1] ?? '',
                    'sp_3' => $keterangans[2] ?? ''
                ];

                // EDIT: Hitung total SP dari alasan yang diisi (seperti hitungTotal)
                $this->totalSP = 0;
                if (trim($this->spKeterangan['sp_1']) !== '') $this->totalSP += 10;
                if (trim($this->spKeterangan['sp_2']) !== '') $this->totalSP += 20;
                if (trim($this->spKeterangan['sp_3']) !== '') $this->totalSP += 40;
            }

            // Load parameter (EDIT: Tambah validasi & cast)
            if ($penilaian->parameter && $penilaian->parameter->count() > 0) {
                foreach ($penilaian->parameter as $param) {
                    if (isset($this->parameter[$param->parameter])) {
                        $this->parameter[$param->parameter] = (int) $param->nilai; // Cast ke int
                    }
                }
            } else {
                Log::info('No parameter data loaded for karyawan_id: ' . $this->karyawan->id);
            }

            $this->hitungTotal();
        } else {
            // DEBUG: Log kalau nggak ada penilaian sama sekali
            Log::info('No penilaian found for karyawan_id: ' . $this->karyawan->id . ', tahun: ' . $this->tahun);
        }
    }

    public function hitungTotal()
    {
        // Hitung total parameter
        $this->totalParameter = array_sum($this->parameter);
        $totalParameter = count($this->parameter);

        // Hitung total SP
        $this->totalSP = 0;
        if (trim($this->spKeterangan['sp_1']) !== '') $this->totalSP += 10;
        if (trim($this->spKeterangan['sp_2']) !== '') $this->totalSP += 20;
        if (trim($this->spKeterangan['sp_3']) !== '') $this->totalSP += 40;

        // Nilai akhir
        $this->totalNilai = ($this->totalParameter - $this->totalSP) / $totalParameter;

        // Kategori
        if ($this->totalNilai >= 86 && $this->totalNilai <= 100) {
            $this->kategoriNilai = 'Baik Sekali';
        } elseif ($this->totalNilai >= 70 && $this->totalNilai <= 85) {
            $this->kategoriNilai = 'Baik';
        } elseif ($this->totalNilai >= 60 && $this->totalNilai <= 69) {
            $this->kategoriNilai = 'Cukup';
        } else {
            $this->kategoriNilai = 'Kurang';
        }

        // Rekomendasi
        $this->generateRekomendasi();
    }

    public function generateRekomendasi()
    {
        $rekomendasi = [
            'Baik Sekali' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan.',
            'Baik' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan.',
            'Cukup' => 'Ybs dinilai catap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak / kerjasama dengan perusahaan. Dipertimbangkan untuk mendapatkan kontrak yang panjang',
            'Kurang' => 'Performa kurang memuaskan. Perlu evaluasi lebih lanjut dan perbaikan.'
        ];

        $this->rekomendasi = $rekomendasi[$this->kategoriNilai] ?? '';
    }

    public function getTotalKehadiranHari($keterangan = null)
    {
        $total = 0;

        if ($keterangan) {
            foreach ($this->kehadiran[$keterangan] as $data) {
                $total += $data['hari'];
            }
        } else {
            foreach ($this->kehadiran as $ket => $bulanData) {
                foreach ($bulanData as $data) {
                    $total += $data['hari'];
                }
            }
        }

        return $total;
    }

    public function getTotalKehadiranJam($keterangan = null)
    {
        $total = 0;

        if ($keterangan) {
            foreach ($this->kehadiran[$keterangan] as $data) {
                $total += $data['jam'];
            }
        } else {
            foreach ($this->kehadiran as $ket => $bulanData) {
                foreach ($bulanData as $data) {
                    $total += $data['jam'];
                }
            }
        }

        return $total;
    }

    // EDIT: Update hook updated untuk deteksi checkbox kompetensi
    public function updated($propertyName)
    {
        // Auto hitung saat ada perubahan (tetap untuk parameter/SP)
        if (str_starts_with($propertyName, 'parameter.') || str_starts_with($propertyName, 'sp.')) {
            $this->hitungTotal();
        }

        // Tambahan baru: Auto-save khusus kompetensi saat checkbox berubah
        if (str_starts_with($propertyName, 'kompetensi.')) {
            $this->autoSaveKompetensi();
        }

        // Tambahan baru: Deteksi perubahan kehadiran
        if (str_starts_with($propertyName, 'kehadiran.')) {
            // EDIT: Kalau hari berubah, hitung jam otomatis = hari * 8
            if (str_ends_with($propertyName, '.hari')) {
                // Parse nama property buat update jam (contoh: kehadiran.Terlambat.1.hari → kehadiran.Terlambat.1.jam)
                $parts = explode('.', $propertyName);

                // EDIT: Validasi parts (minimal 4 elemen: kehadiran.ket.bulan.hari)
                if (count($parts) >= 4) {
                    $ket = $parts[1]; // Keterangan (e.g., Terlambat)
                    $bulan = (int) $parts[2]; // Bulan (e.g., 1) - FIX: Index 2, bukan 3!

                    // EDIT: Validasi bulan 1-12
                    if ($bulan >= 1 && $bulan <= 12 && isset($this->kehadiran[$ket][$bulan])) {
                        $hariValue = $this->kehadiran[$ket][$bulan]['hari']; // Nilai hari baru
                        $this->kehadiran[$ket][$bulan]['jam'] = $hariValue * 8; // Otomatis jam = hari * 8
                    }
                }
            }
            // Auto-save kehadiran
            $this->autoSaveKehadiran();
        }

        // Di dalam updated(), tambah setelah if (str_starts_with($propertyName, 'sp.')):
        if (str_starts_with($propertyName, 'sp.sp_')) { // sp.sp_1, sp.sp_2, dll.
            $this->hitungTotal();
            $this->autoSaveSp(); // Auto-save SP saat nilai berubah
        }

        // Tambahan baru: Auto-save parameter saat nilai berubah
        if (str_starts_with($propertyName, 'parameter.')) {
            $this->autoSaveParameter();
        }

        // Tambahan baru: Auto-save SP saat jumlah berubah (sudah ada autoSaveSp() dari sebelumnya)
        if (str_starts_with($propertyName, 'sp.sp_')) {
            $this->autoSaveSp();
        }
    }

    // EDIT: Method baru - auto-save khusus kompetensi saat checkbox berubah
    public function autoSaveKompetensi()
    {
        if (!$this->karyawan) {
            $this->alert('error', 'Karyawan tidak ditemukan');
            return;
        }

        // Hitung total dulu (meski kompetensi nggak pengaruh langsung, biar konsisten)
        $this->hitungTotal();

        // Create or update penilaian utama (status 'draft' untuk auto-save)
        $penilaian = SumPenilaianKompetensi::updateOrCreate(
            [
                'karyawan_id' => $this->karyawan->id,
                'tahun' => $this->tahun
            ],
            [
                'nama_karyawan' => $this->karyawan->nama,
                'departemen' => $this->karyawan->departemen ?? $this->karyawan->divisi->divisi,
                'total_nilai' => $this->totalNilai,
                'kategori_nilai' => $this->kategoriNilai,
                'rekomendasi' => $this->rekomendasi,
                'status' => 'draft', // Auto-save sebagai draft
                'penilai' => auth()->user()->name ?? null,
                'tanggal_penilaian' => now()
            ]
        );

        // Save/update kompetensi saja (delete lama, insert baru)
        ModelsPenilaianKompetensi::where('penilaian_id', $penilaian->id)->delete();
        foreach ($this->kompetensi as $nama => $data) {
            ModelsPenilaianKompetensi::create([
                'penilaian_id' => $penilaian->id,
                'kompetensi' => $nama,
                'aktual' => $data['aktual'],
                'tidak_lanjut' => $data['tidak_lanjut']
            ]);
        }

        $this->penilaian_id = $penilaian->id;

        // Trigger notif (bind ke view, misal alert atau toast)
        $this->showSaved = true;
        $this->alert('sukses', 'Kompetensi tersimpan otomatis!');
    }

    // EDIT: Method baru - auto-save khusus kehadiran saat input berubah
    public function autoSaveKehadiran()
    {
        if (!$this->karyawan) {
            $this->alert('error', 'Karyawan tidak ditemukan');
            return;
        }

        // Hitung total dulu (biar konsisten)
        $this->hitungTotal();

        // Create or update penilaian utama (status 'draft' untuk auto-save, kalau belum ada)
        $penilaian = SumPenilaianKompetensi::firstOrCreate( // Gunakan firstOrCreate biar aman kalau belum ada
            [
                'karyawan_id' => $this->karyawan->id,
                'tahun' => $this->tahun
            ],
            [
                'nama_karyawan' => $this->karyawan->nama,
                'departemen' => $this->karyawan->departemen ?? $this->karyawan->divisi,
                'total_nilai' => $this->totalNilai,
                'kategori_nilai' => $this->kategoriNilai,
                'rekomendasi' => $this->rekomendasi,
                'status' => 'draft',
                'penilai' => auth()->user()->name ?? null,
                'tanggal_penilaian' => now()
            ]
        );

        // EDIT: Validasi parent ada
        if (!$penilaian->exists) {
            $this->alert('error', 'Gagal membuat penilaian utama. Coba lagi!');
            return;
        }

        // Save/update kehadiran saja (delete lama, insert baru yang >0)
        CatatanKehadiran::where('penilaian_id', $penilaian->id)->delete();
        foreach ($this->kehadiran as $keterangan => $bulanData) {
            foreach ($bulanData as $bulan => $data) {
                if ($data['hari'] > 0 || $data['jam'] > 0) { // Hanya simpan yang ada nilai
                    CatatanKehadiran::create([
                        'penilaian_id' => $penilaian->id,
                        'keterangan' => $keterangan,
                        'bulan' => $bulan,
                        'hari' => $data['hari'],
                        'jam' => $data['jam']
                    ]);
                }
            }
        }

        $this->penilaian_id = $penilaian->id;

        // Trigger notif (sama seperti kompetensi)
        $this->showSaved = true;
        $this->alert('sukses', 'Kehadiran tersimpan otomatis!');
    }

    public function autoSaveSp()
    {
        if (!$this->karyawan) {
            $this->alert('error', 'Karyawan tidak ditemukan');
            return;
        }

        // Hitung total dulu
        $this->hitungTotal();
        // Gabung keterangan
        $keteranganGabung = implode('; ', array_filter($this->spKeterangan));
        // Save/update SP saja
        PenilaianSp::updateOrCreate(
            ['penilaian_id' => $this->penilaian_id],
            [
                'total_sp' => $this->totalSP,
                'keterangan' => implode('; ', $this->spKeterangan) // Contoh format: "SP1: ..., SP2: ..., SP3: ..."
            ]
        );

        // Trigger notif
        $this->showSaved = true;
        $this->alert('sukses', 'Surat Peringatan tersimpan otomatis!');
    }

    // EDIT: Method baru - auto-save khusus parameter saat input nilai berubah
    public function autoSaveParameter()
    {
        if (!$this->karyawan || !$this->penilaian_id) {
            return;
        }

        $this->hitungTotal(); // Update total parameter

        // Delete lama, insert baru
        PenilaianParameter::where('penilaian_id', $this->penilaian_id)->delete();
        foreach ($this->parameter as $nama => $nilai) {
            PenilaianParameter::create([
                'penilaian_id' => $this->penilaian_id,
                'parameter' => $nama,
                'nilai' => $nilai
            ]);
        }

        $this->showSaved = true;
        $this->alert('sukses', 'Parameter penilaian tersimpan otomatis!');
    }

    public function toggleEditSp($level)
    {
        if ($this->editingSp === $level) {
            $this->editingSp = null; // Cancel edit
        } else {
            $this->editingSp = $level; // Mulai edit
        }
    }

    public function saveSpKeterangan($level)
    {
        $this->editingSp = null; // Tutup edit mode

        // Auto-save seluruh SP (termasuk keterangan) ke DB
        $this->autoSaveSp(); // Panggil method baru di bawah
    }

    public function render()
    {
        return view('livewire.hrga2.penilaiankompetensi', [
            'masterKompetensi' => $this->masterKompetensi,
            'masterParameter' => $this->masterParameter,
            'keteranganKehadiran' => $this->keteranganKehadiran
        ]);
    }
}
