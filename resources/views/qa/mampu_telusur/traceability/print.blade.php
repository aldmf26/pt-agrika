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
                                <th class="text-center align-middle text-nowrap">NO URUT</th>
                                <th class="text-center align-middle text-nowrap">TGL PANEN</th>
                                <th class="text-center align-middle text-nowrap">TGL <br> DATANG</th>
                                <th class="text-center align-middle text-nowrap">NO. REG. <br> RUMAH <br> WALET
                                </th>
                                <th class="text-center align-middle text-nowrap">NAMA <br> RUMAH <br> WALET</th>
                                <th class="text-center align-middle text-nowrap">BATCH MATERIAL</th>
                                <th class="text-center align-middle text-nowrap">BERAT <br> KOTOR <br> RAW (KG)
                                </th>
                                <th class="text-center align-middle text-nowrap">BERAT <br> AKHIR <br> GRADING
                                    <br> RAW
                                    (KG)
                                </th>
                                <th class="text-center align-middle text-nowrap">SUSUT <br> SORTIR (KG)</th>
                                <th class="text-center align-middle text-nowrap">BERAT SAAT <br> PEMBAGIAN <br>
                                    (Gram)
                                </th>
                                {{-- cabut --}}
                                <th class="text-center align-middle text-nowrap">TGL PRODUKSI <br> (PENCABUTAN)
                                </th>
                                <th class="text-center align-middle text-nowrap">JML KEPING AWAL <br> (pcs &
                                    gram)</th>
                                <th class="text-center align-middle text-nowrap">BERAT HASIL <br> CABUT & DRYING
                                    <br>
                                    (pcs / gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">TANGGAL <br> SELESAI DRYING
                                </th>
                                {{-- cetak --}}
                                <th class="text-center align-middle text-nowrap">TANGGAL <br> SELESAI CETAK</th>
                                <th class="text-center align-middle text-nowrap">JUMLAH KEPING CETAK <br> (pcs &
                                    gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">BERAT HASIL CETAK <br> (pcs &
                                    gram)
                                </th>
                                {{-- grading --}}
                                <th class="text-center align-middle text-nowrap">TGL FINAL <br> GRADING AKHIR
                                </th>
                                <th class="text-center align-middle text-nowrap">JUMLAH KEPING <br> GRADING
                                    AKHIR</th>
                                <th class="text-center align-middle text-nowrap">BERAT AKHIR <br> GRADING <br>
                                    AKHIR
                                    (KERING)
                                </th>
                                <th class="text-center align-middle text-nowrap">TANGGAL <br> STEAM</th>
                                <th class="text-center align-middle text-nowrap">JML KEPING <br> AKHIR (pcsm)
                                </th>
                                <th class="text-center align-middle text-nowrap">JML BERAT AKHIR <br> (gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">PRESENTASE <br> YIELD (%)</th>
                                <th class="text-center align-middle text-nowrap">JUMLAH KEPING <br> YANG
                                    DITERIMA <br>
                                    GUDANG
                                </th>
                                {{-- <th class="text-center align-middle text-nowrap">JUMLAH <br> KEPING <br> TERKIRIM
                                </th> --}}
                                <th class="text-center align-middle text-nowrap">BERAT MASUK <br> GUDANG <br>
                                    PRODUK
                                    JADI
                                </th>
                                <th class="text-center align-middle text-nowrap" style="border-right: none">TANGGAL
                                    MASUK <br> GUDANG
                                    PRODUK <br>
                                    JADI
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
                            @endphp
                            @foreach ($bk as $b)
                                @php
                                    $gr_awal += $b['gr_awal'];
                                    $b_bersih = $b['berat_bersih'];
                                @endphp
                                <tr>
                                    @if ($loop->first == 1)
                                        <td class="text-center">1</td>
                                        <td>{{ tanggal($b['tgl_panen']) }}</td>
                                        @php
                                            $tgl = date('Y-m-d', strtotime($b['tgl_panen'] . ' + 1 days'));
                                            $rumah_walet = DB::table('rumah_walet')->where('id', $b['rwb_id'])->first();
                                        @endphp
                                        <td>{{ tanggal($tgl) }}</td>
                                        <td>{{ $rumah_walet->no_reg }}</td>
                                        <td>{{ $rumah_walet->nama }}</td>
                                        <td>{{ $b['no_invoice'] }}</td>
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
                                    <td>{{ tanggal($b['tgl_terima'] ?? '-') }}</td>
                                    <td class="text-center">{{ number_format($b['pcs_awal'], 0) }} /
                                        {{ number_format($b['gr_awal'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : number_format($b['pcs_akhir'], 0) }}
                                        /
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : number_format($b['gr_akhir'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_akhir'] != $b['pcs_awal'] ? '-' : tanggal($b['tgl_serah'] ?? '-') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_awal_ctk'] == 0 ? '-' : tanggal($b['tgl_selesai_ctk']) }}
                                    </td>

                                    <td class="text-center">
                                        {{ number_format($b['pcs_awal_ctk'], 0) }} /
                                        {{ number_format($b['gr_awal_ctk'], 0) }}
                                    </td>
                                    <td class="text-center">

                                        {{ $b['pcs_akhir_ctk'] != $b['pcs_awal'] ? '-' : number_format($b['pcs_akhir_ctk'], 0) }}
                                        /
                                        {{ $b['pcs_akhir_ctk'] != $b['pcs_awal'] ? '-' : number_format($b['gr_akhir_ctk'], 0) }}
                                    </td>
                                    {{-- grading --}}
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '-' : tanggal($b['tgl_grading']) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '-' : tanggal($b['tgl_grading']) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format(($b['gr_grading'] / $b['gr_awal']) * 100, 0) }}%
                                    </td>
                                    {{-- dsa --}}
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['pcs_grading'], 0) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '0' : number_format($b['gr_grading'], 0) }}
                                    </td>
                                    @php
                                        $tgl = date('Y-m-d', strtotime($b['tgl_grading'] . ' + 1 days'));
                                    @endphp
                                    <td class="text-center">
                                        {{ $b['pcs_grading'] != $b['pcs_awal'] ? '-' : tanggal($tgl) }}
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
                                    JUMLAH
                                    <br>
                                    KEPING <br>
                                    TERKIRIM
                                </th>
                                <th class="text-center align-middle text-nowrap">PRODUK <br> TERKIRIM <br>
                                    (Gram)
                                </th>
                                <th class="text-center align-middle text-nowrap">TGL <br> PENGIRIMAN</th>
                                <th class="text-center align-middle text-nowrap">TUJUAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kirim as $k)
                                <tr>
                                    <td class="text-center" style="border-left: 1px solid #dee2e6">
                                        {{ number_format($k['pcs'], 0) }}</td>
                                    <td class="text-center">{{ number_format($k['gr'], 0) }}</td>
                                    <td class="text-center">
                                        {{ empty($k['tgl_input']) ? '-' : tanggal($k['tgl_input']) }}</td>
                                    <td class="text-center">{{ $k['tujuan'] }}</td>
                                </tr>
                            @endforeach

                        </tbody>

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
