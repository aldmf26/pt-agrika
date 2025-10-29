<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <table>
                <tr>
                    <td width="50%">Kode Barang</td>
                    <td width="50%">: {{ $barang->kode_barang }}</td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <th>: {{ $barang->nama_barang }}</th>
                </tr>
                <tr>
                    <td>Supplier</td>
                    <td>: {{ $barang->supplier->nama_supplier }}</td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>: {{ number_format($stok, 0) }} {{ $barang->satuan }}</td>
                </tr>
            </table>

            <div class="row">
                <div class="col-6">
                    <h5 class="mt-5">Penerimaan Barang/Kemasan</h5>
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>No PO</th>
                            <th>Tanggal Penerimaan</th>
                            <th class="text-end">Jumlah</th>
                        </tr>

                        @foreach ($barang->penerimaan as $p)
                            <tr>
                                <td>{{ $p->no_po }}</td>
                                <td>{{ tanggal($p->tanggal_terima) }}</td>
                                <td align="right">{{ number_format($p->jumlah_barang, 0) }}</td>
                            </tr>
                        @endforeach

                        @foreach ($barang->penerimaanKemasan as $p)
                            <tr>
                                <td>{{ $p->no_po }}</td>
                                <td>{{ tanggal($p->tanggal_penerimaan) }}</td>
                                <td align="right">{{ number_format($p->jumlah_barang, 0) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">Total</th>
                            <th class="text-end">
                                {{ number_format($barang->penerimaan->sum('jumlah_barang') + $barang->penerimaanKemasan->sum('jumlah_barang'), 0) }}
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <h5 class="mt-5">Pengeluaran Barang/Kemasan</h5>
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>Nama Pemohon</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th class="text-end">Jumlah</th>
                        </tr>

                        @foreach ($barang->pengeluaran as $p)
                            <tr>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->departemen }}</td>
                                <td>{{ tanggal($p->tgl) }}</td>
                                <td align="right">{{ number_format($p->pcs, 0) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3">Total</th>
                            <th class="text-end">{{ number_format($barang->pengeluaran->sum('pcs'), 0) }}
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="col-6">
                    <h5>Purchase Request</h5>
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>No PR</th>
                            <th>Tanggal Dibutuhkan</th>
                            <th>Harga PO</th>
                            <th class="text-end">Jumlah</th>
                        </tr>

                        @foreach ($barang->purchaseRequestItem as $p)
                            <tr>
                                <td>{{ $p->pr->no_pr }}</td>
                                <td>{{ tanggal($p->tgl_dibutuhkan) }}</td>
                                <td align="right">{{ number_format($p->harga_po, 0) }}</td>
                                <td align="right">{{ number_format($p->jumlah, 0) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
