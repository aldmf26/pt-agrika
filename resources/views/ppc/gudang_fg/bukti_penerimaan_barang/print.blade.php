<x-hccp-print :title="$title" :dok="$dok">
    @php
        $tgl1 = tanggal($tgl);
    @endphp
    <span><b>Hari/Tanggal :</b> {{ $tgl1 }}</span>

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
            @foreach ($datas as $p)
                @php
                    $rawPartai = $p['nm_partai'];
                    $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                    $partaiArray = array_map('trim', explode(',', $cleaned));
                    $sbwList = DB::table('sbw_kotor')
                        ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                        ->whereIn('nm_partai', $partaiArray)
                        ->get();

                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-center align-middle">
                        {!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}
                    </td>

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
                                Ratna
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
                                Imay
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

                    </div>
                    <div class="form-group">
                        <label for="">Tanggal : </label>
                        <label x-text="tgl" for="">{{ $tgl }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hccp-print>
