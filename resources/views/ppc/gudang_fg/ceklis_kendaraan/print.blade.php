<x-hccp-print :title="$title" :dok="$dok">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

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

        .print {
            display: none;
            /* disembunyikan saat layar biasa */
        }

        .input {
            font-size: 8px
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .print {
                display: inline !important;
            }

            .input {
                display: none !important;
            }
        }
    </style>
    <div class="row">

        <div class="header-info col-lg-12">

            <table style="font-size: 10px">
                <tr>
                    <td colspan="2">BERI TANDA (&#10004;) UNTUK TIAP KOLOM YANG SESUAI STANDAR DAN TANDA (&#10008;)
                        UNTUK TIAP
                        KOLOM
                        YANG
                        TIDAK SESUAI STANDAR</td>
                </tr>
                <tr>
                    <td width="15%">Kendaraan Milik </td>
                    <td>: Internal / <span class="text-decoration-line-through">Ekspedisi</span></td>

                </tr>
                <tr>
                    <td>Nomor Kendaraan </td>
                    <td>: DA 1850 I</td>

                </tr>
                <tr>
                    <td>Pengemudi</td>
                    <td>: Maulidan</td>
                </tr>

            </table>
        </div>


    </div>
    <table class="table table-bordered">
        <tr>
            <td colspan="2">Tanggal</td>
            @php
                $jumlahData = count($checklist);
                $maxKolom = 9;
            @endphp

            @foreach ($checklist as $c)
                <td class="text-end align-middle" width="8%" colspan="2">{{ tanggal($c['tgl']) }}
                </td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" width="8%" colspan="2"></td>
            @endfor

        </tr>
        <tr>
            <td colspan="2">Jam Penataan Di mobil</td>


            @foreach ($checklist as $c)
                <td class="text-end align-middle" width="8%" colspan="2">02:00 PM</td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" width="8%" colspan="2"></td>
            @endfor
        </tr>
        <tr>
            <td colspan="2">Tujuan / Ekspedisi</td>


            @foreach ($checklist as $c)
                <td class="text-end align-middle" width="8%" colspan="2">HK / Garuda Kargo</td>
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
                    <td class="text-center">&#10004;</td>
                    <td class="text-center">&#10004;</td>
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
                <td class="text-center" colspan="2"></td>
            @endfor

        </tr>
        <tr>
            <td></td>
            <th class="align-middle" style="font-size: 12px !important">Paraf Pemeriksa</th>
            @for ($i = 0; $i < $maxKolom; $i++)
                <td class="text-center" style="height: 30px"></td>
                <td class="text-center" style="height: 30px"></td>
            @endfor

        </tr>


    </table>

    <span style="font-size: 7px">
        NOTE : JIKA KONDISI KENDARAAN MEMENUHI SEMUA KETENTUAN TERSEBUT DIATAS DAN KEPUTUSANNYA DIPAKAI MAKA BERIKAN
        TANDA <b>(&#10004;)</b>
        DAN TANDA <b>(&#10008;)</b> JIKA KENDARAAN TERNYATA TIDAK
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
                                <td style="height: 45px" class="align-middle text-center">
                                    <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center">(KA. EKSPEDISI & EKSPORT)</td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</x-hccp-print>
