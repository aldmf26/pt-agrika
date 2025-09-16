<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" style="font-size: 11px">
                <tr>
                    <th colspan="10" class="dhead" style="height: 6px"></th>
                </tr>
                <tr>
                    <td class="border_kiri">Nama</td>
                    <td>:</td>
                    <td>{{ ucwords(strtolower($evaluasi_detail->data_pegawai->nama)) }}</td>

                    <td>Dept.</td>
                    <td>:</td>
                    <td>{{ $evaluasi_detail->data_pegawai->divisi->divisi }}</td>

                    <td class="">Training</td>
                    <td class="">:</td>
                    <td class="border_kanan">{{ ucwords(strtolower($evaluasi_detail->tema_pelatihan)) }}</td>

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
                    <td class="border_bawah">{{ ucwords(strtolower($evaluasi_detail->data_pegawai->status)) }}</td>

                    <td class="border_bawah"></td>
                    <td class="border_bawah"></td>
                    <td class="border_bawah">_____</td>

                    <td class="border_bawah ">Tanggal</td>
                    <td class="border_bawah ">:</td>
                    <td class="border_bawah border_kanan">{{ $evaluasi_detail->tanggal }}</td>
                </tr>

            </table>
            <br>
            <table width="100%" style="font-size: 11px" class="table">
                <tr>
                    <th colspan="10" class="dhead text-center" style="height: 6px">TUJUAN PELATIHAN</th>
                </tr>
                <tr>
                    <td colspan="10" class="text-center ">
                        {{ $evaluasi_detail->kisaran_materi }}
                    </td>
                </tr>
            </table>

            <table width="100%" style="font-size: 11px" class="table table-bordered">
                <thead>

                    <tr>
                        <th class="dhead text-center">NO.</th>
                        <th class="dhead text-center">RENCANA KERJA SETELAH MENGIKUTI PELATIHAN <br>
                            (diisi oleh peserta training)
                        </th>
                        <th class="dhead text-center">Target Realisasi <br> (bulan)</th>
                        <th class="dhead text-center">
                            REALISASI RENCANA KERJA SETELAH MENGIKUTI PELATIHAN <br>
                            (diisi oleh atasan)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Memahami {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                        <td class="text-center">1</td>
                        <td class="text-center">Memahami {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Melakukan kegiatan {{ strtolower($evaluasi_detail->tema_pelatihan) }} dengan benar</td>
                        <td class="text-center">1</td>
                        <td class="text-center">Melakukan kegiatan
                            {{ strtolower($evaluasi_detail->tema_pelatihan) }} dengan benar</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Melapor jika ketemu masalah terkait {{ strtolower($evaluasi_detail->tema_pelatihan) }}
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-center">Melapor jika ketemu masalah terkait
                            {{ strtolower($evaluasi_detail->tema_pelatihan) }}</td>
                    </tr>
                </tbody>

            </table>

        </div>
        <div class="col-6">
            <table class="table table-bordered" with="100%" style="font-size: 11px">
                <tr>
                    <th class="dhead text-center">KETERANGAN</th>

                </tr>
                <tr>
                    <td style="height: 47px"></td>
                </tr>

            </table>
            <table class="table table-bordered" with="100%" style="font-size: 11px">
                <tr>
                    <th class="dhead text-center" colspan="2">KOMENTAR ATASAN TERHADAP HASIL EVALUASI [Di-isi
                        oleh Pimpinan
                        Peserta Training]</th>

                </tr>
                <tr>
                    <td>Tgl. Review : {{ date('dmy', strtotime($evaluasi_detail->tanggal)) }}</td>
                    <td>
                        <input type="checkbox" name="" id="" checked> 1 (Satu) Bulan
                        <input type="checkbox" name="" id=""> 3 (Tiga) Bulan
                        <input type="checkbox" name="" id=""> 6 (Enam) Bulan
                    </td>
                </tr>
                <tr>
                    <td>Dievaluasi oleh: Kepala Div</td>
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
            <table class="table table-bordered" with="100%" style="font-size: 11px">
                <tr>
                    <th class="dhead text-center">IDE KREATIF [ Tuangkan Ide Kreatif Anda Sehubungan dengan
                        Pekerjaan Anda ]</th>

                </tr>
                <tr>
                    <td style="height: 93px"></td>
                </tr>

            </table>
            <table class="table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 75px"></td>
                        <td style="height: 75px"></td>
                        <td style="height: 75px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[SPV. HR]</td>
                        <td class="text-center">[KA. HRGA]</td>
                        <td class="text-center">[ DIREKTUR. ]</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</x-hccp-print>
