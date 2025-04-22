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
                    <p class="cop_judul">AGENDA DAN JADWAL TINJAUAN MANAJEMEN</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QA.03.01, Rev.00</p>
                <br>
                <br>
            </div>
            <div class="col-4"></div>
            <div class="col-10">
                {{-- <table>
                    <tr>
                        <td width="20%">Hari / Tanggal <br> <span class="fst-italic">date</span></td>
                        <td width="2%" class="align-middle">: &nbsp;</td>
                        <td>{{ date('l', strtotime($tanggal)) }} / {{ tanggal($tanggal) }}</td>
                    </tr>
                </table> --}}
            </div>
            <div class="col-lg-12">
                <br>
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center dhead">No</th>
                            <th class="text-center dhead">Hari / Tanggal</th>
                            <th class="text-center dhead">Waktu</th>
                            <th class="text-center dhead">Agenda</th>
                            <th class="text-center dhead">PIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agenda as $a)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ date('l', strtotime($a->tanggal)) }} /
                                    {{ tanggal($a->tanggal) }}</td>

                                <td class="text-center">{{ date('H:i', strtotime($a->dari_jam)) }} -
                                    {{ date('H:i', strtotime($a->sampai_jam)) }}</td>
                                </td>
                                <td class="text-center">{{ $a->agenda }}</td>
                                <td class="text-center">{{ $a->pic }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-5">
                <br>
                <br>
                <br>
                <p>Dibuat Oleh :</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>
</body>

</html>
