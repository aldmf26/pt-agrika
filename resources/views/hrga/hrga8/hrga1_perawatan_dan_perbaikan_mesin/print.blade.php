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
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">{{ $title }}</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">{{ $no_dokumen }}</p>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered border-dark" style="font-size: 11px; white-space: nowrap;">
                    <thead>
                        <tr>
                            <th class="text-center dhead align-middle" rowspan="2">No</th>
                            <th class=" dhead text-center align-middle" rowspan="2">Lantai</th>
                            <th class=" dhead text-center align-middle" rowspan="2">Nama Item</th>
                            <th class=" dhead text-center align-middle" rowspan="2">Jumlah</th>

                            <th class=" dhead text-center align-middle" rowspan="2">Lokasi</th>
                            <th class=" dhead text-center align-middle" rowspan="2">Frekuensi Perawatan</th>
                            <th class=" dhead text-center align-middle" rowspan="2">Penanggung <br> Jawab</th>
                            <th class="text-center dhead align-middle" colspan="12">Tahun {{ $tahun }}</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                @php
                                    $tgl_bulan = $tahun . '-' . $b->bulan . '-01';
                                @endphp
                                <th class="dhead text-center">{{ date('M', strtotime($tgl_bulan)) }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perawatan as $p)
                            <tr>
                                <td class="text-end">{{ $loop->iteration }}</td>
                                <td class="text-end">{{ ucfirst(strtolower($p->item->lokasi->lantai ?? '-')) }}</td>
                                <td>{{ ucfirst(strtolower($p->item->nama_mesin)) }}</td>
                                <td class="text-end">{{ $p->item->jumlah }}</td>
                                <td>{{ ucfirst(strtolower($p->item->lokasi->lokasi ?? '-')) }}</td>
                                <td class="text-end">{{ $p->frekuensi_perawatan }} bulan</td>
                                <td>{{ ucwords($p->penanggung_jawab) }}</td>
                                @php
                                    $startDate = \Carbon\Carbon::parse($p->tanggal_mulai);
                                    $frekuensi = is_numeric($p->frekuensi_perawatan)
                                        ? (int) $p->frekuensi_perawatan
                                        : 1;
                                    $bulanPerawatan = [];
                                    $currentDate = $startDate->copy();
                                    while ($currentDate->year === $startDate->year) {
                                        $bulanPerawatan[] = $currentDate->month;
                                        $currentDate->addMonths($frekuensi);
                                    }
                                @endphp

                                @foreach ($bulan as $index => $b)
                                    <td class="{{ in_array($index + 1, $bulanPerawatan) ? 'bg-secondary' : '' }}"></td>
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="col-7">

            </div>
            <div class="col-5">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="align-middle text-center">
                                <x-ttd-barcode :id_pegawai="whereTtd('STAFF HRGA')" />
                            </td>

                            <td style="height: 80px" class="align-middle text-center">
                                <x-ttd-barcode :id_pegawai="whereTtd('KEPALA HRGA')" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">(STAFF HRGA)</td>
                            <td class="text-center">(KEPALA HRGA)</td>
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
