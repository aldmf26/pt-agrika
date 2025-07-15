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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-2">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6"></div>
            <div class="col-4 ">
                <p class="mt-2">No Dok : FRM.PRO.01.03, Rev 00</p>
            </div>
            <div class="col-12 ">
                <p class="cop_judul">FORM PENCABUTAN BULU dan LAPORAN HARIAN
                </p>
                <p class="cop_bawah text-center">Feather removal and Production Daily Report</p>
            </div>
            <div class="col-10">
                <table>
                    <tr>
                        <td>Hari/Tanggal <br> <span class="fst-italic">date</span> &nbsp;</td>
                        <td width="2%">: </td>
                        <td class="align-middle">&nbsp; {{ tanggal($tgl) }}</td>
                    </tr>
                    <tr>
                        <td>Regu &nbsp;<br> <span class="fst-italic">Team</span> </td>
                        <td width="2%">:</td>

                        <td class="align-middle"> &nbsp;{{ $pengawas }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <br>
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class=" align-middle" rowspan="3">No</th>
                            <th rowspan="3" class=" align-middle text-center">Nama Operator Cabut <br><span
                                    class="fst-italic fw-lighter">Operator name</span></th>
                            <th rowspan="3" class=" align-middle text-center">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot code</span>
                            <th rowspan="3" class=" align-middle text-center">Jenis<br> <span
                                    class="fst-italic fw-lighter">
                                    type</span>
                            </th>
                            <th class="text-center" colspan="2">Jumlah <br>
                                <span class="fst-italic fw-lighter">Quantity</span>
                            </th>
                            <th class="text-center" colspan="2">Kembali <br> <span
                                    class="fst-italic fw-lighter">Retur</span>
                            </th>
                            <th class="text-center" colspan="4">Hasil Pencabutan
                                <br> <span class="fst-italic fw-lighter">Inspection results</span>
                            </th>
                            <th rowspan="3" class=" align-middle text-center">Keterangan<br> <span
                                    class="fst-italic fw-lighter">Remarks</span>
                            </th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="text-end align-middle">Pcs</th>
                            <th rowspan="2" class="text-end align-middle">Gr</th>
                            <th rowspan="2" class="text-end align-middle">Pcs</th>
                            <th rowspan="2" class="text-end align-middle">Gr</th>
                            <th colspan="2" class="text-center align-middle">Ok</th>
                            <th colspan="2" class="text-center align-middle">Not Ok</th>
                        </tr>
                        <tr>
                            <th class="text-end align-middle">Pcs</th>
                            <th class="text-end align-middle">Gr</th>
                            <th class="text-end align-middle">Pcs</th>
                            <th class="text-end align-middle">Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabut as $c)
                            @php
                                $sbw = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->where('nm_partai', 'like', '%' . $c['nm_partai'] . '%')
                                    ->first();
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ ucwords(strtolower($c['nama'])) }}</td>
                                <td class="text-center">{{ $sbw->no_invoice }}</td>
                                <td class="text-center">{{ ucwords(strtolower($sbw->nama)) }}</td>
                                <td class="text-end">{{ $c['pcs_awal'] }}</td>
                                <td class="text-end">{{ $c['gr_awal'] }}</td>
                                <td class="text-end">0</td>
                                <td class="text-end">0</td>
                                <td class="text-end">{{ $c['pcs_akhir'] }}</td>
                                <td class="text-end">{{ $c['gr_akhir'] }}</td>
                                <td class="text-end">0</td>
                                <td class="text-end">0</td>
                                @php
                                    $susut = (1 - $c['gr_akhir'] / $c['gr_awal']) * 100;
                                @endphp

                                <td>dari {{ tanggal($c['tgl']) }} sampai {{ tanggal($c['tgl_akhir']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="col-7">

            </div>
            <div class="col-5">
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>

                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script>
        window.print();
    </script> --}}

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
