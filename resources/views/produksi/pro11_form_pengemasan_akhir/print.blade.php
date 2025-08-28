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
            margin-bottom: 4px;
            /* Atur jarak bawah paragraf pertama */

        }

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
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

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #41464b !important;
        }

        thead th {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-2">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6"></div>
            <div class="col-4 ">
                <p class="mt-2">No Dok : FRM.PRO.01.11, Rev 00</p>
            </div>

            <div class="col-12 ">
                <p class="cop_judul">FORM PENGEMASAN AKHIR </p>
                <p class="cop_bawah text-center">Packing</p>
            </div>

            <div class="col-6">
                <table width="100%">
                    <tr style="font-size: 12px">
                        <td>Hari/Tanggal</td>
                        <td width='2%'>:</td>
                        <td>{{ tanggal($tgl) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">

                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">No</th>
                            <th rowspan="2" class="text-start align-middle">Jenis material<br>
                                <span class="fst-italic fw-lighter">Material Type</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">Kode Batch/Lot<br>
                                <span class="fst-italic fw-lighter">Batch/Lot code</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">Jenis Produk<br>
                                <span class="fst-italic fw-lighter">Grade</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">Jenis Kemasan <br>
                                <span class="fst-italic fw-lighter">Packaging Type</span>
                            </th>
                            <th rowspan="2" class="text-end align-middle">Jumlah Per Jenis Kemasan <br>
                                <span class="fst-italic fw-lighter">Total Packing type</span>
                            </th>
                            <th colspan="2" class="text-center align-middle">Jumlah<br>
                                <span class="fst-italic fw-lighter">Quantity</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">Tgl/ <br> bln/<br> thn <br>
                                Produksi
                                (Steaming) <br>
                                <span class="fst-italic fw-lighter">steaming production date </span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">No Batch Kemasan <br>
                                <span class="fst-italic fw-lighter">Packaging batch no</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle" width="10%">Barcode
                                <br>
                                <span class="fst-italic fw-lighter">Barcode</span>
                            </th>
                            <th rowspan="2" class="text-start align-middle">Keterangan
                                <br>
                                <span class="fst-italic fw-lighter">Remaks</span>
                            </th>

                        </tr>
                        <tr>
                            <th class="text-end align-middle">Pcs</th>
                            <th class="text-end align-middle">Gr</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($pengiriman_akhir as $p)
                            @php
                                $rawPartai = $p['nm_partai'];
                                $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                                $partaiArray = array_map('trim', explode(',', $cleaned));
                                $sbwList = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->whereIn('nm_partai', $partaiArray)
                                    ->get();

                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-start align-middle">
                                    {!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}
                                </td>
                                <td class="text-start align-middle text-nowrap">
                                    {!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
                                <td class="text-start align-middle">{{ $p['grade'] }}</td>
                                <td class="text-start align-middle">
                                    {{ $p['grade'] == 'sbt' ? 'Plastik Mika (21,8 x 16,8 x 10 cm)' : 'Plastik Mika (21,8 x 16,8 x 7,7 cm)' }}
                                </td>
                                <td class="text-end align-middle">1</td>

                                <td class="text-end align-middle">{{ number_format($p['pcs'], 0) }}</td>
                                <td class="text-end align-middle">{{ number_format($p['gr'], 0) }}</td>
                                <td class="text-start align-middle">
                                    {{ date('d/m/Y', strtotime('-1 day', strtotime($tgl))) }}</td>
                                <td class="text-start align-middle">
                                    {{ $p['grade'] == 'sbt' ? '02-07-2025-01-07-27' : '02-07-2025-02-07-27' }}
                                </td>
                                <td class="text-start align-middle">
                                    <div style="height: 60px; display: flex; align-items: center; ">
                                        {{ $p['no_barcode'] }}
                                    </div>
                                </td>
                                <td class="text-start"></td>
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
