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
                            <th colspan="5"></th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">No Dok : FRM.PRO.01.07,
                                    Rev 00</p>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">
                                <p class="cop_judul">FORM HARIAN PEMILAHAN AKHIR</p>
                                <p class="cop_bawah text-center">Daily final grading</p>
                            </th>
                        </tr>
                        <tr>
                            <td>Hari / Tanggal <br> <span class="fst-italic">date</span>
                            </td>
                            <td class="align-middle"> : {{ tanggal($tgl) }}</td>

                        </tr>
                        <tr>
                            <td>Kode Batch/Lot
                                <br> <span class="fst-italic"> Batch/Lot code </span>
                            </td>

                            <td colspan="2" class="align-middle"> : {{ $kode_lot }}</td>


                            <td></td>
                            <td class="table-bawah2">Pcs Awal</td>
                            <td class="table-bawah2">Gram Awal</td>
                            <td class="table-bawah2">Pcs Akhir</td>
                            <td class="table-bawah2">Gr Akhir</td>
                        </tr>
                        <tr>
                            <td>Jenis Material
                                <br> <span class="fst-italic"> Material type </span>
                            </td>
                            <td class="align-middle"> : {{ $grade }}</td>
                            <td></td>
                            <td></td>
                            <td class="table-bawah2">{{ sumBk($grading, 'pcs') }}</td>
                            <td class="table-bawah2">{{ sumBk($grading, 'gr') }}</td>
                            <td class="table-bawah2">Pcs Akhir</td>
                            <td class="table-bawah2">Gr Akhir</td>
                        </tr>
                        <tr class="table-bawah">
                            <th rowspan="3" class="text-center align-middle">No</th>
                            <th rowspan="3" class="text-center align-middle">Jenis Produk<br><span
                                    class="fst-italic fw-lighter">Grade<span></th>
                            <th colspan="4" class="text-center align-middle">Kondisi Produk<br><span
                                    class="fst-italic fw-lighter">Product condition<span>
                            </th>
                            <th rowspan="3" class="text-center align-middle">Jumlah Box</th>
                            <th rowspan="3" class="text-center align-middle">Keterangan<br><span
                                    class="fst-italic fw-lighter">Remarks<span></th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center" colspan="2">Ok</th>
                            <th class="text-center" colspan="2">Not Ok</th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gram</th>
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gram</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grading as $g)
                            <tr class="table-bawah">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $g['grade'] }}</td>
                                <td class="text-center">{{ $g['not_oke'] == 'Y' ? 0 : $g['pcs'] }}</td>
                                <td class="text-center">{{ $g['not_oke'] == 'Y' ? 0 : $g['gr'] }}</td>
                                <td class="text-center">{{ $g['not_oke'] == 'Y' ? $g['pcs'] : 0 }}</td>
                                <td class="text-center">{{ $g['not_oke'] == 'Y' ? $g['gr'] : 0 }}</td>
                                <td class="text-center">{{ $g['box'] }}</td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="8">&nbsp;</th>
                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="6"></th>
                            <th class="text-center" colspan="2">Dibuat Oleh:</th>
                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="6"></th>
                            <td style="height: 40px" colspan="2"></td>

                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="6"></th>
                            <td class="text-center" colspan="2">KA. GRADING</td>

                        </tr>
                    </tfoot>

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
