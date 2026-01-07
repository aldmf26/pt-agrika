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
            padding: 0.5rem;
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;
            /* ⬅️ ini agar tidak membungkus teks */
        }

        .table-bawah2 {
            border: 1px solid black;
            padding: 0.5rem;
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;
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
                <p class="mt-2">No Dok : FRM.PRO.01.07, Rev 00</p>
            </div>
            <div class="col-12 ">

                <p class="cop_judul">FORM HARIAN PEMILAHAN AKHIR</p>
                <p class="text-center cop_bawah">Daily final grading</p>

            </div>

            <div class="col-4"></div> --}}
            {{-- <div class="col-12">
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

            </div> --}}
            <div class="col-lg-12 mt-2">
                <table width="100%" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="align-top"><img style="width: 80px" src="{{ asset('img/logo.jpeg') }}"
                                    alt=""></th>
                            <th colspan="6"></th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">Dok.No.: FRM.PROS.01.05,
                                    Rev 00</p>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="9" class="text-center">
                                <p class="cop_judul">FORM HARIAN PEMILAHAN AKHIR</p>
                                <p class="cop_bawah text-center">Daily Final Grading</p>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">Hari / Tanggal <br> <span class="fst-italic">Date</span>
                            </td>
                            <td colspan="2" class="align-middle"> : {{ tanggal($tgl) }}</td>

                        </tr>
                        <tr>
                            <td colspan="2">Kode Batch/Lot
                                <br> <span class="fst-italic"> Batch/Lot Code </span>
                            </td>

                            <td class="align-middle" colspan="3"> : {{ $kode_lot }}</td>



                            <th class="table-bawah2">Pcs Ok</th>
                            <th class="table-bawah2">Gr Ok</th>
                            <th class="table-bawah2">Pcs Not Ok</th>
                            <th class="table-bawah2">Gr Not Ok</th>
                        </tr>
                        <tr>
                            @php
                                $pcsNotOkeT = collect($grading)->where('not_oke', 'Y')->sum('pcs');
                                $pcsNotOkeY = collect($grading)->where('not_oke', 'T')->sum('pcs');

                                $grNotOkeT = collect($grading)->where('not_oke', 'Y')->sum('gr');
                                $grNotOkeY = collect($grading)->where('not_oke', 'T')->sum('gr');
                            @endphp
                            <td colspan="2">Jenis Material
                                <br> <span class="fst-italic"> Material Type </span>
                            </td>
                            <td class="align-middle" colspan="3"> : {{ strtoupper($grade) }}</td>


                            <td class="table-bawah2 text-end">{{ number_format($pcsNotOkeY, 0) }}</td>
                            <td class="table-bawah2 text-end">{{ number_format($grNotOkeY, 0) }}</td>
                            <td class="table-bawah2 text-end">{{ number_format($pcsNotOkeT, 0) }}</td>
                            <td class="table-bawah2 text-end">{{ number_format($grNotOkeT, 0) }}</td>
                        </tr>
                        <tr class="table-bawah">
                            <th rowspan="3" width="1%" class="text-center align-middle">No</th>
                            <th rowspan="3" class="text-center align-middle">Jenis Produk<br><span
                                    class="fst-italic fw-lighter">Grade<span></th>
                            <th colspan="4" class="text-center align-middle">Kondisi Produk<br><span
                                    class="fst-italic fw-lighter">Product condition<span>
                            </th>
                            <th rowspan="3" class="text-center align-middle" width="2%">Jumlah Box</th>
                            <th rowspan="3" class="text-center align-middle" width="2%">Box <br> Grading</th>
                            <th rowspan="3" class="text-center align-middle">Keterangan<br><span
                                    class="fst-italic fw-lighter">Remarks<span></th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center" colspan="2">Ok</th>
                            <th class="text-center" colspan="2">Not Ok</th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center" width="12%">Pcs</th>
                            <th class="text-center" width="12%">Gr</th>
                            <th class="text-center" width="12%">Pcs</th>
                            <th class="text-center" width="12%">Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grading as $g)
                            <tr class="table-bawah">
                                <td class="text-end">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ strtoupper($g['grade']) }}</td>
                                <td class="text-end">{{ $g['not_oke'] == 'Y' ? 0 : number_format($g['pcs'], 0) }}</td>
                                <td class="text-end">{{ $g['not_oke'] == 'Y' ? 0 : number_format($g['gr'], 0) }}</td>
                                <td class="text-end">{{ $g['not_oke'] == 'Y' ? number_format($g['pcs'], 0) : 0 }}</td>
                                <td class="text-end">{{ $g['not_oke'] == 'Y' ? number_format($g['gr'], 0) : 0 }}</td>
                                <td class="text-end">{{ $g['box'] }}</td>
                                <td class="text-end">{{ $g['box_pengiriman'] }}</td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
                <br>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <table width="20%" style="font-size: 11px">
                            <tr>
                                <th colspan="9">&nbsp;</th>
                            </tr>
                            <tr class="table-bawah">
                                <th style="border: none" colspan="7"></th>
                                <th class="text-center" colspan="2">Dibuat Oleh:</th>
                            </tr>
                            <tr class="table-bawah">
                                <th style="border: none" colspan="7"></th>
                                <td style="height: 50px" colspan="2">
                                    <x-ttd-barcode :id_pegawai="whereTtd('KEPALA PACKING & GUDANG FG')" />
                                </td>

                            </tr>
                            <tr class="table-bawah">
                                <th style="border: none" colspan="7"></th>
                                <td class="text-center" colspan="2">(KEPALA PACKING & GUDANG FG)</td>

                            </tr>
                        </table>
                    </div>
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
