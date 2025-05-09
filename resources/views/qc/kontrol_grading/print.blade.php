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
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">KONTROL GRADING</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QC.01.17, Rev.00</p>
                <br>

            </div>
            <div class="col-4"></div>
            <div class="col-10">
                <p>Tanggal : {{ tanggal($tgl) }}</p>
            </div>
            <div class="col-lg-12">
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Jam sampling</th>
                            <th class="text-center align-middle">No Lot SBW : Tgl Bln Panen - Tgl Bln dtg - <br> 2 digit
                                trakhir
                                nomor reg rumah walet
                                <br> (Lihat Produksi)
                            </th>
                            <th class="text-center align-middle">Jumlah SBW <br> (Keping/ gr)</th>
                            <th class="text-center align-middle">Jenis (Grade)</th>
                            <th class="text-center align-middle">Ok/Tidak Ok</th>
                            <th class="text-center align-middle">Keterangan</th>
                            <th class="text-center align-middle">Kode Grading : Nomor Urut - Tanggal Bulan Tahun <br>
                                Grading <br> (Lihat di Produksi)</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php
                            $startTime = \Carbon\Carbon::createFromTime(9, 0); // mulai dari jam 09:00
                        @endphp
                        @foreach ($grading as $index => $g)
                            @php
                                $time = $startTime->copy()->addMinutes(floor($index / 9) * 10);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $time->format('H:i') }}</td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $g['pcs'] }}/{{ $g['gr'] }}</td>
                                <td class="text-center">{{ $g['grade'] }}</td>
                                <td class="text-center">Ok</td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    {{ $g['box_pengiriman'] }}-{{ date('dmY', strtotime($g['tgl'])) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-6">

            </div>
            <div class="col-6">
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[QC Final Grading]
                            </td>
                            <td class="text-center">[Leader Final Grading]
                            </td>
                            <td class="text-center">[SPV. Medium Risk]
                            </td>
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
