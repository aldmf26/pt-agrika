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
                    <p class="cop_judul">FORM HARIAN PEMILAHAN AKHIR</p>
                    <p class="text-center fst-italic">Daily final grading</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.PRO.01.07, Rev.00</p>
                <br>
                <br>
            </div>
            <div class="col-4"></div>
            <div class="col-10">
                <table style="border-collapse: collapse; width: 100%;">
                    <tr>
                        <td style="padding: 8px; width: 20%;">Hari / Tanggal <br> <span class="fst-italic">date</span>
                        </td>
                        <td style="padding: 8px; width: 2%;" class="align-middle">:</td>
                        <td style="padding: 8px;" class="align-middle">{{ tanggal($tgl) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; width: 20%;">Kode Batch/Lot
                            <br> <span class="fst-italic"> Batch/Lot code </span>
                        </td>
                        <td style="padding: 8px; width: 2%;" class="align-middle">:</td>
                        <td style="padding: 8px;" class="align-middle">{{ $kode_lot }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; width: 20%;">Jenis Material
                            <br> <span class="fst-italic"> Material type </span>
                        </td>
                        <td style="padding: 8px; width: 2%;" class="align-middle">:</td>
                        <td style="padding: 8px;" class="align-middle">{{ $grade }}</td>
                    </tr>
                </table>

            </div>
            <div class="col-lg-12">
                <br>

                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th rowspan="3" class="text-center align-middle">No</th>
                            <th rowspan="3" class="text-center align-middle">Jenis Produk<br><span
                                    class="fst-italic fw-lighter">Grade<span></th>
                            <th colspan="4" class="text-center align-middle">Kondisi Produk<br><span
                                    class="fst-italic fw-lighter">Product condition<span>
                            </th>
                            <th rowspan="3" class="text-center align-middle">Jumlah Box</th>
                            <th rowspan="3" class="text-center align-middle">Keterangan<br><span
                                    class="fst-italic fw-lighter">Remarks<span></th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="2">Ok</th>
                            <th class="text-center" colspan="2">Not Ok</th>
                        </tr>
                        <tr>
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gram</th>
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gram</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grading as $g)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $g['grade'] }}</td>
                                <td class="text-center">{{ $g['pcs'] }}</td>
                                <td class="text-center">{{ $g['gr'] }}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">{{ $g['box'] }}</td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="col-9">


            </div>
            <div class="col-3">
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>

                        </tr>
                        <tr>
                            <td class="text-center">KA. GRADING</td>

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
