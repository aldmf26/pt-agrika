<div class="employee-record" style="page-break-after: always;">
    <x-hccp-print :title="$title" :dok="$dok">
        <style>
            * {
                font-size: 10px;
            }
        </style>
        <div class="row">
            <div class="col-lg-4">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <th>{{ $karyawan->nama }}</th>
                    </tr>
                    <tr>
                        <th>Div / Dept</th>
                        <th>:</th>
                        <td>{{ $karyawan->divisi }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <th>:</th>
                        <td>{{ $karyawan->posisi }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <table class="table">
                    <tr>
                        <th>Tgl Masuk Kerja</th>
                        <th>:</th>
                        <th>{{ tanggal($karyawan->tgl_masuk) }}</th>
                    </tr>
                    <tr>
                        <th>Tgl berakhirnya masa percobaan</th>
                        <th>:</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td>{{ $karyawan->jenis_kelamin }}</td>
                    </tr>

                </table>
            </div>
        </div>

        <span>I. Penilaian Kompetensi</span> <br><br>
        <span>II. CATATAN KEHADIRAN</span>

        <table class="table table-bordered border-dark text-center align-middle">
            <thead class="">
                <tr>
                    <th class="dhead" rowspan="3">No</th>
                    <th class="dhead" rowspan="3">Keterangan</th>
                    <th class="dhead" colspan="24">Bulan</th>
                    <th class="dhead" rowspan="3">Total</th>
                </tr>
                <tr>
                    <!-- Angka bulan -->
                    <th class="dhead" colspan="2">1</th>
                    <th class="dhead" colspan="2">2</th>
                    <th class="dhead" colspan="2">3</th>
                    <th class="dhead" colspan="2">4</th>
                    <th class="dhead" colspan="2">5</th>
                    <th class="dhead" colspan="2">6</th>
                    <th class="dhead" colspan="2">7</th>
                    <th class="dhead" colspan="2">8</th>
                    <th class="dhead" colspan="2">9</th>
                    <th class="dhead" colspan="2">10</th>
                    <th class="dhead" colspan="2">11</th>
                    <th class="dhead" colspan="2">12</th>
                </tr>
                <tr>
                    <!-- Sub-baris untuk Hari dan Menit -->
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                    <th class="dhead">Hari</th>
                    <th class="dhead">Menit</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data rows -->
                <tr>
                    <td>1</td>
                    <td>Terlambat</td>
                    <!-- Kolom data bulan -->
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sakit</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tanpa Keterangan</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Izin</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </tbody>
            <tfoot class="">
                <tr>
                    <th colspan="2">Grand Total</th>
                    <th colspan="24"></th>
                    <th>0</th>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex mt-4">
            <div>
                <p><strong>Penilaian:</strong></p>
                <ul>
                    <li>Baik Sekali = Grand Total < 3 hari</li>
                    <li>Baik = Grand Total 4 - 7 hari</li>
                    <li>Cukup = Grand Total 8 - 12 hari</li>
                    <li>Kurang = Grand Total > 12 hari</li>
                </ul>
                <p><strong>Catatan:</strong> 1 hari = 8 jam</p>
            </div>
            <div class="m-auto">
                NILAI CATATAN KEHADIRAN : Baik Sekali <s>/ Baik / Cukup / Kurang</s>
            </div>
        </div>
    </x-hccp-print>
</div>

<x-hccp-print :title="$title" :dok="$dok">
    <h6>III. SURAT PERINGATAN YANG DITERIMA</h6>
    <hr />

    <ol style="line-height: 2">
        <li>1. Surat Peringatan I, karena Tidak
            Pernah……………………………………………………………………………………………………………………………………………………………………………………………….</li>

        <li>2. Surat Peringatan II, karena Tidak
            Pernah……………………………………………………………………………………………………………………………………………………………………………………………….</li>

        <li>3. Surat Peringatan III, karena Tidak
            Pernah……………………………………………………………………………………………………………………………………………………………………………………………….</li>
    </ol>

    <div class="row">
        <div class="col-5">
            <h6>IV. PENILAIAN</h6>
            <div class="row">
                <div class="col-8">
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Parameter</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $parameters = [
                                    ['Disiplin', 90],
                                    ['Sikap Kerja', 90],
                                    ['Kerjasama', 80],
                                    ['Tanggung jawab', 80],
                                    ['Kesopanan', 80],
                                    ['Kejujuran', 80],
                                    ['Kerapian', 80],
                                    ['Inisiatif', 80],
                                    ['Pengetahuan', 80],
                                    ['Keahlian', 80],
                                    ['Leadership', 80],
                                    ['Manajerial', 80],
                                ];
                            @endphp

                            @foreach ($parameters as $index => $param)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $param[0] }}</td>
                                    <td class="text-end">{{ $param[1] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2" class="text-center">TOTAL</th>
                                <th class="text-end">980</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th colspan="2" class="text-center">Keterangan :</th>
                        </tr>
                        <tr>
                            <td>Baik sekali </td>
                            <td>86 - 100</td>
                        </tr>
                        <tr>
                            <td>Baik</td>
                            <td>70 - 85</td>
                        </tr>
                        <tr>
                            <td>Cukup</td>
                            <td>60 - 69</td>
                        </tr>
                        <tr>
                            <td>Kurang</td>
                            <td>
                                < 60</td>
                        </tr>
                    </table>

                    <table class="table table-bordered border-dark">
                        <tr>
                            <td>SP : Surat peringatan</td>
                        </tr>
                        <tr>
                            <td>SP I = 10 </td>
                        </tr>
                        <tr>
                            <td>SP II = 20</td>
                        </tr>
                        <tr>
                            <td>SP III = 40</td>
                        </tr>
                    </table>
                    
                    <div class="d-flex p-2 border border-dark">
                        <div class="m-auto">
                            Nilai = 
                        </div>
                        <div class="m-auto" style="line-height: 1">
                            <p>Total Nilai - SP</p>
                            <hr>
                            <p>Total Parameter</p>
                        </div>
                    </div>

                    
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-3 text-center">
                    <span>Dibuat Oleh,
                        <br>
                        <br>
                        <br>
                        <br>
                        [  Head      ]
                    </span>
                </div>
                <div class="col-3"></div>
                <div class="col-3 text-center">
                    <span>Diketahui Oleh,
                        <br>
                        <br>
                        <br>
                        <br>
                        [KA.HRGA]
                    </span>
                </div>
                <div class="col-3 text-center">
                    <span>Diketahui Oleh,,
                        <br>
                        <br>
                        <br>
                        <br>
                        [DIREKTUR]
                    </span>
                </div>
            </div>
        </div>
        <div class="col-7">
            <h6 class="mb-5">V. REKOMENDASI</h6>
            <p>Aktual Nilai : 81 </p>
            <p>Kesimpulan : Ybs dinilai cakap / baik dalam menjalankan performanya. Ybs bisa dilanjut kontrak /
                kerjasama dengan <br> perusahaan. Dipertimbangkan. . . . . . . </p>
        </div>

    </div>
    
</x-hccp-print>

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
