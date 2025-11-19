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
            font-size: 20px;
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

        th {
            height: 150px;
        }

        td {
            font-weight: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 mt-4">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-12 ">

                <h4 class="cop_judul">Form Ketelusuran (Traceability)
                </h4>
            </div>

            <div class="col-12 ">
                <p class="mt-2 text-center">Dok.No.: FRM.QA.07.01</p>

            </div>


            <div style="width: 100%; overflow-x: auto;">
                <div style="display: flex; align-items: flex-start; width: max-content;">
                    <table class="table table-bordered text-nowrap"
                        style="font-size: 10px; width: max-content; margin:0; border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th class="text-center align-middle text-nowrap">No Urut</th>
                                <th class="text-center align-middle text-nowrap">Tgl Panen</th>
                                <th class="text-center align-middle text-nowrap">Tgl <br> Datang</th>
                                <th class="text-center align-middle text-nowrap">No. Reg. <br> Rumah <br> Walet
                                </th>
                                <th class="text-center align-middle text-nowrap">Nama <br> Rumah <br> Walet</th>
                                <th class="text-center align-middle text-nowrap">Batch Material</th>
                                <th class="text-center align-middle text-nowrap">Berat <br> Kotor <br> Raw (Kg)
                                </th>
                                <th class="text-center align-middle text-nowrap">Berat <br> Akhir <br> Grading
                                    <br> Raw
                                    (Kg)
                                </th>
                                <th class="text-center align-middle text-nowrap">Susut <br> Sortir (Kg)</th>
                                <th class="text-center align-middle text-nowrap">Berat Saat <br> Pembagian <br>
                                    (Gr)
                                </th>
                                {{-- cabut --}}
                                <th class="text-center align-middle text-nowrap">Tgl Produksi <br> (Pencabutan)
                                </th>
                                <th class="text-center align-middle text-nowrap">Jml Keping Awal <br> (Pcs &
                                    Gr)</th>
                                <th class="text-center align-middle text-nowrap">Berat Hasil <br> Cabut & Drying
                                    <br>
                                    (Pcs / Gr)
                                </th>
                                <th class="text-center align-middle text-nowrap">Tanggal <br> Selesai Drying
                                </th>
                                {{-- cetak --}}
                                <th class="text-center align-middle text-nowrap">Tanggal <br> Selesai Cetak</th>
                                <th class="text-center align-middle text-nowrap">Jumlah Keping Cetak <br> (Pcs &
                                    Gr)
                                </th>
                                <th class="text-center align-middle text-nowrap">Berat Hasil Cetak <br> (Pcs &
                                    Gr)
                                </th>
                                {{-- grading --}}
                                <th class="text-center align-middle text-nowrap">Tgl Final <br> Grading Akhir
                                </th>
                                <th class="text-center align-middle text-nowrap">Jumlah Keping <br> Grading
                                    Akhir</th>
                                <th class="text-center align-middle text-nowrap">Berat Akhir <br> Grading <br>
                                    Akhir (Kering)
                                </th>
                                <th class="text-center align-middle text-nowrap">Tanggal <br> Steam</th>
                                <th class="text-center align-middle text-nowrap">Jml Keping <br> Akhir (Pcs)
                                </th>
                                <th class="text-center align-middle text-nowrap">Jml Berat Akhir <br> (Gr)
                                </th>
                                <th class="text-center align-middle text-nowrap">Presentase <br> Yield (%)</th>
                                <th class="text-center align-middle text-nowrap">Jumlah Keping <br> Yang
                                    Diterima <br>
                                    Gudang
                                </th>
                                {{-- <th class="text-center align-middle text-nowrap">JUMLAH <br> KEPING <br> TERKIRIM
                                </th> --}}
                                <th class="text-center align-middle text-nowrap">Berat Masuk <br> Gudang <br>
                                    Produk
                                    Jadi
                                </th>
                                <th class="text-center align-middle text-nowrap" style="border-right: none">Tanggal
                                    Masuk <br> Gudang
                                    Produk <br>
                                    Jadi
                                </th>
                                {{-- <th class="text-center align-middle text-nowrap">JUMLAH <br> KEPING <br> TERKIRIM
                                </th>
                                <th class="text-center align-middle text-nowrap">PRODUK <br> TERKIRIM <br> (Gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">TGL <br> PENGIRIMAN</th>
                                <th class="text-center align-middle text-nowrap">TUJUAN</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $first = true;
                                $b_bersih = 0;
                                $gr_awal = 0;
                                $pcs_grading = 0;
                                $gr_grading = 0;

                            @endphp
                            @foreach ($bk as $b)
                                @php
                                    $gr_awal += $b['gr_awal'];
                                    $b_bersih = $b['berat_bersih'];
                                    $pcs_grading += $b['pcs_grading'];
                                    $gr_grading += $b['gr_grading'];
                                @endphp
                                <tr>
                                    @if ($loop->first == 1)
                                        <td class="text-end">1</td>
                                        <td class="text-end">{{ tanggal($b['tgl_panen']) }}</td>
                                        @php
                                            $tgl = date('Y-m-d', strtotime($b['tgl_panen'] . ' + 1 days'));
                                            $rumah_walet = DB::table('rumah_walet')->where('id', $b['rwb_id'])->first();
                                        @endphp
                                        <td class="text-end">{{ empty($tgl) ? '-' : tanggal($tgl) }}</td>
                                        <td class="text-end">{{ $rumah_walet->no_reg }}</td>
                                        <td>{{ $rumah_walet->nama }}</td>
                                        <td class="text-end">{{ $b['no_invoice'] }}</td>
                                        <td class="text-end">{{ number_format($b['gr_kotor'], 0) }}</td>
                                        <td class="text-end">{{ number_format($b['berat_bersih'], 0) }}</td>
                                        <td class="text-end">
                                            {{ number_format($b['gr_kotor'] - $b['berat_bersih'], 0) }}
                                        </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                    <td class="text-end">
                                        {{ number_format($b['gr_awal'], 0) }}
                                    </td>
                                    <td class="text-end">{{ tanggal($b['tgl_terima'] ?? '-') }}</td>
                                    <td class="text-end">{{ number_format($b['pcs_awal'], 0) }} /
                                        {{ number_format($b['gr_awal'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : number_format($b['pcs_akhir'], 0) }}
                                        /
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : number_format($b['gr_akhir'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : $b['tgl_serah'] }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_awal_ctk'] == 0 ? '-' : $b['tgl_selesai_ctk'] }}
                                    </td>

                                    <td class="text-end">
                                        {{ number_format($b['pcs_awal_ctk'], 0) }} /
                                        {{ number_format($b['gr_awal_ctk'], 0) }}
                                    </td>
                                    <td class="text-end">

                                        {{ $b['pcs_akhir_ctk'] != $b['pcs_awal'] ? '-' : number_format($b['pcs_akhir_ctk'], 0) }}
                                        /
                                        {{ $b['pcs_akhir_ctk'] != $b['pcs_awal'] ? '-' : number_format($b['gr_akhir_ctk'], 0) }}
                                    </td>
                                    {{-- grading --}}
                                    <td class="text-end">
                                        {{ ($b['pcs_grading'] != $b['pcs_awal'] ? '-' : empty($b['tgl_grading'])) ? '-' : $b['tgl_grading'] }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ ($b['pcs_grading'] != $b['pcs_awal'] ? '-' : empty($b['tgl_grading'])) ? '-' : $b['tgl_grading'] }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format(($b['gr_grading'] / $b['gr_awal']) * 100, 0) }}%
                                    </td>
                                    {{-- dsa --}}
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    @php
                                        $tgl = date('Y-m-d', strtotime($b['tgl_grading'] . ' + 1 days'));
                                    @endphp
                                    <td class="text-end">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '-' : $tgl }}
                                    </td>
                                    {{-- <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end fw-bold">{{ number_format($gr_awal, 0) }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end fw-bold">{{ $pcs_grading }}</td>
                                <td class="text-end fw-bold">{{ $gr_grading }}</td>
                            </tr>
                            <tr>
                                <td>Selisih</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end fw-bold">{{ number_format($b_bersih - $gr_awal, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <table class="table table-bordered text-nowrap"
                        style="font-size: 10px; width: 400px; margin:0; border-collapse:collapse; border-left:0;">
                        <thead>
                            <tr>
                                <th class="text-center align-middle text-nowrap" style="border-left: 1px solid #dee2e6">
                                    Jumlah
                                    <br>
                                    Keping <br>
                                    Terkirim
                                </th>
                                <th class="text-center align-middle text-nowrap">Produk <br> Terkirim <br>
                                    (Gr)
                                </th>
                                <th class="text-center align-middle text-nowrap">Tanggal <br> Pengiriman</th>
                                <th class="text-center align-middle text-nowrap">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ttl_pcs_tes = 0;
                                $ttl_gr_tes = 0;
                            @endphp
                            @foreach ($kirim as $k)
                                @php
                                    $ttl_pcs_tes += $k['pcs'];
                                    $ttl_gr_tes += $k['gr'];
                                @endphp
                                <tr>
                                    <td class="text-end" style="border-left: 1px solid #dee2e6">
                                        {{ number_format($k['pcs'], 0) }}</td>
                                    <td class="text-end">{{ number_format($k['gr'], 0) }}</td>
                                    <td class="text-end">
                                        {{ empty($k['tgl_input']) ? '-' : tanggal($k['tgl_input']) }}</td>
                                    <td class="text-end">Hk</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-end">{{ number_format($ttl_pcs_tes, 0) }}</th>
                                <th class="text-end">{{ number_format($ttl_gr_tes, 0) }}</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
            {{-- <div style="flex: 0 0 400px;">

               
            </div> --}}








        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // window.print();
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
