<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-2">Form Penilaian Kompetensi Karyawan - Tahun {{ $tahun }}</h4>
                @if ($karyawan)
                    <table style="font-size: 14px;">
                        <tr>
                            <td width="150"><strong>Nama</strong></td>
                            <td>: {{ $karyawan->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>: {{ $karyawan->nik }}</td>
                        </tr>
                        <tr>
                            <td><strong>Divisi</strong></td>
                            <td>: {{ $karyawan->divisi->divisi }}</td>
                        </tr>
                        <tr>
                            <td><strong>Posisi</strong></td>
                            <td>: {{ $karyawan->posisi }}</td>
                        </tr>
                    </table>
                @endif
            </div>
            <div>
                @if ($penilaian_id)
                    <a href="{{ route('hrga2.2.print', $penilaian_id) }}" target="_blank" class="btn btn-success">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            {{-- I. PENILAIAN KOMPETENSI --}}
            <div class="mb-4">
                <h5 class="bg-light p-2">I. Penilaian Kompetensi</h5>
                <table class="table table-bordered border-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Standard Kompetensi</th>
                        <th width="100" class="text-center">Aktual</th>
                        <th width="120" class="text-center">Tidak Lanjut</th>
                    </tr>
                    <tbody>
                        @foreach ($masterKompetensi as $index => $komp)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $komp }}</td>
                                <td class="text-center">
                                    <input type="checkbox" wire:model.live="kompetensi.{{ $komp }}.aktual"
                                        class="form-check-input" style="width: 20px; height: 20px;">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" wire:model.live="kompetensi.{{ $komp }}.tidak_lanjut"
                                        class="form-check-input" style="width: 20px; height: 20px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- II. CATATAN KEHADIRAN --}}
            <div class="mb-4">
                <h5 class="bg-light p-2">II. Catatan Kehadiran</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm border-dark">
                        <tr>
                            <th rowspan="3" class="text-center align-middle">No</th>
                            <th rowspan="3" class="text-center align-middle">Keterangan</th>
                            <th colspan="24" class="text-center">Bulan</th>
                            <th rowspan="3" width="300">Total</th>
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 12; $i++)
                                <th colspan="2" class="text-center">{{ $i }}</th>
                            @endfor
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= 12; $i++)
                                <th class="text-center bg-white">Hari</th>
                                <th class="text-center bg-light">Jam</th>
                            @endfor
                        </tr>
                        <tbody>
                            @foreach ($keteranganKehadiran as $index => $ket)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><strong>{{ $ket }}</strong></td>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td class="p-1">
                                            <input type="number"
                                                wire:model.live="kehadiran.{{ $ket }}.{{ $i }}.hari"
                                                class="form-control form-control-sm text-center p-1" min="0"
                                                style="width: 50px; font-size: 12px;">
                                        </td>
                                        <td class="p-1 bg-light">
                                            <input readonly type="text"
                                                wire:model.live="kehadiran.{{ $ket }}.{{ $i }}.jam"
                                                class="form-control form-control-sm text-center p-1" min="0"
                                                style="width: 50px; font-size: 12px;">
                                        </td>
                                    @endfor
                                    <td class="text-center">
                                        <strong>
                                            {{ $this->getTotalKehadiranHari($ket) }} <small>hari</small><br>
                                            {{ $this->getTotalKehadiranJam($ket) }} <small>jam</small>
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="table-secondary">
                                <td colspan="26" class="text-center"><strong>Grand Total</strong></td>
                                <td class="text-center">
                                    <strong class="text-danger">
                                        {{ $this->getTotalKehadiranHari() }} <small>hari</small><br>
                                        {{ $this->getTotalKehadiranJam() }} <small>jam</small>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 p-3 bg-light rounded">
                    <small>
                        <strong>Penilaian:</strong><br>
                        <div class="row">
                            <div class="col-6">
                                • Baik Sekali = Grand Total < 3 Hari<br>
                                    • Baik = Grand Total 4 - 7 Hari<br>
                                    • Cukup = Grand Total 8 - 12 Hari<br>
                                    • Kurang = Grand Total > 12 Hari<br>
                                    • Note = 1 Hari = 8 Jam<br>
                            </div>
                            <div class="col-6">
                                Nilai catatan kehadiran:
                                <strong>
                                    @if ($this->getTotalKehadiranHari() < 3)
                                        Baik Sekali
                                    @elseif($this->getTotalKehadiranHari() >= 3 && $this->getTotalKehadiranHari() <= 7)
                                        Baik
                                    @elseif($this->getTotalKehadiranHari() > 7 && $this->getTotalKehadiranHari() <= 12)
                                        Cukup
                                    @else
                                        Kurang
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </small>
                </div>
            </div>

            {{-- III. SURAT PERINGATAN YANG DITERIMA --}}
            <div class="mb-4">
                <h5 class="bg-light p-2">III. Surat Peringatan Yang Diterima</h5>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered border-dark">
                            <tbody>
                                @for ($i = 1; $i <= 3; $i++)
                                    <tr>
                                        <td width="250"><strong>{{ $i }}. Surat peringatan
                                                {{ $i == 1 ? 'I' : ($i == 2 ? 'II' : 'III') }}, karena</strong></td>
                                        <td>
                                            @if ($editingSp == $i)
                                                {{-- EDIT: Mode edit - tampilkan textarea --}}
                                                <div class="input-group">
                                                    <textarea wire:model.live="spKeterangan.sp_{{ $i }}" class="form-control" rows="1"
                                                        placeholder="Masukkan keterangan..."></textarea>
                                                    <button type="button"
                                                        wire:click="saveSpKeterangan({{ $i }})"
                                                        class="btn btn-success btn-xs">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                    <button type="button"
                                                        wire:click="toggleEditSp({{ $i }})"
                                                        class="btn btn-secondary btn-xs ms-1">
                                                        <i class="fas fa-times"></i> Batal
                                                    </button>
                                                </div>
                                            @else
                                                {{-- Default: Tampilkan teks statis + tombol edit --}}
                                                <span>{{ $spKeterangan['sp_' . $i] ?: 'tidak pernah....................................................................................................................................................' }}</span>
                                                <button type="button" wire:click="toggleEditSp({{ $i }})"
                                                    class="btn float-end btn-outline-primary btn-xs ms-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- IV. PENILAIAN --}}
            <div class="mb-4">
                <h5 class="bg-light p-2">IV. Penilaian</h5>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Parameter</th>
                                    <th width="100">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterParameter as $index => $param)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $param }}</td>
                                        <td>
                                            <input type="number" wire:model.live="parameter.{{ $param }}"
                                                class="form-control text-center" min="0" max="100">
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-warning">
                                    <td colspan="2" class="text-end"><strong>TOTAL</strong></td>
                                    <td class="text-center">
                                        <strong class="fs-5">{{ $totalParameter }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <strong>Keterangan Penilaian</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Keterangan</th>
                                            <th width="100" class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Baik sekali</strong></td>
                                            <td class="text-center">86 - 100</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Baik</strong></td>
                                            <td class="text-center">70 - 85</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Cukup</strong></td>
                                            <td class="text-center">60 - 69</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kurang</strong></td>
                                            <td class="text-center">&lt; 60</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-warning">
                                <strong>SP - Surat Peringatan</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>SP I = 10</strong></td>

                                        </tr>
                                        <tr>
                                            <td><strong>SP II = 20</strong></td>

                                        </tr>
                                        <tr>
                                            <td><strong>SP III = 40</strong></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card d-none">
                            <div class="card-header bg-danger text-white">
                                <strong>Total Nilai - SP</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Total Nilai Parameter</strong></td>
                                            <td width="100" class="text-center">
                                                <strong>{{ $totalParameter }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total SP</strong></td>
                                            <td class="text-center"><strong>{{ $totalSP }}</strong></td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td><strong>Nilai Akhir</strong></td>
                                            <td class="text-center">
                                                <strong class="fs-4 text-danger">{{ $totalNilai }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- V. REKOMENDASI --}}
            <div class="mb-4">
                <h5 class="bg-light p-2">V. Rekomendasi</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label"><strong>Aktual Nilai:</strong></label>
                                <div class="alert alert-info mb-0">
                                    <h5 class="mb-0 text-white">{{ number_format($totalNilai, 1) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><strong>Kesimpulan:</strong></label>
                                <div
                                    class="alert 
                        {{ $kategoriNilai == 'Baik Sekali' ? 'alert-success' : '' }}
                        {{ $kategoriNilai == 'Baik' ? 'alert-primary' : '' }}
                        {{ $kategoriNilai == 'Cukup' ? 'alert-warning' : '' }}
                        {{ $kategoriNilai == 'Kurang' ? 'alert-danger' : '' }}
                        mb-0">
                                    <h5 class="mb-0 text-white">{{ $kategoriNilai }}</h5>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="form-label"><strong>Rekomendasi:</strong></label>
                            {{-- EDIT: Ganti ke blur biar save saat keluar field --}}
                            <textarea wire:model.blur="rekomendasi" class="form-control" rows="4"
                                placeholder="Rekomendasi akan auto-generate berdasarkan kategori, edit manual jika perlu..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <a href="{{ route('hrga2.2.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

        </div>
    </div>
</div>
