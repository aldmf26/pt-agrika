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

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
            font-size: 10px;
            font-weight: normal
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

        .table-bawah th,
        .table-bawah td {
            border: 1px solid black;
            padding: 0.2rem 0.3rem;
            vertical-align: middle;
            text-align: center;
            /* white-space: nowrap; */

            /* agar teks tidak turun ke bawah */
        }


        @media print {
            @page {
                size: A4 landscape;
                margin-top: 20mm;
                /* jarak atas semua halaman */
                margin-bottom: 15mm;
                margin-left: 15mm;
                margin-right: 15mm;
            }

            body {
                margin: 0;
            }

            /* Biar tabel nggak pecah aneh */
            /* table {
                page-break-inside: avoid;
            } */

            /* Kalau mau mulai halaman baru + jarak atas */

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" style="font-size: 11px; ">
                    <thead class="repeat-header">
                        <tr>
                            <th class="align-top"><img style="width: 80px" src="{{ asset('img/logo.jpeg') }}"
                                    alt=""></th>

                            <th colspan="11">
                                <p class="cop_judul text-center">FORM PEMANASAN CCP 2</p>
                                <p class="cop_bawah text-center">Steaming CCP 2</p>
                            </th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">Dok.No.: FRM.PROS.01.07,
                                    Rev 00</p>
                            </th>

                        </tr>

                        <tr>
                            <td>Tanggal <br> <span class="fst-italic">Date</span></td>
                            <td colspan="2"> : {{ tanggal($tgl) }}</td>

                            <td colspan="2">Suhu ruang<br> <span class="fst-italic">Room Temperature</span></td>
                            <td colspan="3"> : {{ empty($header->suhu_ruang) ? '28.6' : $header->suhu_ruang }} °C
                            </td>

                            <td colspan="2">Mesin Pemanas <br> <span class="fst-italic">Steamer Type</span></td>
                            <td colspan="4"> : Sistem Retort - Pemanasan Uap Bertingkat</td>
                        </tr>
                        <tr>
                            <td>Suhu Sarang Walet Awal <br> <span class="fst-italic">Material
                                    Temperature</span></td>
                            <td colspan="2"> : {{ empty($header->suhu_sbw_awal) ? '23.6' : $header->suhu_sbw_awal }}
                                °C</td>

                            <td colspan="2">Penambahan air <br> <span class="fst-italic">Adding Water
                                </span></td>
                            <td colspan="3"> : Otomatis </td>

                            <td colspan="6"></td>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="col-lg-12">

                <table width="100%" style="font-size: 11px; ">
                    <thead>

                        <tr class="table-bawah">
                            <th rowspan="2" class="text-center align-middle">Urutan <br> Pemanasan <br> <span
                                    class="fst-italic fw-lighter">Heating Number</span></th>
                            <th rowspan="2" class="text-center align-middle">Nampan <br> <span
                                    class="fst-italic fw-lighter">Tray</th>
                            <th rowspan="2" class="text-center align-middle text-nowrap">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot code
                            </th>
                            <th rowspan="2" class="text-center align-middle">Grade Awal <br> <span
                                    class="fst-italic fw-lighter">(Bk)</th>
                            <th rowspan="2" class="text-center align-middle">Jenis Produk Akhir </th>
                            <th rowspan="2" class="text-center align-middle" width="10%">Grade Akhir <br> <span
                                    class="fst-italic fw-lighter">(Bahan Jadi)</span></th>
                            <th rowspan="2" class="text-center align-middle">Waktu <br> Mulai <br> Steam</th>
                            <th colspan="2" class="text-center align-middle">Jumlah <br> <span
                                    class="fst-italic fw-lighter">Quantity</th>
                            <th rowspan="2" class="text-center align-middle">T<sub>Venting</sub> (°C)</th>
                            <th rowspan="2" class="text-center align-middle">T<sub>Venting</sub> (Mnt) </th>
                            <th rowspan="2" class="text-center align-middle">T<sub>Tot</sub> (°C) </th>
                            <th rowspan="2" class="text-center align-middle">T<sub>Tot</sub> (Mnt) </th>
                            <th rowspan="2" class="text-center align-middle">Petugas <br> Pengecekan <br> (Paraf)
                            </th>
                            <th rowspan="2" class="text-center align-middle">Keterangan <br> <span
                                    class="fst-italic fw-lighter">Remarks</span> </th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center align-middle">Pcs</th>
                            <th class="text-center align-middle">Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $groupedPemanasan = collect($pemanasan)->groupBy('kelompok');
                            $startTime = \Carbon\Carbon::createFromTime(9, 0);
                            $trayNumber = 0;
                        @endphp

                        @foreach ($groupedPemanasan as $kelompok => $items)
                            @php
                                // Hitung total tray yang dibutuhkan untuk kelompok ini
                                $totalTrayKelompok = ceil($items->count() / 6);

                                // Naikkan nomor tray mulai dari yang terakhir
                                $trayAwal = $trayNumber + 1;
                                $trayAkhir = $trayNumber + $totalTrayKelompok;
                                $trayNumber = $trayAkhir;

                                $indexDalamKelompok = 0;
                            @endphp

                            {{-- <tr>
                                <td colspan="14" class="fw-bold text-center bg-light">

                                    &nbsp;
                                </td>
                            </tr> --}}

                            @foreach ($items->values() as $i => $p)
                                @php
                                    $indexDalamKelompok++;

                                    // Hitung tray keberapa dalam kelompok ini
                                    $trayKe = $trayAwal + floor(($indexDalamKelompok - 1) / 6);

                                    // Urutan dalam tray (1–6)
                                    $urutanDalamTray = (($indexDalamKelompok - 1) % 6) + 1;

                                    $rawPartai = $p['nm_partai'];
                                    $cleaned = str_replace("'", '', $rawPartai);
                                    $partaiArray = array_map('trim', explode(',', $cleaned));

                                    $sbwList = DB::table('sbw_kotor')
                                        ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                        ->whereIn('nm_partai', $partaiArray)
                                        ->get();

                                    $time = $startTime
                                        ->copy()
                                        ->addMinutes(15 * ($trayKe - 1))
                                        ->format('H:i');

                                    $isi = DB::table('isi_ccp2')->where('tgl', $tgl)->where('urutan', $trayKe)->first();
                                @endphp

                                {{-- Garis pemisah tiap 6 data --}}


                                <tr class="table-bawah">
                                    {{-- Nomor Tray --}}
                                    <td class="text-end">{{ $trayKe }}</td>

                                    {{-- Urutan dalam tray (1–6) --}}
                                    <td class="text-end">{{ $urutanDalamTray }}</td>

                                    <td class="text-end  text-nowrap">{!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
                                    <td class="text-start">
                                        {!! $sbwList->pluck('nama')->unique()->map(fn($n) => strtoupper($n))->implode(', <br>') ?: '-' !!}
                                    </td>
                                    @php
                                        if ($p['kelompok'] == '1') {
                                            $suhu = '72.5';
                                            $menit = '35 detik';
                                            $kelompok = 'Mangkok / Segitiga / Oval / Sudut';
                                        } elseif ($p['kelompok'] == '2') {
                                            $suhu = '80.9';
                                            $menit = '32 detik';
                                            $kelompok = 'Patahan';
                                        } elseif ($p['kelompok'] == '3') {
                                            $suhu = '86.0';
                                            $menit = '43 detik';
                                            $kelompok = 'Kaki';
                                        } else {
                                            $suhu = '97.4';
                                            $menit = '1 menit 38 detik';
                                            $kelompok = 'Hancuran';
                                        }
                                    @endphp
                                    <td class="text-start" width="5%">
                                        {{ $kelompok }}
                                    </td>

                                    <td class="text-start" width="5%">
                                        {{ $p['grade'] }}
                                    </td>
                                    <td class="text-end">
                                        {{ empty($isi->waktu_mulai) ? date('h:i A', strtotime($time)) : date('h:i A', strtotime($isi->waktu_mulai)) }}
                                    </td>
                                    <td class="text-end">{{ number_format($p['pcs'], 0) }}</td>
                                    <td class="text-end">{{ number_format($p['gr'], 0) }}</td>
                                    <td class="text-end">{{ empty($isi->tventing_c) ? 57.1 : $isi->tventing_c }}</td>
                                    <td class="text-end">
                                        {{ empty($isi->tventing_menit) ? 1 : $isi->tventing_menit }} Menit
                                        {{ empty($isi->tventing_detik) ? 3 : $isi->tventing_detik }} Detik
                                    </td>

                                    <td class="text-end">{{ empty($isi->ttot_c) ? $suhu : $isi->ttot_c }}</td>
                                    <td class="text-end">
                                        @if (!empty($isi->ttot_menit) && $isi->ttot_menit > 0)
                                            {{ $isi->ttot_menit }} Menit
                                        @endif
                                        {{ empty($isi->ttot_detik) ? $menit : $isi->ttot_detik }}
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach





                    </tbody>


                </table>
                <table width="100%" style="font-size: 11px; ">
                    <tr>
                        <th colspan="13">&nbsp;</th>
                    </tr>
                    <tr class="table-bawah">

                        <th style="border: none; text-align: start" rowspan="3" colspan="2">
                            <span class="fst-underline"> Standart Suhu Pemanasan</span> <br>
                            <span class="fw-light">Mangkok/Segitiga/Oval/Sudut</span> <br>
                            <span class="fw-light">Patahan</span> <br>
                            <span class="fw-light">Kaki</span> <br>
                            <span class="fw-light">Hancuran</span> <br> <br>
                            <span class="fst-underline"> Standart Suhu T-venting</span> <br>
                            <span class="fst-underline"> Standart Waktu T-venting</span> <br>


                        </th>
                        <th style="border: none; text-align: start" rowspan="3" colspan="2  ">
                            <span class="fst-underline"> </span> <br>
                            <span class="fw-light">: 72.5 °C Selama 35 Detik</span> <br>
                            <span class="fw-light">: 80.9 °C Selama 32 Detik</span> <br>
                            <span class="fw-light">: 86.0 °C Selama 43 Detik</span> <br>
                            <span class="fw-light">: 97.4 °C Selama 1 menit 38 detik</span> <br> <br>

                            <span class="fw-light">: 56.3 °C</span> <br>
                            <span class="fw-light">: 1 Menit 5 Detik</span> <br>


                        </th>
                        <th style="border: none; text-align: start" rowspan="3" colspan="4">
                        </th>
                        <th class="text-center" colspan="3">Dibuat Oleh:</th>
                        <th class="text-center" colspan="2">Diperiksa Oleh:</th>
                    </tr>
                    <tr class="table-bawah">

                        <td colspan="3" style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA STEAM')" />
                        </td>
                        <td colspan="2" style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA QC')" />
                        </td>
                    </tr>
                    <tr class="table-bawah">

                        <td colspan="3" class="text-center align-bottom">(KEPALA STEAM)</td>
                        <td colspan="2" class="text-center align-bottom">(KEPALA QC)</td>
                    </tr>
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
