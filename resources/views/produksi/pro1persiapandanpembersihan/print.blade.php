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
            margin: 15px;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-4">
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-8 mt-4">
                <div class="shapes">
                    <p class="cop_judul">FORM PERSIAPAN DAN FORM SERAH TERIMA <br>
                        SERTA PEMBERSIHAN BAHAN BAKU
                    </p>
                    <p class="text-center fst-italic">raw material preparing and cleaning</p>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-8"></div>
            <div class="col-4 ">
                <p class="mt-2">Dok.No.: FRM.PRO.01.01, Rev.00</p>

            </div>


            <div class="col-12">
                <table>
                    <tr>
                        <td>Hari/Tanggal <br> <span class="fst-italic">date</span> &nbsp;</td>
                        <td width="2%">: </td>
                        <td>&nbsp; {{ tanggal($tanggal) }}</td>
                    </tr>
                    <tr>
                        <td>Nama Petugas Pembagi &nbsp;<br> <span class="fst-italic">Leader name</span> </td>
                        <td width="2%">:</td>

                        <td> &nbsp;{{ $pengawas }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <br>
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="align-middle text-center" rowspan="2">No</th>
                            <th class="align-middle text-center" rowspan="2">Regu/ <br><span
                                    class="fst-italic fw-lighter">Team</span></th>
                            <th class="align-middle text-center" rowspan="2">Nama Operator Cabut<br><span
                                    class="fst-italic fw-lighter">Operator name</span>
                            </th>
                            <th class="align-middle text-center" rowspan="2">Kode Bacth/Lot<br><span
                                    class="fst-italic fw-lighter">Bacth/Lot code</span></th>
                            <th class="align-middle text-center" rowspan="2">Jenis<br><span
                                    class="fst-italic fw-lighter">type</span></th>
                            <th class="align-middle text-center" colspan="2">Jumlah <br><span
                                    class="fst-italic fw-lighter">Quantity</span></th>
                            <th class="align-middle text-center" rowspan="2">Nama Operator <br> Pencucian <br> <span
                                    class="fst-italic fw-lighter">Cleaner
                                    name</span></th>
                            <th class="align-middle text-center" rowspan="2">Keterangan <br><span
                                    class="fst-italic fw-lighter">Remaks</span></th>

                        </tr>
                        <tr>
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gr</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            @php
                                $sbw = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->where('nm_partai', 'like', '%' . $d['nm_partai'] . '%')
                                    ->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengawas }}</td>
                                <td class="text-center">{{ ucwords(strtolower($d['nama'])) }}</td>
                                <td class="text-center">{{ $sbw->no_invoice ?? $d['nm_partai'] }}</td>
                                <td class="text-center">{{ $sbw->nama ?? '-' }}</td>
                                <td class="text-center">{{ $d['pcs'] }}</td>
                                <td class="text-center">{{ $d['gr_awal'] }}</td>
                                <td class="text-center">{{ ucwords(strtolower($d['nama'])) }}</td>
                                <td class="text-center">-</td>
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
