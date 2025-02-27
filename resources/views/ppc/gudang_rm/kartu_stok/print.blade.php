<x-hccp-print :title="$title" :dok="$dok">
    
    <table width="10%" class="border-dark table table-sm table-bordered">
        <tr>
            <th width="10%">Nama Barang</th>
            <td width="50%">: {{strtoupper($barangs[0]->barang->nama_barang)}}</td>
        </tr>
      
        <tr>
            <th>Gudang</th>
            <td>: RM</td>
        </tr>
    </table>
    <table width="100%" class="border-dark table table-xs table-bordered">
        <tr>
            <th class="head text-center">Tanggal</th>
            <th class="head text-center">Stok Masuk</th>
            <th class="head text-center">Stok Keluar</th>
            <th class="head text-center">Stok Akhir</th>
            <th class="head text-center">Kode Lot</th>
            <th class="head text-center">Ttd</th>
        </tr> 
        @foreach ($barangs as $b)
            <tr>
                <td>{{ \Carbon\Carbon::parse($b->tgl)->format('d-M-y') }}</td>
                <td align="right">{{ $b->jenis === 'masuk' ? number_format($b->qty, 0) : 0 }}</td>
                <td align="right">{{ $b->jenis === 'keluar' ? number_format($b->qty, 0) : 0 }}</td>
                <td align="right">{{ number_format($b->stok_sesudah, 0) }}</td>
                <td align="right">{{ $b->lot->kode_lot }}</td>
                <td></td>
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
                            <td class="text-center">[Leader]</td>
                            <td class="text-center">[SPV. Logistik]</td>
                            <td class="text-center">[KA.PPIC]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
