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
            padding: 0.1rem;
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;

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
            table {
                page-break-inside: avoid;
            }

            /* Kalau mau mulai halaman baru + jarak atas */
            .page-break {
                page-break-before: always;
                padding-top: 20mm;
                /* jarak dari header halaman */
            }
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

                            <th colspan="10">
                                <p class="cop_judul text-center">FORM PEMANASAN CCP 2</p>
                                <p class="cop_bawah text-center">Steaming CCP 2</p>
                            </th>
                            <th class="align-top text-end text-nowrap" colspan="2">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">No Dok : FRM.PRO.01.09,
                                    Rev 00</p>
                            </th>

                        </tr>

                        <tr>
                            <td>Tanggal <br> <span class="fst-italic">date</span></td>
                            <td colspan="2"> : {{ tanggal($tgl) }}</td>

                            <td colspan="2">Suhu ruang<br> <span class="fst-italic">Room temperature</span></td>
                            <td colspan="3"> : {{ empty($header->suhu_ruang) ? '28.6' : $header->suhu_ruang }} °C
                            </td>

                            <td colspan="2">Mesin Pemanas <br> <span class="fst-italic">Steamer type</span></td>
                            <td colspan="3"> : Sistem Retort - Pemanasan Uap bertingkat</td>
                        </tr>
                        <tr>
                            <td>Suhu sarang walet awal <br> <span class="fst-italic">Material
                                    temperature</span></td>
                            <td colspan="2"> : {{ empty($header->suhu_sbw_awal) ? '23.6' : $header->suhu_sbw_awal }}
                                °C</td>

                            <td colspan="2">Penambahan air <br> <span class="fst-italic">Adding water
                                    temperature</span></td>
                            <td colspan="3"> : Otomatis </td>

                            <td colspan="5"></td>
                        </tr>
                        <tr class="table-bawah">
                            <th rowspan="2" class="text-center align-middle">Urutan <br> Pemanasan <br> <span
                                    class="fst-italic fw-lighter">Heating number</span></th>
                            <th rowspan="2" class="text-end align-middle">Nampan <br> <span
                                    class="fst-italic fw-lighter">Tray</th>
                            <th rowspan="2" class="text-start align-middle">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot code
                            </th>
                            <th rowspan="2" class="text-start align-middle">Jenis <br> <span
                                    class="fst-italic fw-lighter">Type</th>
                            <th rowspan="2" class="text-start align-middle">Waktu <br> mulai <br> Steam</th>
                            <th colspan="2" class="text-center align-middle">Jumlah <br> <span
                                    class="fst-italic fw-lighter">Quantity</th>
                            <th rowspan="2" class="text-end align-middle">T<sub>venting</sub> (°C)</th>
                            <th rowspan="2" class="text-end align-middle">T<sub>venting</sub> (mnt) </th>
                            <th rowspan="2" class="text-end align-middle">T<sub>tot</sub> (°C) </th>
                            <th rowspan="2" class="text-end align-middle">T<sub>tot</sub> (mnt) </th>
                            <th rowspan="2" class="text-start align-middle">Petugas <br> pengecekan <br> (paraf)
                            </th>
                            <th rowspan="2" class="text-start align-middle">Keterangan </th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-end align-middle">Pcs</th>
                            <th class="text-end align-middle">Gr</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemanasan as $index => $p)
                            @php
                                $rawPartai = $p['nm_partai'];
                                $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                                $partaiArray = array_map('trim', explode(',', $cleaned));
                                $sbwList = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->whereIn('nm_partai', $partaiArray)
                                    ->get();

                                $startTime = \Carbon\Carbon::createFromTime(9, 0); // 09:00
                                $groupNumber = ceil(($index + 1) / 6);
                                $time = $startTime
                                    ->copy()
                                    ->addMinutes(15 * ($groupNumber - 1))
                                    ->format('H:i');

                            @endphp
                            @if ($index > 0 && $index % 6 == 0)
                                <tr class="table-bawah">
                                    <td colspan="13">&nbsp;</td>
                                </tr>
                            @endif
                            @php
                                $isi = DB::table('isi_ccp2')
                                    ->where('tgl', $tgl)
                                    ->where('urutan', ceil(($index + 1) / 6))
                                    ->first();

                            @endphp
                            <tr class="table-bawah">
                                <td>{{ ceil(($index + 1) / 6) }}</td>
                                <td class="text-end">{{ ($index % 6) + 1 }}</td>
                                <td class="text-start">{!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
                                <td class="text-start">
                                    {!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}
                                </td>
                                <td class="text-start">{{ empty($isi->waktu_mulai) ? $time : $isi->waktu_mulai }}</td>
                                <td class="text-end">{{ number_format($p['pcs'], 0) }}</td>
                                <td class="text-end">{{ number_format($p['gr'], 0) }}</td>
                                <td class="text-end">{{ empty($isi->tventing_c) ? 60.5 : $isi->tventing_c }} </td>
                                <td class="text-end">{{ empty($isi->tventing_menit) ? 1 : $isi->tventing_menit }}
                                    menit {{ empty($isi->tventing_detik) ? 3 : $isi->tventing_detik }} detik</td>
                                <td class="text-end">{{ empty($isi->ttot_c) ? 80.4 : $isi->ttot_c }} </td>
                                <td class="text-end">
                                    @if (!empty($isi->ttot_menit) && $isi->ttot_menit > 0)
                                        {{ $isi->ttot_menit }} menit
                                    @endif

                                    {{ empty($isi->ttot_detik) ? 35 : $isi->ttot_detik }} detik
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach



                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="13">&nbsp;</th>
                        </tr>
                        <tr class="table-bawah">

                            <th style="border: none; text-align: start" rowspan="2" colspan="2">
                                <span class="fst-underline"> Standart Suhu Pemanasan</span> <br>
                                <span class="fw-light">Mangkok/Segitiga/Oval/Sudut</span> <br>
                                <span class="fw-light">Patahan</span> <br>
                                <span class="fw-light">Kaki</span> <br>
                                <span class="fw-light">Hancuran</span> <br> <br>
                                <span class="fst-underline"> Standart Suhu T-venting</span> <br>
                                <span class="fst-underline"> Standart Waktu T-venting</span> <br>


                            </th>
                            <th style="border: none; text-align: start" rowspan="2" colspan="2  ">
                                <span class="fst-underline"> </span> <br>
                                <span class="fw-light">: 80,4°C selama 30 detik</span> <br>
                                <span class="fw-light">: 92.6 °C selama 1 menit 27 detik</span> <br>
                                <span class="fw-light">: 85.1 oC selama 1 menit 48 detik</span> <br>
                                <span class="fw-light">: 92.9°C selama 50 detik</span> <br> <br>

                                <span class="fw-light">: 57.1 °C</span> <br>
                                <span class="fw-light">: 1 menit 3 detik</span> <br>


                            </th>
                            <th style="border: none; text-align: start" rowspan="2" colspan="5">


                            </th>
                            <th class="text-center" colspan="2">Dibuat Oleh:</th>
                            <th class="text-center" colspan="2">Diperiksa Oleh:</th>
                        </tr>
                        <tr class="table-bawah">

                            <td colspan="2" style="height: 80px" class="text-center align-bottom">KA. STEAM</td>
                            <td colspan="2" style="height: 80px" class="text-center align-bottom">QC</td>
                        </tr>

                    </tfoot>

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
