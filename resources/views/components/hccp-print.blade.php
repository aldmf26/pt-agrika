@props(['title', 'dok'])
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
        body {
            font-family: 'Cambria';
        }

        .cop_judul {
            font-size: 12px;
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
            margin-top: 60px;

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

        .head {
            background-color: #D9D9D9 !important;
        }

        .table-xs {
            font-size: 0.75rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .table {
            border: 1px solid #343a40;


        }

        /* @media print {
            @page {
                margin: 1.5cm 1cm 1cm 1cm;
                size: A4;
            }


            .print-wrapper {
                display: table;
                width: 100%;
                border-collapse: separate;
            }

            .repeating-header {
                display: table-header-group;
                position: relative;
            }

            .content-body {
                display: table-row-group;
            }


            .table,
            .table-responsive,
            table {
                display: table !important;
                width: 100% !important;
                border-collapse: collapse !important;
            }

            .table thead,
            table thead,
            .thead-light,
            .thead-dark {
                display: table-header-group !important;
            }

            .table tbody,
            table tbody {
                display: table-row-group !important;
            }

            .table tr,
            table tr {
                display: table-row !important;
                page-break-inside: avoid;
            }

            .table th,
            .table td,
            table th,
            table td {
                display: table-cell !important;
                page-break-inside: avoid;
            }


            .container,
            .container-fluid {
                width: 100% !important;
                max-width: none !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .row {
                display: flex !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .col,
            .col-1,
            .col-2,
            .col-3,
            .col-4,
            .col-5,
            .col-6,
            .col-7,
            .col-8,
            .col-9,
            .col-10,
            .col-11,
            .col-12,
            .col-auto,
            .col-sm,
            .col-md,
            .col-lg,
            .col-xl {
                padding-left: 5px !important;
                padding-right: 5px !important;
            }


            .mt-1,
            .mt-2,
            .mt-3,
            .mt-4,
            .mt-5,
            .mb-1,
            .mb-2,
            .mb-3,
            .mb-4,
            .mb-5,
            .pt-1,
            .pt-2,
            .pt-3,
            .pt-4,
            .pt-5,
            .pb-1,
            .pb-2,
            .pb-3,
            .pb-4,
            .pb-5 {
                margin-top: 5px !important;
                margin-bottom: 5px !important;
                padding-top: 2px !important;
                padding-bottom: 2px !important;
            }


            .page-break {
                page-break-before: always !important;
            }

            .no-break {
                page-break-inside: avoid !important;
            }


            .no-print {
                display: none !important;
            }
        } */
    </style>
</head>

<body>
    <div class="print-wrapper">
        <!-- Header yang berulang di setiap halaman -->
        <div class="repeating-header">
            <div style="padding: 10px; background: white;">
                <div class="container-fluid p-3">
                    <div class="row">
                        <div class="col-3">
                            <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
                        </div>
                        <div class="col-6">
                            <div class="shapes">
                                <p class="cop_judul">{{ $title }}</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <p class="cop_text text-sm" style="font-size: 10px">{{ $dok }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten utama -->
        <div class="content-body">
            <div class="container-fluid p-3">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>


</body>

</html>
