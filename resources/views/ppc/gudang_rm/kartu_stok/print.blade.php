<x-hccp-print :title="$title" :dok="$dok">

    <table width="10%" class="border-dark table table-sm table-bordered">
        <tr>
            <th width="20%">Nama Material</th>
            <td width="50%">: {{ $kategori == 'sbw' ? $nm_barang : strtoupper($barang->nama_barang) }}</td>
        </tr>
        <tr>
            <th>PIC</th>
            <td>: {{ $kategori != 'sbw' ? 'Ratna,Sinta' : 'Sinta' }}</td>
        </tr>
    </table>
    <table width="100%" class="border-dark table table-xs table-bordered">
        <thead>
            <tr>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Stok Masuk</th>
                <th class="text-center">Stok Keluar</th>
                <th class="text-center">Stok Akhir</th>
                <th class="text-center">Kode Lot</th>
                <th class="text-center">Ttd</th>
            </tr>
        </thead>
        <tbody>
            @if ($kategori != 'sbw')
                @php $saldo = 0; @endphp
                @foreach ($transaksi as $t)
                    @php
                        if ($t['jenis'] == 'masuk') {
                            $masuk = $t['jumlah'];
                            $keluar = 0;
                            $saldo += $masuk;
                        } else {
                            $masuk = 0;
                            $keluar = $t['jumlah'];
                            $saldo -= $keluar;
                        }
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($t['tgl'])->format('d-M-y') }}</td>
                        <td align="right">{{ number_format($masuk, 0) }}</td>
                        <td align="right">{{ number_format($keluar, 0) }}</td>
                        <td align="right">{{ number_format($saldo, 0) }}</td>
                        <td>{{ $t['kode_lot'] }}</td>
                        <td></td>
                    </tr>
                @endforeach
            @else
                @php
                    $saldo2 = 0;
                @endphp
                @foreach ($sbw as $s)
                    @php
                        $saldo2 += ($s['ket'] == 'masuk' ? $s['gr'] : 0) - ($s['ket'] == 'masuk' ? 0 : $s['gr']);
                    @endphp
                    <tr>
                        <td>{{ tanggal($s['tgl']) }} </td>
                        <td class="text-end">{{ $s['ket'] == 'masuk' ? number_format($s['gr'], 0) : 0 }}</td>
                        <td class="text-end">{{ $s['ket'] == 'masuk' ? 0 : number_format($s['gr'], 0) }}</td>
                        <td class="text-end">{{ number_format($saldo2, 0) }}</td>
                        <td class="text-center">{{ $s['no_invoice'] }}</td>
                        <td></td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td width="40%">
                <p>Note:</p>
                * Coret yang tidak perlu
            </td>
            <td style="width: 10%">
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
                            <td class="text-center">[KA.GUDANg]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
