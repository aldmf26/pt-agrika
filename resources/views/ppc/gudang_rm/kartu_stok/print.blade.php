<x-hccp-print :title="$title" :kategori="$kategori" :dok="$dok">
    <table class="table-xs" style="font-size: 12px">
        <tr>
            <th width="5%">Nama Material</th>
            <td width="30%">: {{ $kategori == 'sbw' ? $nm_barang : strtoupper($barang->nama_barang) }}</td>
        </tr>
        <tr>
            <th>PIC</th>
            <td>: {{ $kategori != 'sbw' ? 'Ratna,Sinta' : 'Sinta' }}</td>
        </tr>
    </table>
    <table width="100%" class="mt-3 border-dark table table-xs table-bordered">
        <thead>
            <tr>
                <th class="text-center align-middle">Tanggal</th>
                <th class="text-center align-middle">Stok Masuk @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Stok Keluar @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Stok Akhir @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Kode Lot</th>
                <th class="text-center align-middle" width="100">Ttd</th>
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
                        <td class="text-end">{{ \Carbon\Carbon::parse($t['tgl'])->format('d-M-y') }}</td>
                        <td class="text-end">{{ number_format($masuk, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ number_format($keluar, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ number_format($saldo, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ $t['kode_lot'] }}</td>
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
                        <td class="text-end">{{ tanggal($s['tgl']) }} </td>
                        <td class="text-end">{{ $s['ket'] == 'masuk' ? number_format($s['gr'], 0) : 0 }} GR</td>
                        <td class="text-end">{{ $s['ket'] == 'masuk' ? 0 : number_format($s['gr'], 0) }} GR</td>
                        <td class="text-end">{{ number_format($saldo2, 0) }} GR</td>
                        <td class="text-end">{{ $s['no_invoice'] }}</td>
                        <td></td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td width="40%" style="font-size: 11px">
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
                            <td style="height: 80px" class="text-center align-middle">
                                <span style="opacity: 0.5">Ttd & Nama</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">(KA. GUDANG)</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
