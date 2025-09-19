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
        * {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
        }

        .cop_judul {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin: 15px;
        }

        .shapes {
            border: 1px solid black;
            border-radius: 10px;
        }

        .cop_text {
            font-size: 11px;
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

        .table-bordered td,
        .table-bordered th {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 mt-2">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">CEKLIST PERAWATAN MESIN & PERALATAN</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text text-nowrap">Dok.No.: FRM.HRGA.08.02, Rev.00</p>
            </div>
            <div class="col-4">
                <table style="font-size: 10px">
                    <tr>
                        <td>Lokasi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->lokasi->lantai) }}</td>
                    </tr>
                    <tr>
                        <td>Nama Mesin / Peralatan</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->nama_mesin) }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->lokasi->lokasi) }}</td>
                    </tr>
                    <tr>
                        <td>Frekuensi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($perawatan->frekuensi_perawatan) }} Bulan</td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($perawatan->penanggung_jawab) }}</td>
                    </tr>


                </table>
            </div>
            <div class="col-lg-12">

                <table class="table table-bordered" style="font-size: 10px">
                    <thead>
                        <tr style="text-transform: capitalize">
                            <th class="align-middle dhead text-center">No</th>
                            <th class="align-middle dhead text-center">Tanggal</th>
                            <th class="align-middle dhead text-center">Urutan Unit</th>
                            <th class="align-middle dhead text-center">Kriteria <br> pemeriksaan</th>
                            <th class="align-middle dhead text-center">Metode</th>
                            <th class="align-middle dhead text-center">Hasil Pemeriksaan</th>
                            <th class="align-middle dhead text-center">Status</th>
                            <th class="align-middle dhead text-center" width="15%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Hitung berapa kali kombinasi (tgl + mesin) muncul
                            $grouped = [];
                            foreach ($checklist as $item) {
                                $key = $item->tgl . '-' . $mesin->id;
                                if (!isset($grouped[$key])) {
                                    $grouped[$key] = 0;
                                }
                                $grouped[$key]++;
                            }
                        @endphp

                        @php $printed = []; @endphp

                        @foreach ($checklist as $c)
                            @php $key = $c->tgl . '-' . $mesin->id; @endphp
                            <tr>
                                <td class="align-middle text-end">{{ $loop->iteration }}</td>
                                <td class="text-nowrap text-end align-middle">{{ tanggal($c->tgl) }}</td>

                                {{-- Cek apakah kombinasi ini sudah dicetak --}}
                                @if (!in_array($key, $printed))
                                    <td class="align-middle" rowspan="{{ $grouped[$key] }}">
                                        {{ $mesin->nama_mesin }}
                                        {{ empty($mesin->jumlah) ? 1 : '1 sampai ' . $mesin->jumlah }}
                                    </td>
                                    @php $printed[] = $key; @endphp
                                @endif

                                <td class="align-middle">{{ $c->kriteria->kriteria }}</td>
                                <td class="align-middle">{{ $c->metode }}</td>
                                <td class="align-middle">{{ $c->hasil_pemeriksaan }}</td>
                                <td class="align-middle">{{ $c->status }}</td>
                                <td class="align-middle">{{ $c->keterangan }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="col-6">

            </div>
            <div class="col-6">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                    &
                                    Nama)</span></td>

                            <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                    &
                                    Nama)</span></td>
                        </tr>
                        <tr>
                            <td class="text-center">(KA. MAINTENANCE)</td>
                            <td class="text-center">(KA. HRGA)</td>

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
