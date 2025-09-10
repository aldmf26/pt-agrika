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
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;

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

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
            font-size: 10px;
            font-weight: normal
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

        .table th,
        .table td {

            font-size: 10px;
        }

        .table-tes th,
        .table-tes td {

            font-size: 10px;
        }

        .table-bawah th,
        .table-bawah td {
            border: 1px solid black;
            padding: 4px;
            /* ⬅️ Padding kecil, bisa juga pakai 2px */
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;
            /* agar teks tidak turun ke bawah */
        }


        @media print {
            @page {
                size: A4 landscape;
                margin-top: 20mm;
                /* jarak atas semua halaman */
                margin-bottom: 15mm;
                margin-left: 15mm;
                margin-right: 15mm;
            }

            body {
                margin: 0;
            }

            /* Biar tabel nggak pecah aneh */
            table {
                page-break-inside: avoid;
            }

            /* Kalau mau mulai halaman baru + jarak atas */
            .page-break {
                page-break-before: always;
                padding-top: 20mm;
                /* jarak dari header halaman */
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-2 mt-2">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6"></div>
            <div class="col-4 ">
                <p class="mt-2">No Dok : FRM.PRO.01.10, Rev 00</p>
            </div>
            <div class="col-12 ">
                <p class="cop_judul">FORM PENIMBANGAN HASIL PRODUKSI</p>
                <p class="cop_bawah text-center">Production results</p>
            </div>
            <div class="col-6">
                <table width="100%">
                    <tr>
                        <td>Hari / Tanggal <br> <span class="fst-italic">date</span></td>
                        <td width='4%'>&nbsp;&nbsp;:</td>
                        <td>{{ tanggal($tgl) }}</td>
                    </tr>
                </table>
            </div> --}}
            <div class="col-lg-12">


                <table width="100%" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="align-top"><img style="width: 80px" src="{{ asset('img/logo.jpeg') }}"
                                    alt=""></th>

                            <th colspan="7">
                                <p class="cop_judul text-center">FORM PENIMBANGAN HASIL PRODUKSI</p>
                                <p class="cop_bawah text-center">Production results</p>
                            </th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">No Dok : FRM.PRO.01.10,
                                    Rev 00</p>
                            </th>

                        </tr>
                        {{-- <tr>
                            <th colspan="10">

                            </th>
                        </tr> --}}
                        <tr>
                            <td>Hari / Tanggal <br> <span class="fst-italic">date</span></td>
                            <td>&nbsp; : {{ tanggal($tgl) }}</td>
                        </tr>

                        <tr class="table-bawah">
                            <th rowspan="2" class="text-center align-middle">No</th>
                            <th rowspan="2" class="text-start align-middle">Jenis material <br> <span
                                    class="fst-italic fw-lighter align-middle">Material type</span></th>
                            <th rowspan="2" class="text-start align-middle">Kode Batch/Lot
                                <br> <span class="fst-italic fw-lighter">Batch/Lot code</span>
                            </th>
                            <th colspan="2" class="text-center align-middle">Jumlah
                            </th>
                            <th rowspan="2" class="text-start align-middle">Jenis Produk <br> <span
                                    class="fst-italic fw-lighter align-middle">Grade</span></th>
                            <th colspan="3" class="text-center align-middle">Jumlah <br> <span
                                    class="fst-italic fw-lighter align-middle">Quantity</span> </th>
                            <th rowspan="2" class="text-start align-middle">Keterangan <br> <span
                                    class="fst-italic fw-lighter align-middle">Remarks</span></th>

                        </tr>
                        <tr class="table-bawah">
                            <th class="text-end">Pcs</th>
                            <th class="text-end">Gram</th>
                            <th class="text-end">Pcs</th>
                            <th class="text-end">Gram</th>
                            <th class="text-end">Box</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($penimbangan as $i)
                            @php
                                $rawPartai = $i['nm_partai'];
                                $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                                $partaiArray = array_map('trim', explode(',', $cleaned));
                                $sbwList = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->whereIn('nm_partai', $partaiArray)
                                    ->get();
                            @endphp
                            <tr class="table-bawah">

                                <td class="text-center align-middle">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="text-start align-middle">
                                    {!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}
                                </td>
                                <td class="text-start align-middle">
                                    {!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}
                                </td>
                                <td class="text-end align-middle">{{ number_format($i['pcs'], 0) }}</td>
                                <td class="text-end align-middle">{{ number_format($i['gr'], 0) }}</td>

                                <td class="text-start align-middle ">
                                    {{ strtoupper($i['grade']) }}
                                </td>
                                <td class="text-end align-middle">
                                    {{ number_format($i['pcs'], 0) }}
                                </td>
                                <td class="text-end align-middle">
                                    {{ number_format($i['gr'], 0) }}
                                </td>
                                <td class="text-end align-middle">
                                    {{ number_format($i['box'], 0) }}
                                </td>
                                <td></td>


                            </tr>
                        @endforeach


                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th colspan="13">&nbsp;</th>
                        </tr>
                        <tr class="table-bawah">

                            <th style="border: none; text-align: start" colspan="5"></th>
                            <th class="text-center" colspan="3">Dibuat Oleh:</th>
                            <th class="text-center" colspan="2">Diperiksa Oleh:</th>
                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="5"></th>
                            <td colspan="3" style="height: 80px; text-align: center; vertical-align: bottom;">
                                KA.PACKING</td>
                            <td colspan="2" style="height: 80px; text-align: center; vertical-align: bottom;">QC
                                PACKING</td>
                        </tr>

                    </tfoot> --}}

                </table>
            </div>

            <div class="col-7">


            </div>
            <div class="col-5">
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px; text-align: center; vertical-align: bottom;">
                                KA.PACKING
                            </td>
                            <td style="height: 80px; text-align: center; vertical-align: bottom;">
                                QC PACKING
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
