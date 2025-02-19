<x-hccp-print :title="$title" :dok="$dok">
    @php
        $tgl = tanggal($datas[0]->tanggal_terima);
    @endphp
    <span><b>Hari/Tanggal :</b> {{$tgl}}</span>

    <table style="font-size: 10px" class="mt-2 table table-bordered border-dark">
        <thead class="bg-info text-center align-middle">
            <tr>
                <th class="text-white" rowspan="2">No</th>
                <th class="text-white" rowspan="2">Nama dan Jenis Kode Produk (XXXX)</th>
                <th class="text-white" colspan="2">Jumlah</th>
                <th class="text-white" rowspan="2">No Batch/ <span style="font-size: 6px">
                        Kode SBW kotor untuk Sarang Walet</span>
                </th>
                <th class="text-white" rowspan="2">Lot Produk Jadi</th>
                <th class="text-white" rowspan="2">Barcode</th>
                <th class="text-white" rowspan="2">Tanggal Produksi (YYMMDD)</th>
                <th class="text-white" rowspan="2">Status OK/Tidak</th>
            </tr>
            <tr>
                <th class="text-white">Serah</th>
                <th class="text-white">Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk . ' ' . $detail->produk->kode_produk }}</td>
                    <td>{{ $detail->terima }} {{ $detail->produk->satuan }}</td>
                    <td>{{ $detail->serah }} {{ $detail->produk->satuan }}</td>
                    <td>{{ $detail->nomor_batch }}</td>
                    <td>{{ $detail->lot }}</td>
                    <td>{{ $detail->barcode }}</td>
                    <td>{{ date('ymd', strtotime($detail->tanggal_produksi)) }}</td>
                    <td align="center">{{ $detail->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-6">
            <span class="text-xs">Barang diterima Warehouse FG/ Produk Jadi:</span>
            <div class="mb-3">
                <table class="table table-xs table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td x-text="tgl">{{ $tgl }}</td>
                            <td>
                                {{$datas[0]->nama_penerima}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-6">
            <span class="text-xs">Penyerahan Barang oleh Warehouse FG/Produk Jadi:</span>
            <div class="mb-3">
                <table class="table-xs table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td x-text="tgl">{{ $tgl }}</td>
                            <td>
                                {{$datas[0]->nama_penyerah}}

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h6 class="text-center">Tanda tangan</h6>
                <h6 class="text-center">Diserahterimakan Produksi</h6>
                <h6 class="text-center">Diserahterimakan Produksi</h6>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nama</label>
                        {{$datas[0]->nama_ttd}}
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal : </label>
                        <label x-text="tgl" for="">{{ $tgl }}</label>
                    </div>
                </div>
    </div>
</x-hccp-print>
