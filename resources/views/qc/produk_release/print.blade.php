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

        th {
            font-size: 12px !important;
        }

        td {
            font-size: 12px !important;
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
                    <p class="cop_judul">FORM PRODUK RELEASE</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QC.01.05, Rev.00</p>
                <br>

            </div>
            <div class="col-4"></div>

            <div class="col-lg-12">
                <p>Bulan/Tahun : {{ $bulan }}/{{ $tahun }}</p>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Nama dan Kode Jenis Produk (XXXX)</th>
                            <th class="text-center align-middle" width="20%">No Lot SBW : Tgl Bln Panen - Tgl Bln dtg
                                - 2 digit
                                trakhir nomor reg rumah walet</th>
                            <th class="text-center align-middle" width="10%">Kode Produksi (YYMMDD)</th>
                            <th class="text-center align-middle" width="10%">Barcode</th>
                            <th class="text-center align-middle" width="15%">Status Produk (Release/ Hold/ Reject)
                            </th>
                            <th class="text-center align-middle">Petugas Pemeriksa</th>
                            <th class="text-center align-middle">Keterangan </th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($produk_release as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $p['grade'] }}</td>
                                <td></td>
                                @php
                                    $tgls = explode(',', $p['tgl']);
                                @endphp
                                <td class="text-center">
                                    @foreach (explode(',', $p['tgl']) as $tgl)
                                        {{ \Carbon\Carbon::parse($tgl)->format('ymd') }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center" style="white-space: pre-wrap;">{{ $p['barcode'] }}</td>
                                <td class="text-center" style="white-space: pre-wrap;">{{ $p['cek'] }}</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
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
