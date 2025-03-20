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
            margin: 5px;
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
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">FORM PENGEMASAN AKHIR</p>
                    <p class="text-center fst-italic">Packing</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.PRO.01.11, Rev.00</p>
                <br>
            </div>
            <div class="col-12">
                <table width="100%">
                    <tr style="font-size: 12px">
                        <td>Hari/Tanggal</td>
                        <td width='2%'>:</td>
                        <td>{{ date('l', strtotime($tgl)) }} / {{ tanggal($tgl) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">

                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">No</th>
                            <th rowspan="2" class="text-center">Kode Batch/Lot <br>
                                <span class="fst-italic fw-lighter">Batch/Lot code</span>
                            </th>
                            <th rowspan="2" class="text-center">Jenis Produk <br>
                                <span class="fst-italic fw-lighter">Grade</span>
                            </th>
                            <th colspan="2" class="text-center">Jumlah</th>
                            <th rowspan="2" class="text-center">Tgl/ bln/ thn
                                <br>
                                Produksi
                                <br>
                                (Steaming)
                                <br>
                                <span class="fst-italic fw-lighter">steaming production date (DD/MM/YY)</span>
                            </th>
                            <th rowspan="2" class="text-center">Kemasan<br>
                                <span class="fst-italic fw-lighter">Packaging</span>
                            </th>
                            <th rowspan="2" class="text-center">No Lot Kemasan<br>
                                <span class="fst-italic fw-lighter">Packaging lot no</span>
                            </th>
                            <th rowspan="2" class="text-center">Barcode<br>
                                <span class="fst-italic fw-lighter">Barcode</span>
                            </th>
                            <th rowspan="2" class="text-center">Keterangan<br>
                                <span class="fst-italic fw-lighter">Remarks</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Pcs</th>
                            <th>Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">1001</td>
                            <td class="text-center">D</td>
                            <td class="text-center">50</td>
                            <td class="text-center">500</td>
                            <td class="text-center">01/01/2025</td>
                            <td class="text-center">Mika</td>
                            <td class="text-center">30968</td>
                            <td class="text-center">30001</td>
                            <td class="text-center"></td>
                        </tr>
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
