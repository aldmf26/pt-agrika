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

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {

            padding: 4px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-4">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-8 mt-4">
                <div class="shapes">
                    <p class="cop_judul">PERMINTAAN PERBAIKAN MESIN PROSES PRODUKSI</p>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-8"></div>
            <div class="col-4 ">
                <p class="cop_text">Dok.No.: FRM.HRGA.08.03, Rev.00</p>
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <table width="100%" style="padding: 90px">
                    <tr>
                        <td width="50%">Nama Mesin Proses Produksi</td>
                        <td width="2%">:</td>
                        <td>{{ $permintaan->item_mesin->nama_mesin }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>{{ $permintaan->item_mesin->lokasi->lokasi }}</td>
                    </tr>
                    {{-- <tr>
                        <td>No Mesin</td>
                        <td>:</td>
                        <td>{{ $permintaan->item_mesin->no_identifikasi }}</td>
                    </tr> --}}
                    <tr>
                        <td>Deadline</td>
                        <td>:</td>
                        <td>{{ tanggal($permintaan->deadline) }}</td>
                    </tr>
                    <tr>
                        <td>Diajukan oleh Bagian</td>
                        <td>:</td>
                        <td>{{ $permintaan->diajukan_oleh }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Deskripsi Masalah</td>
                        <td class="fw-bold">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="height: 90px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                            {{ $permintaan->deskripsi_masalah }}
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-6 mt-4">Diajukan Oleh,</div>
            <div class="col-4 mt-4">Diterima Oleh (Maintenance),</div>
            <div class="col-1"></div>

            <div class="col-1"></div>
            <div class="col-6 mt-4"></div>
            <div class="col-4 mt-4"></div>
            <div class="col-1"></div>
            <div class="col-1"></div>
            <div class="col-6 mt-4"></div>
            <div class="col-4 mt-4"></div>
            <div class="col-1"></div>


            <div class="col-1"></div>
            <div class="col-6 mt-4">Tanggal : {{ tanggal($permintaan->tanggal) }} <br> Pukul :
                {{ date('H:i', strtotime($permintaan->waktu)) }}</div>
            <div class="col-4 mt-4">Tanggal : {{ tanggal($permintaan->tanggal) }} <br> Pukul :
                {{ date('H:i', strtotime($permintaan->waktu)) }}</div>
            <div class="col-1"></div>

            <div class="col-1"></div>
            <div class="col-10 mt-4">
                <table width="100%" style="padding: 90px">
                    <tr>
                        <td width="50%" class="fw-bold">Detail Perbaikan yang Dilakukan</td>
                        <td width="2%" class="fw-bold">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="height: 90px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                            {{ $permintaan->detail_perbaikan ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" class="fw-bold">Serah Terima Hasil Perbaikan:</td>
                        <td width="2%" class="fw-bold">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="50%" class="fw-bold">Verifikasi User:</td>
                        <td width="2%" class="fw-bold">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"
                            style="height: 90px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                            {{ $permintaan->verifikasi_user ?? '-' }}
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-1"></div>

            <div class="col-1"></div>
            <div class="col-10 mt-4">
                <table width="100%" border="1" class=" table table-bordered">
                    <tr>
                        <th class="dhead text-center">Diserahkan oleh (General Maintenance),</th>
                        <th class="dhead text-center">Diterima oleh User,</th>
                    </tr>
                    <tr>
                        <td style="height: 60px"></td>
                        <td style="height: 60px"></td>
                    </tr>
                    <tr>
                        <td>Tanggal
                            {{ empty($permintaan->tanggal) ? '' : tanggal(date('Y-m-d', strtotime($permintaan->tanggal))) }}
                        </td>
                        <td>Tanggal
                            {{ empty($permintaan->tanggal) ? '' : tanggal(date('Y-m-d', strtotime($permintaan->tanggal))) }}
                        </td>
                    </tr>
                    <tr>
                        <td>Pukul
                            {{ \Carbon\Carbon::parse($permintaan->waktu)->addHours(2)->format('H:i') }}
                        </td>
                        <td>Pukul
                            {{ \Carbon\Carbon::parse($permintaan->waktu)->addHours(2)->format('H:i') }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-1"></div>






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
