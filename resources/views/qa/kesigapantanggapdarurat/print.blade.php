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

        thead th {
            text-transform: capitalize;
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
            {{-- <div class="col-2 mt-2">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6"></div>
            <div class="col-4 ">
                <p class="mt-2" style="font-size: 10px">No Dok : FRM.PRO.01.01, Rev 00</p>
            </div>
            <div class="col-12 ">
                <p class="cop_judul">FORM PERSIAPAN DAN FORM SERAH TERIMA <br>
                    SERTA PEMBERSIHAN BAHAN BAKU
                </p>
                <p class="cop_bawah text-center">raw material preparing, handover and cleaning</p>
            </div> --}}
            <table class="table-judul">
                <tr>
                    <td rowspan="6" class="align-middle text-center">
                        <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
                    </td>
                    <td colspan="3" class="dhead">
                        <h4 class="text-center fw-bold"> PT. AGRIKA GATYA ARUM</h4>
                    </td>
                </tr>
                <tr>
                    <td rowspan="4" class="align-middle">
                        <h6 class="text-center fw-bold">LAPORAN KESIGAPAN & TANGGAP DARURAT</h6>
                    </td>
                    <td>
                        No. Dok
                    </td>
                    <td>
                        FRM.QA.05.01
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
                    <td>
                        Tanggal Efektif
                    </td>
                    <td>
                        {{ tanggal('2025-07-17') }}
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

            <div class="col-12 mt-2">
                <table class="table-tes" width="70%">
                    <tr>
                        <td>Tanggal</td>
                        <td class="align-middle"> : {{ tanggal($kesigapan->tgl) }}</td>

                    </tr>
                    <tr>
                        <td>Jenis Insiden</td>
                        <td class="align-middle"> : {{ $kesigapan->jenis_insiden }}</td>

                    </tr>
                    <tr>
                        <td>Penyebab</td>
                        <td class="align-middle"> : {{ ucfirst(strtolower($kesigapan->penyebab)) }}</td>

                    </tr>
                    <tr>
                        <td>Akibat</td>
                        <td class="align-middle"> : {{ ucfirst(strtolower($kesigapan->akibat)) }}</td>

                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td> : {{ \Carbon\Carbon::parse($kesigapan->dari_jam)->format('H:i A') }} -
                            {{ \Carbon\Carbon::parse($kesigapan->sampai_jam)->format('H:i A') }}</td>
                    </tr>
                    <tr>
                        <td>Kejadian</td>
                        <td>
                            <input type="checkbox" name="" id=""
                                {{ $kesigapan->kejadian == 'tidak disengaja' ? 'checked' : '' }}> Tidak Disengaja

                            <input class="ms-3" type="checkbox" name="" id=""
                                {{ $kesigapan->kejadian == 'disengaja' ? 'checked' : '' }}> Disengaja
                        </td>
                        <td></td>
                    </tr>

                </table>
            </div>
            <div class="col-lg-12 mt-2">

                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="align-middle text-center" rowspan="2">Lokasi</th>
                            <th class="align-middle text-center" colspan="2">Korban</th>
                            <th class="align-middle text-center" colspan="2">Kerugian Material</th>
                            <th class="align-middle text-center" rowspan="2">Potensi Bahaya Pada Produk</th>
                            <th class="align-middle text-center" rowspan="2">Tindakan <br> Pengendalian</th>
                            <th class="align-middle text-center" rowspan="2" width="100px">PIC</th>

                        </tr>
                        <tr>
                            <th class=" text-center">Cedera</th>
                            <th class=" text-center">Meninggal</th>
                            <th class=" text-center">Infrastruktur</th>
                            <th class=" text-center">Produk</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            <tr>
                                <td class="text-nowrap align-middle">{{ $d->lokasi }}</td>
                                <td class="text-nowrap align-middle">{{ $d->cedera }}</td>
                                <td class="text-nowrap align-middle">{{ $d->meninggal }}</td>
                                <td class="text-nowrap align-middle">{{ $d->infrastruktur }}</td>
                                <td class="text-nowrap align-middle">{{ $d->produk }}</td>
                                <td class="align-middle">{{ $d->potensi_bahaya }}</td>
                                <td class="align-middle">{{ $d->tindakan }}</td>
                                <td class="text-nowrap align-middle">{{ $d->pic }}</td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="25%">Dilaporkan Oleh:</th>
                            <th class="text-center" width="25%">Diketahui & Disetujui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('Kepala Lab & FSTL')" />
                            </td>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('Kepala direktur')" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                (Kepala Lab & FSTL)
                            </td>
                            <td class="text-center align-middle">
                                (KEPALA DIREKTUR)
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
