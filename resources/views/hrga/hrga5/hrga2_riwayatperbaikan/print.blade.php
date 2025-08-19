<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
    <style>
        .cop_judul {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;

        }

        .shapes {
            border: 1px solid black;
            border-radius: 10px;
        }

        .cop_text {
            font-size: 12px;
            text-align: left;
            font-weight: normal;
            margin-top: 100px;

        }

        .dhead {
            background-color: #C0C0C0 !important;
        }

        .bg-black {
            background-color: black !important;
        }

        .border_atas {
            border-top: 1px solid black;
        }

        .border_bawah {
            border-bottom: 1px solid black;
        }

        .border_kanan {
            border-right: 1px solid black;
            padding-right: 6px;
        }

        .border_kiri {
            border-left: 1px solid black;
            padding-left: 6px;
        }

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
            font-size: 10px;
            font-weight: normal
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #41464b !important;
        }

        .table th,
        .table td {

            font-size: 10px;
        }

        .table-tes th,
        .table-tes td {

            font-size: 10px;
        }

        .table-bawah th,
        .table-bawah td {
            border: 1px solid black;
            padding: 0.5rem;
            vertical-align: middle;
            text-align: center;
            /* white-space: nowrap; */
            /* ⬅️ ini agar tidak membungkus teks */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-3 mt-4">
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">RIWAYAT PEMELIHARAAN SARANA & <br> PRASARANA UMUM</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.:FRM.HRGA.05.02, Rev.00</p>
            </div>
            <div class="col-1"></div>

            <br>
            <div class="col-lg-10">
                <table width="100%">
                    <tr>
                        <td width="30%">Nama Sarana/Prasarana Umum</td>
                        <td width="2%">:</td>
                        <td>{{ $items->nama_item }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Jumlah</td>
                        <td width="2%">:</td>
                        <td>{{ $items->jumlah }}</td>
                    </tr>
                    <tr>
                        <td width="30%">No Identifikasi</td>
                        <td width="2%">:</td>
                        <td>{{ $items->no_identifikasi }}</td>
                    </tr>
                    <tr>
                        <td width="30%">Lokasi</td>
                        <td width="2%">:</td>
                        <td>{{ $items->lokasi }}</td>
                    </tr>
                    <tr>
                        <td width="30%">&nbsp;</td>
                        <td width="2%">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="30%">Tahun Pemeriksaan</td>
                        <td width="2%">:</td>
                        <td>{{ $tahun }}</td>
                    </tr>

                </table>
            </div> --}}
            <div class="col-lg-12 mt-3">
                <table width="100%">
                    <thead>
                        <tr>
                            <th class="align-top" colspan="2"><img style="width: 80px"
                                    src="{{ asset('img/logo.jpeg') }}" alt=""></th>
                            <th colspan="4">
                                <p class="cop_judul  shapes">RIWAYAT PEMELIHARAAN SARANA & <br> PRASARANA UMUM</p>
                            </th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">Dok.No.:FRM.HRGA.05.02,
                                    Rev.00</p>
                            </th>

                        </tr>
                        {{-- <tr>
                            <th colspan="2"></th>
                            <th colspan="4">
                                <p class="cop_judul  shapes">RIWAYAT PEMELIHARAAN SARANA & <br> PRASARANA UMUM</p>

                            </th>
                            <th colspan="2"></th>
                        </tr> --}}
                        <tr>
                            <th colspan="8">&nbsp;</th>
                        </tr>
                        <tr>
                            <td colspan="3">Nama Sarana/Prasarana Umum</td>

                            <td colspan="5"> : {{ $items->nama_item }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Jumlah</td>

                            <td colspan="2"> : {{ $items->jumlah }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">No Identifikasi</td>

                            <td colspan="2"> : {{ $items->no_identifikasi }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Lokasi</td>

                            <td colspan="2"> : {{ $items->lokasi }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Tahun Pemeriksaan</td>

                            <td colspan="2"> : {{ $tahun }}</td>
                        </tr>
                        <tr class="table-bawah">
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Tanggal</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Urutan unit / <br>
                                Ruang</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Perawatan/ <br>
                                Perbaikan</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap" width="30%">Jenis
                                yang dilakukan</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Kondisi <br>
                                kebersihan <br>
                                akhir</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Kondisi fungsi <br>
                                akhir
                            </th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Kesimpulan <br>
                                (Ok/Not OK)</th>
                            <th class="dhead  align-middle text-center" style="white-space: nowrap">Paraf Pelaksana</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($union as $r)
                            <tr class="table-bawah">
                                <td class="text-start">{{ date('d/m/Y', strtotime($r->tanggal)) }}</td>
                                @if ($items->jenis_item == 'ac')
                                    <td class="text-start" style="white-space: normal">{{ $items->no_identifikasi }} -
                                        {{ $items->lokasi }}</td>
                                @else
                                    @php
                                        $rincian = DB::table('rincian_ruangan')->where('id', $r->rincian_id)->first();
                                    @endphp
                                    <td class="text-start" style="white-space: normal">{{ $rincian->nama_rincian }}
                                    </td>
                                @endif

                                <td class="text-start">{{ ucfirst(strtolower($r->ket)) }}</td>
                                <td class="text-start">
                                    {{ $r->kesimpulan }}
                                </td>
                                <td class="text-start">
                                    {{ $r->ket == 'perawatan' ? 'Bersih ' : 'Kembali bersih' }}
                                </td>
                                <td class="text-start" class="text-start" style="white-space: normal">
                                    {{ $r->fungsi }}
                                </td>
                                <td class="text-start">
                                    Ok
                                </td>
                                <td class="text-start"></td>


                            </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="8" style="font-size: 9px; font-weight: normal">Note:</th>
                        </tr>
                        <tr>
                            <th colspan="8" style="font-size: 9px; font-weight: normal">1. Untuk pemeriksaan
                                kebersihan dilakukan
                                pengecekan kebersihan kondisi
                                fisik dari
                                sarana dan
                                prasarana umum
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" style="font-size: 9px; font-weight: normal">
                                2. Untuk pemeriksaan fungsi dari sarana prasarana umum dilakukan dengan cara
                                menjalangkan fungsi alat
                                dan menilai apakah alat masih berfungsi dengan normal atau tidak
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" style="font-size: 9px; font-weight: normal">
                                Untuk perbaikan tidak perlu diisikan hasil pemeriksaan kebersihan dan fungsi dari alat
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8">&nbsp;</th>
                        </tr>
                        <tr class="table-bawah">

                            <th colspan="2" style="border: none"></th>
                            <th class="text-center" colspan="2">Dibuat Oleh:</th>
                            <th class="text-center" colspan="2">Diperiksa Oleh:</th>
                            <th class="text-center" colspan="2">Diketahui Oleh:</th>
                        </tr>
                        <tr class="table-bawah">
                            <th colspan="2" style="border: none"></th>
                            <td style="height: 80px;" colspan="2" class="align-bottom">[GENERAL MAINTENANCE]</td>
                            <td style="height: 80px;" colspan="2" class="align-bottom">[SPV. GA-IR]</td>
                            <td style="height: 80px;" colspan="2" class="align-bottom">[KA.HRGA]</td>
                        </tr>
                    </tfoot>

                </table>
            </div>
            {{-- <div class="col-lg-12">
                <p>Note:</p>
                <p>1. Untuk pemeriksaan kebersihan dilakukan pengecekan kebersihan kondisi fisik dari sarana dan
                    prasarana umum</p>
                <p>2. Untuk pemeriksaan fungsi dari sarana prasarana umum dilakukan dengan cara menjalangkan fungsi alat
                    dan menilai apakah alat masih berfungsi dengan normal atau tidak</p>
                <p>Untuk perbaikan tidak perlu diisikan hasil pemeriksaan kebersihan dan fungsi dari alat</p>
            </div> --}}
            {{-- <div class="col-4">

            </div>
            <div class="col-8">
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center " width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center " width="33.33%">Diperiksa Oleh:</th>
                            <th class="text-center " width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class=""></td>
                            <td style="height: 80px" class=""></td>
                            <td style="height: 80px" class=""></td>
                        </tr>
                        <tr>
                            <td class="text-center ">[GENERAL MAINTENANCE]</td>
                            <td class="text-center ">[SPV. GA-IR]</td>
                            <td class="text-center ">[KA.HRGA]</td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}







        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
