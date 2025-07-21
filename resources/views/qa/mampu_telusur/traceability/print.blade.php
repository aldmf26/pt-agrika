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
            font-size: 20px;
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

        th {
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-4">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-12 ">

                <h4 class="cop_judul">Form Ketelusuran (Traceability)
                </h4>
            </div>

            <div class="col-12 ">
                <p class="mt-2 text-center">Dok.No.: FRM.QA.07.01</p>

            </div>
            <div class="d-flex gap-3">
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle text-nowrap">NO URUT</th>
                                <th class="text-center align-middle text-nowrap">TGL PANEN</th>
                                <th class="text-center align-middle text-nowrap">TGL <br> DATANG</th>
                                <th class="text-center align-middle text-nowrap">NO. REG. <br> RUMAH <br> WALET</th>
                                <th class="text-center align-middle text-nowrap">NAMA <br> RUMAH <br> WALET</th>
                                <th class="text-center align-middle text-nowrap">BATCH MATERIAL</th>
                                <th class="text-center align-middle text-nowrap">BERAT <br> KOTOR <br> RAW (KG)</th>
                                <th class="text-center align-middle text-nowrap">BERAT <br> AKHIR <br> GRADING <br> RAW
                                    (KG)
                                </th>
                                <th class="text-center align-middle text-nowrap">SUSUT <br> SORTIR (KG)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $rumah_walet = DB::table('rumah_walet')->where('id', $bk['rwb_id'])->first();
                                @endphp
                                <td class="align-middle text-center">1</td>
                                <td class="align-middle text-center">{{ date('d/m/Y', strtotime($bk['tgl'])) }}</td>
                                <td class="align-middle text-center">
                                    {{ date('d/m/Y', strtotime($bk['tgl'] . ' + 1 day')) }}
                                </td>
                                <td class="align-middle text-center">{{ $rumah_walet->no_reg }}</td>
                                <td class="align-middle text-center">{{ $rumah_walet->nama }}</td>
                                <td class="align-middle text-nowrap">{{ $bk['no_invoice'] }}</td>
                                <td class="align-middle text-center text-nowrap">
                                    {{ number_format($bk['gr_kotor'] / 1000, 2) }} Kg</td>
                                <td class="align-middle text-center text-nowrap">
                                    {{ number_format($bk['gr_awal'] / 1000, 2) }} Kg</td>
                                <td class="align-middle text-center text-nowrap">
                                    {{ number_format(($bk['gr_kotor'] - $bk['gr_awal']) / 1000, 2) }} Kg</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle text-nowrap">BERAT SAAT <br> PEMBAGIAN <br> (Gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">TGL PRODUKSI <br> (PENCABUTAN)</th>
                                <th class="text-center align-middle text-nowrap">JML KEPING AWAL (pcs & gram)</th>
                                <th class="text-center align-middle text-nowrap">BERAT HASIL <br> CABUT & DRYING <br>
                                    (pcs / gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">TANGGAL <br> SELESAI DRYING</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // window.print();
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
