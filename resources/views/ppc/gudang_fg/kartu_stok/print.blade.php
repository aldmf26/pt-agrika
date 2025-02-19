<x-hccp-print :title="$title" :dok="$dok">
    
    <table width="10%" class="border-dark table table-sm table-bordered">
        <tr>
            <th width="10%">Nama Barang</th>
            <td width="50%">: {{strtoupper($kartu[0]->produk->nama_produk)}}</td>
        </tr>
        <tr>
            <th>Grade</th>
            <td>: </td>
        </tr>
        <tr>
            <th>Gudang</th>
            <td>: FG</td>
        </tr>
    </table>
    <table width="100%" class="border-dark table table-xs table-bordered">
        <tr>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Stok Masuk</th>
            <th class="text-center">Stok Keluar</th>
            <th class="text-center">Stok Akhir</th>
            <th class="text-center">Kode batch produk</th>
            <th class="text-center">Ttd</th>
        </tr>
        @foreach ($kartu as $d)
        <tr>
            <td>{{ \Carbon\Carbon::parse($d->tanggal)->format('d-M-y') }}</td>
            <td align="right">{{ number_format($d->stok_masuk,0) }} {{ $d->produk->satuan }}</td>
            <td align="right">{{ number_format($d->stok_keluar,0) }} {{ $d->produk->satuan }}</td>
            <td align="right">{{ number_format($d->stok_akhir,0) }} {{ $d->produk->satuan }}</td>
            <td>{{ $d->nomor_batch }}</td>
            <td>{{ $d->ttd_petugas }}</td>
        </tr>
        @endforeach
    </table>

    <table width="100%">
        <tr>
            <td width="40%">
                <p>Note:</p>
                * Coret yang tidak perlu
            </td>
            <td style="width: 60%">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[Leader GDPM&GDFG]</td>
                            <td class="text-center">[SPV. Logistik]</td>
                            <td class="text-center">[ KA.PPIC]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
