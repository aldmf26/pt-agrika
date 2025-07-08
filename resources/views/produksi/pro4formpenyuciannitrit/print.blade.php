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
            /* Atur jarak bawah paragraf pertama */

        }

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
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
                <p class="mt-2">No Dok : FRM.PRO.01.04, Rev.00</p>
            </div>
            <div class="col-12">

                <p class="cop_judul">FORM PENCUCIAN NITRIT (CCP 1)</p>
                <p class="cop_bawah text-center">Material cleaning and washing CCP 1</p>

            </div>

            <div class="col-4"></div>
            <div class="col-10">
                <table>
                    <tr>
                        <td width="20%">Hari / Tanggal <br> <span class="fst-italic">date</span></td>
                        <td class="align-middle"> &nbsp; : {{ tanggal($tgl) }}</td>
                        <td>&nbsp;</td>
                        <td class="align-middle">Regu</td>
                        <td class="align-middle"> : {{ $nama_regu }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">

                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" rowspan="2">No</th>
                            <th class="text-center align-middle" rowspan="2">Nama Operator Cabut <br> <span
                                    class="fst-italic fw-lighter">Operator
                                    name</span></th>
                            <th class="text-center align-middle" rowspan="2">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot
                                    code</span></th>
                            <th class="text-center  ">Jumlah <br> <span class="fst-italic fw-lighter">Quantity</span>
                            </th>
                            <th class="text-center" colspan="2">Jam Cuci <br> <span
                                    class="fst-italic fw-lighter">Washing
                                    time</span></th>
                            <th class="text-center align-middle" rowspan="2">Total Waktu <br> <span
                                    class="fst-italic fw-lighter">Time</span></th>
                            <th class="text-center align-middle" rowspan="2">Waktu Cuci Per Pcs <br> <span
                                    class="fst-italic fw-lighter">(30 detik/s)</span></th>
                            <th class="text-center align-middle" rowspan="2">Nama Operator Pencucian <br> CCP 1<br>
                                <span class="fst-italic fw-lighter">Cleaner name CCP 1</span>
                            </th>
                            <th class="text-center align-middle" rowspan="2">Keterangan<br> <span
                                    class="fst-italic fw-lighter">Remaks</span></th>
                        </tr>
                        <tr>
                            <th class="text-center">Pcs</th>

                            <th class="text-center">Awal/Mulai</th>
                            <th class="text-center">Akhir/Stop</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pencucian as $p)
                            @php
                                $sbw = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->where('nm_partai', 'like', '%' . $p->nm_partai . '%')
                                    ->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->pegawai->nama }}</td>
                                <td>{{ $sbw->no_invoice ?? $p->nm_partai }}</td>
                                <td class="text-end">{{ $p->pcs }}</td>
                                {{-- <td>{{ $p->gr }}</td> --}}
                                <td class="text-end">{{ date('H:i', strtotime($p->start)) }}</td>
                                <td class="text-end">{{ date('H:i', strtotime($p->end)) }}</td>
                                @php
                                    $start = \Carbon\Carbon::parse($p->start);
                                    $end = \Carbon\Carbon::parse($p->end);
                                    $diffInMinutes = $start->diffInMinutes($end);
                                @endphp
                                <td>{{ $diffInMinutes }} menit</td>
                                <td class="text-center">{{ $p->waktu_penyucian }}</td>
                                <td class="text-center">{{ $p->pegawai->nama }}</td>
                                <td></td>
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
