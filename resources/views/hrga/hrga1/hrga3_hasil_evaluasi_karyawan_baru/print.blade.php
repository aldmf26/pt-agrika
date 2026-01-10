<div class="employee-record" style="page-break-after: always;">
    <x-hccp-print :title="$title" :dok="$dok">
        <div class="row">

            <div class="col-12">
                <table class="table-xs">
                    <tr>
                        <td>Nama Calon Karyawan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ ucwords($pegawai->nama) }}</td>
                    </tr>
                    <tr>
                        <td>Usia</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ ucfirst(strtolower($pegawai->posisi)) }}</td>
                    </tr>
                    <tr>
                        <td>Periode Masa Percobaan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ $pegawai->penilaiankaryawan->periode ?? 1 }} Bulan</td>
                    </tr>
                    {{-- <tr>
                        <td><span style="font-size: 12px"><em>* Coret Yang Tidak Sesuai</em></span></td>
                    </tr> --}}
                </table>
                <br>
                <table class="table table-bordered border-dark table-xs">
                    <tr>
                        <th colspan="3" class="text-center head">PENILAIAN KARYAWAN</th>
                    </tr>
                    <tr>
                        <th class="text-center text-nowrap">Kriteria Penilaian</th>
                        <th class="text-center text-nowrap">Standar Penilaian</th>
                        <th class="text-center text-nowrap">Hasil Penilaian</th>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->pendidikan_standar ?? 'N/A') }}</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->pendidikan_hasil ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td>Pengalaman</td>
                        <td>{{ ucfirst(optional($pegawai->penilaiankaryawan)->pengalaman_standar ?? 'N/A') }}</td>
                        <td>{{ ucfirst(optional($pegawai->penilaiankaryawan)->pengalaman_hasil ?? 'N/A') }}</td>

                    </tr>
                    <tr>
                        <td>Pelatihan</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->pelatihan_standar ?? 'N/A') }}</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->pelatihan_hasil ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td>Keterampilan</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->ketrampilan_standar ?? 'Teliti, cepat') }}</td>
                        <td>{{ ucfirst($pegawai->penilaiankaryawan->ketrampilan_hasil ?? 'Teliti, cepat') }}</td>
                    </tr>
                    <tr>
                        <td>Kompetensi Inti</td>
                        <td>{{ ucfirst(optional($pegawai->penilaiankaryawan)->kompetensi_inti_standar ?? 'Mampu membedakan jenis SBW, mampu melihat jenis pengotor SBW') }}
                        </td>
                        <td>{{ ucfirst(optional($pegawai->penilaiankaryawan)->kompetensi_inti_hasil ?? 'Mampu membedakan jenis SBW, mampu melihat jenis pengotor SBW') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <table class="table table-borderless">
                    <tr style="font-size: 11px">
                        <td class="fw-bold text-decoration-underline">Keputusan:</td>
                        <td><input type="checkbox" name="" id="" checked> Lulus masa percobaan <br>
                            <input type="checkbox" name="" id=""> Tidak lulus masa percobaan
                        </td>
                    </tr>
                </table>

                <span class="fw-bold text-decoration-underline" style="font-size: 11px">Keterangan:</span>
                <span style="font-size: 11px">Karyawan dilanjut kontrak &
                    diikutkan MCU tahun ini / depan</span>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center">Dibuat Oleh:</th>
                            <th class="text-center">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 70px" class="align-middle text-center">
                                <x-ttd-barcode :id_pegawai="whereTtd('STAFF HRGA')" />
                            </td>
                            <td style="height: 70px" class="align-middle text-center">
                                <x-ttd-barcode :id_pegawai="whereTtd('KEPALA HRGA')" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">(STAFF HRGA)</td>
                            <td class="text-center">(KEPALA HRGA)</td>
                        </tr>
                    </tbody>
                </table>
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
