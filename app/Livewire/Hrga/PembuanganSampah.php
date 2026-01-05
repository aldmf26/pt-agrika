<?php

namespace App\Livewire\Hrga;

use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;


class PembuanganSampah extends Component
{
    use WithAlert;
    public $selectedBulan;
    public $selectedJenisLimbah;
    public $daysInMonth = 31;
    public $bulans;
    public $lokasis;
    public $itemSanitasi;
    public $items = [];
    public $pilihanLimbah;
    public $tbl = 'pembuangan_sampahs';
    public $jenisLimbah = [
        'bulu',
        'organik',
        'non organik'
    ];

    public $jamList = [
        ['time' => '05:00:00', 'label' => 'PM'],
    ];

    public $keterangan = [];

    #[Url]
    public $bulan;
    #[Url]
    public $tahun = 2025;
    #[Url]
    public $jenis_limbah;

    public function loadPembuanganSampah($selectedJenisLimbah, $selectedBulan)
    {
        return DB::table($this->tbl)
            ->where('jenis_limbah', $selectedJenisLimbah)
            ->whereMonth('tgl', $selectedBulan)
            ->get();
    }

    public function loadKeterangan()
    {
        $this->keterangan = DB::table($this->tbl)
            ->where('jenis_sampah', $this->pilihanLimbah)
            ->whereMonth('tgl', $this->selectedBulan)
            ->whereYear('tgl', $this->tahun)
            ->pluck('ket', DB::raw("CONCAT(DAY(tgl), '_', jam_cek)"))
            ->toArray();
    }

    public function cekJam($jenisSampah, $jam, $bulan, $hari)
    {
        return DB::table($this->tbl)
            ->where('jenis_sampah', $jenisSampah)
            ->where('jam_cek', $jam)
            ->whereMonth('tgl', $bulan)
            ->whereDay('tgl', $hari)
            ->exists();
    }

    public function mount()
    {
        $this->bulans = DB::table('bulan')->get();
        $this->lokasis = DB::table('lokasi')->get();
        $this->selectedBulan = $this->bulan;
        $this->pilihanLimbah = $this->jenis_limbah;
        $this->loadKeterangan();
    }

    public function updatedSelectedBulan($value)
    {
        if ($value) {
            // Convert month number to number of days
            $this->daysInMonth = Carbon::create(alue)->daysInMonth;
        }
    }
    public function updatedPilihanLimbah($value)
    {
        if ($value) {
            $this->pilihanLimbah = $value;
        }
    }

    public function ceklis($tgl, $waktu)
    {
        $existingData = DB::table($this->tbl)
            ->where('jenis_sampah', $this->pilihanLimbah)
            ->where('tgl', "$this->tahun-$this->selectedBulan-$tgl")
            ->where('jam_cek', $waktu)
            ->first();

        if ($existingData) {
            DB::table($this->tbl)
                ->where('id', $existingData->id)
                ->delete();
            $type = 'error';
            $pesan = 'Data berhasil dihapus!';
        } else {
            DB::table($this->tbl)->insert([
                'jenis_sampah' => $this->pilihanLimbah,
                'tgl' => "$this->tahun-$this->selectedBulan-$tgl",
                'jam_cek' => $waktu,
                'admin' => Auth::user()->name
            ]);
            $type = 'sukses';

            $pesan = 'Data berhasil disimpan';
        }
        $this->updatedSelectedBulan($this->selectedBulan);
        $this->updatedPilihanLimbah($this->pilihanLimbah);
        $this->alert($type, $pesan);
    }

    public function tbhParaf($kolom, $nama, String $tgl, $jam_cek)
    {
        $cek = DB::table($this->tbl)
            ->where('jenis_sampah', $this->pilihanLimbah)
            ->where('jam_cek', $jam_cek)
            ->where('tgl', $tgl);
        if ($cek->first()) {
            $cek->update([
                'admin' => Auth::user()->name,
                $kolom => $nama
            ]);
            $this->alert('sukses', 'Data Berhasil disimpan');
        } else {
            $this->alert('error', 'Data Belum Terceklis!');
        }
    }

    public function saveKeterangan($tanggal, $jam)
    {
        $data = DB::table($this->tbl)
            ->where('jenis_sampah', $this->pilihanLimbah)
            ->where('tgl', "$this->tahun-$this->selectedBulan-$tanggal")
            ->where('jam_cek', $jam)
            ->first();

        if ($data) {
            // Update keterangan jika data sudah ada
            DB::table($this->tbl)
                ->where('id', $data->id)
                ->update([
                    'ket' => $this->keterangan[$tanggal][$jam] ?? ''
                ]);
            // Bersihkan input setelah disimpan
            $this->keterangan[$tanggal][$jam] = $this->keterangan[$tanggal][$jam] ?? '';
            $this->alert('sukses', 'Keterangan berhasil disimpan');
        } else {
            $this->alert('error', 'Data Belum Terceklis!');
        }
    }

    public function render()
    {
        $adminSanitasi = DB::table('admin_sanitasi as a')
            ->join('users as b', 'b.id', '=', 'a.id')
            ->selectRaw('a.id, b.name, a.posisi')
            ->get()
            ->groupBy('posisi');

        $data = [
            'adminSanitasi' => $adminSanitasi
        ];
        return view('livewire.hrga.pembuangan-sampah', $data);
    }
}
