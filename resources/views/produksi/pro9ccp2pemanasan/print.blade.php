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
            <div class="col-3 mt-4">
                <img style="width: 150px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">FORM PEMANASAN CCP 2</p>
                    <p class="text-center fst-italic">Steaming CCP 2</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.PRO.01.09, Rev.00</p>
                <br>
                <br>
            </div>
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td>Tanggal <br> <span class="fst-italic">date</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ tanggal($ruang->tanggal) }}</td>

                        <td>Suhu ruang<br> <span class="fst-italic">Room temperature</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ $ruang->suhu_ruang }}</td>

                        <td>Mesin Pemanas <br> <span class="fst-italic">Steamer type</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ $ruang->mesin_pemanasan }}</td>
                    </tr>
                    <tr>
                        <td>Suhu sarang walet awal <br> <span class="fst-italic">Material
                                temperature</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ $ruang->suhu_sarang_walet_awal }} °C</td>
                        <td>Penambahan air <br> <span class="fst-italic">Adding water
                                temperature</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ $ruang->penambahan_air }} </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <br>
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">#</th>
                            <th rowspan="2" class="text-center align-middle">Penampaan <br> <span
                                    class="fst-italic fw-lighter">Tray</th>
                            <th rowspan="2" class="text-center align-middle">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot code
                            </th>
                            <th rowspan="2" class="text-center align-middle">Jenis <br> <span
                                    class="fst-italic fw-lighter">Type</th>
                            <th colspan="2" class="text-center align-middle">Jumlah <br> <span
                                    class="fst-italic fw-lighter">Quantity</th>
                            <th rowspan="2" class="text-center align-middle">Tventing (°C) </th>
                            <th rowspan="2" class="text-center align-middle">Tventing (mnt) </th>
                            <th rowspan="2" class="text-center align-middle">Ttot (°C) </th>
                            <th rowspan="2" class="text-center align-middle">Ttot (mnt) </th>
                            <th rowspan="2" class="text-center align-middle">Petugas pengecekan (paraf) </th>
                            <th rowspan="2" class="text-center align-middle">Keterangan </th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle">Pcs</th>
                            <th class="text-center align-middle">Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemanasan as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $p->tray }}</td>
                                <td class="text-center">{{ $p->kode_batch }}</td>
                                <td class="text-center">{{ $p->jenis }}</td>
                                <td class="text-center">{{ $p->pcs }}</td>
                                <td class="text-center">{{ $p->gr }}</td>
                                <td class="text-center">{{ $p->tventing_c }}</td>
                                <td class="text-center">{{ $p->tventing_mnt }}</td>
                                <td class="text-center">{{ $p->ttot_c }}</td>
                                <td class="text-center">{{ $p->ttot_mnt }}</td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $p->keterangan }}</td>
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
