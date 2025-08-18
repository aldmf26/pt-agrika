<x-hccp-print :title="$title" :dok="$dok">

    <table width="100%">
        {{-- <tr>
            <th width="10%">Nama Barang</th>
            <td width="50%">: {{ strtoupper($kartu[0]->produk->nama_produk) }}</td>
        </tr> --}}
        <tr>
            <th>Nama Produk</th>
            <td>: {{ $grade }}</td>
        </tr>
        <tr>
            <th>Jenis Kemasan</th>
            <td>:
                {{ $grade == 'sbt' ? 'Plastik Mika (21,8 x 16,8 x 10 cm)' : 'Plastik Mika (21,8 x 16,8 x 7 cm)' }}
            </td>
        </tr>
        <tr>
            <th>PIC</th>
            <td>: Ratna Sari</td>
        </tr>
    </table>
    <table width="100%" class="border-dark table table-xs table-bordered" style="font-size: 10px">
        <tr>
            <th class="text-center align-middle" rowspan="2">Tanggal</th>
            <th class="text-center" colspan="2">Stok Masuk</th>
            <th class="text-center" colspan="2">Stok Keluar</th>
            <th class="text-center" colspan="2">Stok Akhir</th>
            <th class="text-center align-middle" rowspan="2">Kode batch produk</th>
            <th class="text-center align-middle" rowspan="2">Ttd</th>
        </tr>
        <tr>
            <th class="text-end">Pcs</th>
            <th class="text-end">Gr</th>
            <th class="text-end">Pcs</th>
            <th class="text-end">Gr</th>
            <th class="text-end">Pcs</th>
            <th class="text-end">Gr</th>
        </tr>
        @php
            $saldo_pcs = 0;
            $saldo_gr = 0;
        @endphp
        @foreach ($kartu as $d)
            @php
                $saldo_pcs += ($d['ket'] == 'masuk' ? $d['pcs'] : 0) - ($d['ket'] == 'keluar' ? $d['pcs'] : 0);
                $saldo_gr += ($d['ket'] == 'masuk' ? $d['gr'] : 0) - ($d['ket'] == 'keluar' ? $d['gr'] : 0);

                $rawPartai = $d['nm_partai'];
                $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                $partaiArray = array_map('trim', explode(',', $cleaned));
                $sbwList = DB::table('sbw_kotor')
                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                    ->whereIn('nm_partai', $partaiArray)
                    ->get();
            @endphp
            <tr>
                <td class="text-center align-middle">{{ tanggal($d['tgl']) }}</td>
                <td class="text-end align-middle">{{ $d['ket'] == 'masuk' ? number_format($d['pcs']) : '0' }}</td>
                <td class="text-end align-middle">{{ $d['ket'] == 'masuk' ? number_format($d['gr']) : '0' }}</td>
                <td class="text-end align-middle">{{ $d['ket'] == 'keluar' ? number_format($d['pcs']) : '0' }}</td>
                <td class="text-end align-middle">{{ $d['ket'] == 'keluar' ? number_format($d['gr']) : '0' }}</td>
                <td class="text-end align-middle">{{ number_format($saldo_pcs, 0) }}</td>
                <td class="text-end align-middle">{{ number_format($saldo_gr, 0) }}</td>
                <td class="text-center">{!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
                <td></td>
            </tr>
        @endforeach
    </table>

    <table width="100%">
        <tr>
            <td width="70%">
                <p>Note:</p>
                * Coret yang tidak perlu
            </td>
            <td style="width: 30%">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td style="height: 80px"></td>
                        </tr>
                        <tr>

                            <td class="text-center">[ KA. GUDANG WIP]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
