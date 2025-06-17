<x-hccp-print :title="$title" :dok="$dok">
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

    <div class="header-info">
        <table>
            <tr>
                <td width="150">Tanggal</td>
                <td width="10">:</td>
                <td>{{ date('d/m/Y', strtotime($checklist->tanggal)) }}</td>
                <td width="150">Kendaraan Milik</td>
                <td width="10">:</td>
                <td>{{ $checklist->jenis_kendaraan }}</td>
            </tr>
            <tr>
                <td>Nomor Kendaraan</td>
                <td>:</td>
                <td>{{ $checklist->nomor_kendaraan }}</td>
                <td>Ekspedisi</td>
                <td>:</td>
                <td>{{ $checklist->ekspedisi }}</td>
            </tr>
            <tr>
                <td>Pengemudi</td>
                <td>:</td>
                <td>{{ $checklist->pengemudi }}</td>
                <td>Asal / Kode RBW</td>
                <td>:</td>
                <td>{{ $checklist->noreg_rumah_walet }}</td>
            </tr>
            <tr>
                <td>Jam Kedatangan</td>
                <td>:</td>
                <td>{{ $checklist->jam_datang }}</td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kondisi Kendaraan</th>
                <th width="80" class="text-center">WH</th>
                <th width="80" class="text-center">QA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
                <tr>
                    <td align="center">{{ $item->nomor }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td style="text-align: center">{{ $item->check_wh == '0' ? 'Y' : '' }}</td>
                    <td style="text-align: center">{{ $item->check_qa == '0' ? 'Y' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tbody>
            <tr>
                <td></td>
                <th>KEPUTUSAN DIPAKAI : Ya (Y) atau TIDAK (T)</th>
                <td align="center">{{ $checklist->keputusan }}</td>
                <td align="center">{{ $checklist->keputusan }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <th>Inisial Pemeriksa</th>
                <td align="center">{{ $checklist->pemeriksa }}</td>
                <td align="center">{{ $checklist->pemeriksa }}</td>
            </tr>
        </tfoot>
    </table>
    <span style="font-size: 10px">
        NOTE : JIKA KONDISI KENDARAAN MEMENUHI SEMUA KETENTUAN TERSEBUT DIATAS DAN KEPUTUSANNYA DIPAKAI MAKA BERIKAN
        TANDA <b>V</b>
        DAN TANDA <b>X</b> JIKA KENDARAAN TERNYATA TIDAK
        DAPAT DIPAKAI / DITOLAK
        LIHAT DETAIL KETERANGAN SETIAP KETENTUAN KONDISI KENDARAAN
    </span>

    <div style="margin-top: 30px">
        <table width="100%">
            <tr>
                <td width="60%">
                    <p>Komentar:</p>
                    {{ $checklist->komentar }}
                </td>
                <td style="width: 40%">
                    <table class="border-dark table table-bordered" style="font-size: 11px">
                        <thead>
                            <tr>
                                <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                                <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="height: 80px"></td>
                                <td style="height: 80px"></td>
                            </tr>
                            <tr>
                                <td class="text-center">[ KA.GUDANG]</td>
                                <td class="text-center">[DIREKTUR]</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</x-hccp-print>
