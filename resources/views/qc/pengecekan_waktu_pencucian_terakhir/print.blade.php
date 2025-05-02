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
                    <p class="cop_judul">FORM PENGECEKAN WAKTU PENCUCIAN TERAKHIR</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QC.01.04, Rev.01</p>
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
                            <th class="text-center align-middle">Kode Cabut Bulu : No Urut - Tanggal Bulan dan Tahun
                                Cabut Bulu </th>
                            <th class="text-center align-middle">No Lot SBW : Tgl Bln Panen - Tgl Bln dtg - 2 digit
                                trakhir nomor reg rumah walet</th>
                            <th class="text-center align-middle text-nowrap" style="">Jumlah (pcs / gram)</th>
                            <th class="text-center align-middle">Jenis (Grade)</th>
                            <th class="text-center align-middle">Waktu mulai</th>
                            <th class="text-center align-middle">Waktu akhir</th>
                            <th class="text-center align-middle">Total waktu</th>
                            <th class="text-center align-middle text-nowrap">Kesimpulan <br> (OK / TIDAK)</th>
                            <th class="text-center align-middle">Ttd Petugas Penguji (PRD)</th>
                            <th class="text-center align-middle">Ttd Verifikator (QC)</th>
                            <th class="text-center align-middle">Kode Pencucian Nitrit : No Urut - Tanggal Bulan dan
                                Tahun Pencucian Nitrit</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($cabut as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{ $c['no_box'] }}-{{ date('dmY', strtotime($c['tgl_terima'])) }}</td>
                                <td></td>
                                <td class="text-center">{{ $c['pcs_awal'] }}/{{ $c['gr_awal'] }}</td>
                                <td class="text-center">{{ $c['tipe'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
