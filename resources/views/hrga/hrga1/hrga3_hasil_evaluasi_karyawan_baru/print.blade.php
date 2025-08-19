<div class="employee-record" style="page-break-after: always;">
    <x-hccp-print :title="$title" :dok="$dok">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-11">
                <table>
                    <tr>
                        <td>Nama Calon Karyawan</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <td>Usia</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>:</td>
                        <td>{{ $pegawai->posisi }}</td>
                    </tr>
                    <tr>
                        <td>Periode Masa Percobaan</td>
                        <td>:</td>
                        <td>{{ $pegawai->penilaiankaryawan->periode ?? 1 }} Bulan</td>
                    </tr>
                    <tr>
                        <td><span style="font-size: 12px"><em>* Coret yang tidak sesuai</em></span></td>
                    </tr>
                </table>

                <table class="table table-bordered border-dark">
                    <tr class="text-center">
                        <th class="head" colspan="3">PENILAIAN KARYAWAN</th>
                    </tr>
                    <tr class="text-center">
                        <th>Kriteria Penilaian</th>
                        <th>Standar Penilaian</th>
                        <th>Hasil Penilaian</th>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>{{ $pegawai->penilaiankaryawan->pendidikan_standar ?? 'N/A' }}</td>
                        <td>{{ $pegawai->penilaiankaryawan->pendidikan_hasil ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Pengalaman</td>
                        <td>{{ $pegawai->penilaiankaryawan->pengalaman_standar ?? 'N/A' }}</td>
                        <td>{{ $pegawai->penilaiankaryawan->pengalaman_hasil ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Pelatihan</td>
                        <td>{{ $pegawai->penilaiankaryawan->pelatihan_standar ?? 'N/A' }}</td>
                        <td>{{ $pegawai->penilaiankaryawan->pelatihan_hasil ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Ketrampilan</td>
                        <td>{{ $pegawai->penilaiankaryawan->ketrampilan_standar ?? 'Teliti, Cepat' }}</td>
                        <td>{{ $pegawai->penilaiankaryawan->ketrampilan_hasil ?? 'Teliti, Cepat' }}</td>
                    </tr>
                    <tr>
                        <td>Kompetensi Inti</td>
                        <td>{{ $pegawai->penilaiankaryawan->kompetensi_inti_standar ?? 'Mampu membedakan jenis SBW, mampu melihat jenis pengotor SBW' }}
                        </td>
                        <td>{{ $pegawai->penilaiankaryawan->kompetensi_inti_hasil ?? 'Mampu membedakan jenis SBW, mampu melihat jenis pengotor SBW' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-11">
                <table class="table table-borderless">
                    <tr>
                        <td class="fw-bold text-decoration-underline">Keputusan:</td>
                        <td>⬛Lulus Masa Percobaan <br> ⬜Tidak Lulus Masa Percobaan</td>
                    </tr>
                </table>

                <span class="fw-bold text-decoration-underline">Keterangan:</span> <span>Karyawan dilanjut kontrak dan
                    diikutkan MCU thn ini / depan</span>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6"></div>
            <div class="col-3 text-center">
                <span>Dibuat Oleh,
                    <br>
                    <br>
                    <br>
                    <br>
                    SPV. HR
                </span>
            </div>
            <div class="col-3 text-center">
                <span>Diketahui Oleh,,
                    <br>
                    <br>
                    <br>
                    <br>
                    KA.HRGA
                </span>
            </div>
        </div>
    </x-hccp-print>
</div>
<style>
    @media print {
        .employee-record {
            page-break-after: always;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* Pastikan halaman terakhir tidak memiliki page break */
        .employee-record:last-child {
            page-break-after: avoid;
        }

        /* Memastikan konten tidak terpotong */
        table {
            page-break-inside: avoid;
        }

        /* Mengatur margin halaman */
        @page {
            margin: 2cm;
        }
    }
</style>
