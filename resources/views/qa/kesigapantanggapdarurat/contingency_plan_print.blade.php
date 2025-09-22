<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>dsa</title>
    <style>
        .cop_judul {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;
            /* Atur jarak bawah paragraf pertama */
        }

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
            font-size: 10px
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

        .table th,
        .table td {

            font-size: 10px;
        }

        .table-tes th,
        .table-tes td {

            font-size: 10px;
        }


        .table-judul th,
        .table-judul td {
            padding: 2px;
            font-size: 12px;
            border: 1px solid black;


        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <table class="table-judul mb-3">
                <tr>
                    <td rowspan="6" class="align-middle text-center">
                        <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
                    </td>
                    <td colspan="3" class="dhead">
                        <h4 class="text-center fw-bold"> PT. AGRIKA GATYA ARUM</h4>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="align-middle">
                        <h6 class="text-center fw-bold">KESIGAPAN & TANGGAP DARURAT</h6>
                    </td>
                    <td>
                        No. Dok
                    </td>
                    <td>
                        FRM.QA.05.04
                    </td>
                </tr>
                <tr>
                    <td>
                        Revisi
                    </td>
                    <td>
                        00
                    </td>
                </tr>
                <tr>
                    <td colspan="1" rowspan="2">
                        <div class="text-center fw-bold">CONTINGENCY PLAN</div>
                    </td>
                    <td>
                        Tanggal Efektif
                    </td>
                    <td>
                        {{ tanggal(date('Y-m-d')) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Halaman
                    </td>
                    <td>
                        1 dari 1
                    </td>
                </tr>
            </table>

            <div class="col-lg-12 mt-2">

                <table class="table table-bordered table-sm" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Cases</th>
                            <th class="text-center align-middle">Responsibility & <br> Autority</th>
                            <th class="text-center align-middle">Preparedness</th>
                            <th class="text-center align-middle">Response <br> (If the Cases Come Into Real
                                Condition)</th>
                            <th class="text-center align-middle">Related Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            <tr>
                                <td class="text-end">{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($d->cases)) }}</td>
                                <td>{{ $d->responsibility ?? '' }}</td>
                                <td>{!! nl2br(e($d->preparedness ?? '')) !!}</td>
                                <td>{!! nl2br(e($d->response ?? '')) !!}</td>
                                <td>{!! ucwords(nl2br(e($d->related_documents ?? ''))) !!}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

    <script>
        window.print();
    </script>

</body>

</html>
