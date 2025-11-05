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
            margin-top: 50px;

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
                    <p class="cop_judul">FORM RETAIN SAMPLE</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QC.01.08, Rev.00</p>
                <br>
                <br>
                <br>
            </div>

            <div class="col-8">
                <table width="100%">
                    <tr>
                        <td>Retain Sampel</td>
                        <td>: {{ $head->retain_sampel }}</td>
                        <td>Standard kebutuhan sample</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        @php
                            use Carbon\Carbon;

                            $hariKe = Carbon::parse($head->tgl)
                                ->startOfDay()
                                ->diffInDays(now()->startOfDay());
                        @endphp
                        <td>Hari Ke</td>
                        <td>:
                            {{ $hariKe }} (coret jika sudah dilakukan)
                        </td>
                        <td>Bulan</td>
                        <td>:
                            @foreach ($bulan as $b)
                                {!! $b != $head->standar_kebutuhan ? "<del>$b</del>" : $b !!} @if (!$loop->last)
                                    /
                                @endif
                            @endforeach
                            (coret yang tidak perlu)
                        </td>
                    </tr>
                </table>
            </div>


            <div class="col-lg-12">
                <br>
                <table class="table table-bordered" style="font-size: 11px">

                    <thead>
                        <tr>
                            <th class="text-center align-middle" rowspan="2">No</th>
                            <th class="text-center align-middle" rowspan="2">Production Date</th>
                            <th class="text-center align-middle" rowspan="2">Expired Date</th>
                            <th class="text-center align-middle" colspan="3">Organoleptic</th>
                            <th class="text-center align-middle">Kimia</th>
                            <th class="text-center align-middle" rowspan="2">Dicek oleh (paraf)</th>
                            <th class="text-center align-middle" rowspan="2">Keterangan dan Tindakan Koreksi</th>
                        </tr>
                        <tr>
                            <th class="text-center">Warna (1 sd 4)</th>
                            <th class="text-center">Bau (1 sd 4)</th>
                            <th class="text-center">Tekstur (1 sd 4)</th>
                            <th class="text-center">Kandungan Nitrit (ppm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $d->production_date }}</td>
                                <td class="text-center">{{ $d->expired_date }}</td>
                                <td class="text-center">{{ $d->warna }}</td>
                                <td class="text-center">{{ $d->bau }}</td>
                                <td class="text-center">{{ $d->tekstur }}</td>
                                <td class="text-center">{{ $d->kandungan_nitrit }}</td>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $d->keterangan }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-8">
                <table width="40%">
                    <tr>
                        <td>Ket</td>
                        <td width="50%">:</td>
                    </tr>
                    <tr>
                        <td>Scoring</td>
                        <td width="50%">1 = Sangat sesuai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="50%">2 = Sesuai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="50%">3 = Kurang Sesuai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="50%">4 = Tidak Sesuai</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
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
                        <tr>
                            <td class="text-center">[Spv Lab]
                            </td>
                            <td class="text-center">[KEPALA QA&QC]
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
