<style>
    @media print {
        table {
            page-break-inside: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    }

    .logo {
        height: 40px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    th,
    td {
        border: 1px solid black;
        padding: 4px;
        text-align: center;
    }

    .judul {
        font-weight: bold;
        font-size: 14px;
        text-align: center;
    }

    .subjudul {
        font-size: 10px;
        text-align: center;
        font-style: italic;
    }

    .regu {
        text-align: left;
        font-size: 12px;
        padding-left: 10px;
    }
</style>

<table>
    <thead>
        <tr>
            <th colspan="20" style="border: none;">
                <img src="{{ asset('img/logo.jpeg') }}" class="logo" style="float:left;">
                <div style="text-align:right; font-size: 10px;">No Dok: FRM.PRO.01.03, Rev 00</div>
                <div class="judul">FORM PENCUCIAN AWAL, PENCABUTAN BULU & PENGERINGAN 1</div>
                <div class="subjudul">Feather removal and Drying 1 Report</div>
                <br>
                <div class="regu">
                    <strong>Regu</strong><br>
                    <span class="fst-italic">Team</span> : Norjanah
                </div>

            </th>
        </tr>
        <tr>
            <!-- Judul kolom -->
            <th>No</th>
            <th>Nama Operator</th>
            <th>Kode Batch</th>
            <th>No Box</th>
            <th>Jenis</th>
            <th>Tanggal Terima</th>
            <th>Pcs</th>
            <th>Gr</th>
            <th>Pcs Retur</th>
            <th>Gr Retur</th>
            <th>Tanggal Selesai</th>
            <th>Pcs OK</th>
            <th>Gr OK</th>
            <th>Pcs Not OK</th>
            <th>Gr Not OK</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>% Susut</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cabut as $c)
            @php
                $sbw = DB::table('sbw_kotor')
                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                    ->where('nm_partai', 'like', '%' . $c['nm_partai'] . '%')
                    ->first();
                $susut = (1 - $c['gr_akhir'] / $c['gr']) * 100;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords(strtolower($c['nm_anak'])) }}</td>
                <td>{{ $sbw->no_invoice }}</td>
                <td>{{ $c['no_box'] }}</td>
                <td>{{ $sbw->nama }}</td>
                <td>{{ tanggal($c['tgl']) }}</td>
                <td>{{ number_format($c['pcs'], 0) }}</td>
                <td>{{ number_format($c['gr'], 0) }}</td>
                <td>0</td>
                <td>0</td>
                <td>{{ tanggal($c['tgl']) }}</td>
                <td>{{ number_format($c['pcs'], 0) }}</td>
                <td>{{ number_format($c['gr_akhir'], 0) }}</td>
                <td>0</td>
                <td>0</td>
                <td>17:00</td>
                <td>03:00</td>
                <td>{{ number_format($susut, 0) }}%</td>
                <td>{{ $susut < 15 ? 'OK' : 'Not OK' }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
