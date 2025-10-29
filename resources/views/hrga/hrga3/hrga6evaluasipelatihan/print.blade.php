<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-lg-12">
            @php

                $evaluasi = DB::table('evaluasi_pelatihan')
                    ->where('nota_pelatihan', $evaluasi_detail->nota_pelatihan)
                    ->first();
            @endphp
            <table width="100%" style="font-size: 10px">
                <tr>
                    <th colspan="10" class="dhead" style="height: 6px"></th>
                </tr>
                <tr>
                    <td class="border_kiri">Nama</td>
                    <td>:</td>
                    <td>{{ ucwords(strtolower($evaluasi_detail->data_pegawai->nama)) }}</td>

                    <td>Dept.</td>
                    <td>:</td>
                    <td>{{ $evaluasi_detail->data_pegawai->divisi->divisi ?? '-' }}</td>

                    <td class="">Training</td>
                    <td class="">:</td>
                    <td class="border_kanan">{{ ucfirst(strtolower($evaluasi_detail->tema_pelatihan)) }}</td>

                    <td rowspan="2" width="33%" class="border_kanan border_kiri border_bawah">
                        Periode Evaluasi :
                        <br>
                        <input type="checkbox" name="" id="" checked> 1 (Satu) Bulan Setelah
                        Training
                        &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="" id=""> 6 (Enam) Bulan Setelah Training
                        <br>
                        <input type="checkbox" name="" id=""> 3 (Tiga) Bulan Setelah Training
                    </td>
                </tr>
                <tr>
                    <td class="border_kiri border_bawah">Jabatan</td>
                    <td class="border_bawah">:</td>
                    <td class="border_bawah">{{ ucwords(strtolower($evaluasi_detail->data_pegawai->posisi)) }}</td>

                    <td class="border_bawah"></td>
                    <td class="border_bawah"></td>
                    <td class="border_bawah">_____</td>

                    <td class="border_bawah ">Tanggal</td>
                    <td class="border_bawah ">:</td>
                    <td class="border_bawah border_kanan">{{ tanggal($evaluasi_detail->tanggal) }}</td>
                </tr>

            </table>

            <table width="100%" style="font-size: 10px" class="table table-bordered border-dark ">
                <tr>
                    <th colspan="10" class="dhead text-center" style="height: 6px">Tujuan Pelatihan</th>
                </tr>
                <tr>
                    <td colspan="10" class="text-center ">
                        {{-- {{ ucfirst(strtolower($evaluasi_detail->kisaran_materi)) }} --}}
                        {{-- Memastikan karyawan dapat memahami & melakukan kegiatan cuci nitrite & steaming dengan baik &
                        benar --}}

                        {{ $evaluasi->tujuan_pelatihan }}
                    </td>
                </tr>
            </table>

            <table width="100%" style="font-size: 10px" class="table table-bordered border-dark">
                <thead>

                    <tr>
                        <th class="dhead text-center align-middle">No</th>
                        <th class="dhead text-center align-middle">Rencana Kerja Setelah Mengikuti Pelatihan <br>
                            (Diisi Oleh Peserta Training)
                        </th>
                        <th class="dhead text-center align-middle">Target Realisasi <br> (Bulan)</th>
                        <th class="dhead text-center align-middle">
                            Realisasi Rencana Kerja Setelah Mengikuti Pelatihan <br>
                            (Diisi Oleh Atasan)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Memahami {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                        <td class="text-end">1</td>
                        <td class="text-start">Memahami {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Melakukan kegiatan {{ strtolower($evaluasi_detail->tema_pelatihan) }} dengan benar</td>
                        <td class="text-end">1</td>
                        <td class="text-start">Melakukan kegiatan
                            {{ strtolower($evaluasi_detail->tema_pelatihan) }} dengan benar</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Melapor jika ada masalah terkait {{ strtolower($evaluasi_detail->tema_pelatihan) }}
                        </td>
                        <td class="text-end">1</td>
                        <td class="text-start">Melapor jika ada masalah terkait
                            {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                    </tr>
                </tbody>

            </table>

        </div>
        <div class="col-6">
            <table class="table table-bordered border-dark" with="100%" style="font-size: 10px ">
                <tr>
                    <th class="dhead text-center">Keterangan</th>

                </tr>
                <tr>
                    <td style="height: 47px"></td>
                </tr>
                <tr>
                    @php
                        $tgl = date('Y-m-d', strtotime($evaluasi_detail->tanggal . ' +3 days'));

                    @endphp
                    <td>Note : Evaluasi pelatihan (3) ini harus dikembalikan ke
                        KA.HRGA setelah mendapat hasil <br>
                        evaluasi dari pimpinan masing-masing, selambat-lambatnya tanggal: {{ tanggal($tgl) }}
                    </td>
                </tr>

            </table>
            <table class="table table-bordered border-dark" with="100%" style="font-size: 10px">
                <tr>
                    <th class="dhead text-center" colspan="2">Komentar Atasan Terhadap Hasil Evaluasi (Diisi
                        Oleh Pimpinan
                        Peserta Training)</th>

                </tr>
                <tr>
                    <td>Tgl. Review : {{ tanggal($evaluasi_detail->tanggal) }}</td>
                    <td>
                        <input type="checkbox" name="" id="" checked> 1 (Satu) Bulan
                        <input type="checkbox" name="" id=""> 3 (Tiga) Bulan
                        <input type="checkbox" name="" id=""> 6 (Enam) Bulan
                    </td>
                </tr>
                <tr>
                    <td>Dievaluasi oleh: Ka. {{ $evaluasi_detail->data_pegawai->divisi->divisi ?? '-' }}</td>
                    <td>
                        Kesimpulan:
                        <br>
                        <input type="checkbox" name="" id=""> (1) Belum dapat melaksanakan
                        tugas sesuai materi <br>
                        <input type="checkbox" name="" id=""> (2) Dapat melaksanakan tugas namun
                        harus dipantau ketat <br>
                        <input type="checkbox" name="" id="" checked> (3) Dapat melaksanakan tugas
                        tanpa
                        dipantau ketat <br>
                        <input type="checkbox" name="" id=""> (4) Dapat memberikan training
                        terkait dengan aktivitas <br>
                        <input type="checkbox" name="" id=""> (5) Dapat memberikan training &
                        kontribusi improvement
                    </td>
                </tr>

            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered border-dark" with="100%" style="font-size: 10px">
                <tr>
                    <th class="dhead text-center">Ide Kreatif (Tuangkan Ide Kreatif Anda Sehubungan Dengan
                        Pekerjaan Anda)</th>

                </tr>
                <tr>
                    <td style="height: 93px"></td>
                </tr>

            </table>
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KA. HRGA)</td>
                        <td class="text-center">(OPERATIONAL MANAGER)</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</x-hccp-print>
