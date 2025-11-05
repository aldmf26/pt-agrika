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
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 7px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .header-info table {
            width: 100%;
        }

        .header-info td {
            padding: 3px;
        }



        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 mt-4">
                <img style="width: 150px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">{{ $title }}</p>
                </div>
            </div>
            <div class="col-3">
                <p class="cop_text text-sm" style="font-size: 10px">{{ $dok }}</p>
            </div>
        </div>
        <div class="header-info">
            <p style="font-size: 8px;">BERI TANDA V UNTUK TIAP KOLOM YANG SESUAI STANDARD DAN TANDA X UNTUK TIAP KOLOM
                YANG
                TIDAK SESUAI STANDAR</p>

            <p style="font-size: 8px;">Jenis Yang diterima : <span class="">SBW KOTOR</span>/<span
                    class="text-decoration-line-through">
                    KEMASAN</span>/<span class="text-decoration-line-through">
                    BARANG</span></p>
            <table class="table table-bordered">

                <tr>
                    <td colspan="2">Tanggal</td>
                    @php
                        $jumlahData = count($checklist);
                        $maxKolom = 9;
                    @endphp

                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">{{ date('d/m/Y', strtotime($c->tgl)) }}
                        </td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor
                </tr>
                <tr>
                    <td colspan="2">Jam Kedatangan</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">15:00</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Kendaraan (Internal / Eksternal)</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">Eksternal</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nomor Kendaraan</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">{{ $c->no_kendaraan }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Suplier</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">{{ $c->nama_suplier }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Ekspedisi</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">{{ $c->nama_suplier }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Pengemudi</td>
                    @foreach ($checklist as $c)
                        <td class="text-center" width="8%" colspan="2">{{ $c->pengemudi }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="100"></td>
                </tr>
                <tr>
                    <th class="text-center">No</th>
                    <th>Kondisi Kendaraan</th>
                    @foreach ($checklist as $c)
                        <th class="text-center">WH</th>
                        <th class="text-center">QA</th>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <th class="text-center">WH</th>
                        <th class="text-center">QA</th>
                    @endfor

                </tr>
                @foreach ($kondisi as $k)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class=" text-nowrap">{{ $k->kondisi }}</td>
                        @foreach ($checklist as $c)
                            <td class="text-center">v</td>
                            <td class="text-center">v</td>
                        @endforeach

                        @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        @endfor

                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <th>KEPUTUSAN DIPAKAI : Ya (Y) atau TIDAK (T)</th>
                    @foreach ($checklist as $c)
                        <td class="text-center" colspan="2">YA</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center"></td>
                    @endfor

                </tr>
                <tr>
                    <td></td>
                    <th>Paraf Pemeriksa</th>
                    @for ($i = 0; $i < $maxKolom; $i++)
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    @endfor

                </tr>
            </table>
        </div>


        <span style="font-size: 7px">
            NOTE : JIKA KONDISI KENDARAAN MEMENUHI SEMUA KETENTUAN TERSEBUT DIATAS DAN KEPUTUSANNYA DIPAKAI MAKA BERIKAN
            TANDA <b>V</b>
            DAN TANDA <b>X</b> JIKA KENDARAAN TERNYATA TIDAK
            DAPAT DIPAKAI / DITOLAK
            LIHAT DETAIL KETERANGAN SETIAP KETENTUAN KONDISI KENDARAAN
        </span>

        <div>
            <table width="100%">
                <tr>
                    <th width="60%" style="border: 1px solid black; " class="align-top">
                        KOMENTAR:
                        {{-- {{ $checklist->komentar }} --}}
                    </th>
                    <td width="25%">

                    </td>
                    <td style="width: 15%">
                        <table class="border-dark table table-bordered" style="font-size: 11px">
                            <thead>
                                <tr>
                                    <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="height: 50px"></td>

                                </tr>
                                <tr>
                                    <td class="text-center">[ KEPALA GUDANG]</td>

                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
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

</body>

</html>
