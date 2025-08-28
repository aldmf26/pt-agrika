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
                <img style="width: 150px" src="{{ asset('assets/img/logo_agrika.png') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">PROGRAM KALIBRASI SARANA PEMANTAUAN DAN PENGUKURAN</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text float-end">Dok.No.: FRM.HRGA.09.01, Rev.00</p>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered text-nowrap">
                    <thead>
                        <tr style="text-transform: capitalize">
                            <th rowspan="2" class="align-middle dhead">No</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Nama Alat Ukur</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Merek</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Type / Nomor seri</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Lokasi</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Frekuensi kalibrasi</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Rentang Min-Maks</th>
                            <th rowspan="2" class="text-nowrap align-middle dhead">Resolusi</th>
                            <th colspan="12" class="text-center dhead">Tahun {{ $tahun }}</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                <th class="dhead">{{ substr($b->nm_bulan, 0, 3) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->item_kalibrasi->name }}</td>
                                <td>{{ $p->item_kalibrasi->merk }}</td>
                                <td>{{ $p->item_kalibrasi->nomor_seri }}</td>
                                <td>{{ $p->item_kalibrasi->lokasi->lokasi ?? '-' }}</td>
                                <td>{{ $p->frekuensi }}</td>
                                <td>{{ $p->rentang }}</td>
                                <td>{{ $p->resolusi }}</td>
                                @foreach ($bulan as $b)
                                    <td class="{{ $p->bulan == $b->bulan ? 'bg-secondary' : '' }}"></td>
                                @endforeach

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
                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[SPV. GA-IR]</td>
                            <td class="text-center">[KA. HRGA]</td>
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
