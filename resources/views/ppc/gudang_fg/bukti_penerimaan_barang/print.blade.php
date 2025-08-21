<x-hccp-print :title="$title" :dok="$dok">
    @php
        $tgl1 = tanggal($tgl);
    @endphp
    <span><b>Hari/Tanggal :</b> {{ $tgl1 }}</span>

    <table style="font-size: 10px" class="mt-2 table table-bordered border-dark">
        <thead class=" text-center align-middle">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Produk</th>
                <th rowspan="2">Kode Produk</th>
                <th colspan="3" class="text-center">Jumlah</th>
                <th colspan="2" class="text-center">Jenis Kemasan</th>
                <th rowspan="2">No Batch/ Kode SBW kotor <br> untuk Sarang Walet</th>
                <th rowspan="2">Barcode</th>
                <th rowspan="2">Tgl/bln/thn <br> Produksi <br> (Steaming) <br> steaming production <br> date</th>
                <th rowspan="2">Status <br> Ok/Tidak</th>

            </tr>
            <tr>
                <th class="text-end">Pcs</th>
                <th class="text-end">Gram</th>
                <th>Pack</th>
                <th>Premier</th>
                <th>Sekunder</th>
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
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td class=" align-middle">
                        {!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}
                    </td>
                    <td class=" align-middle">{{ $p['grade'] }}</td>
                    <td class="text-end align-middle">{{ number_format($p['pcs'], 0) }}</td>
                    <td class="text-end align-middle">{{ number_format($p['gr'], 0) }}</td>
                    <td class=" align-middle">1 pack</td>
                    <td class=" align-middle">
                        {{ $p['grade'] == 'sbt' ? 'Plastik Mika (21,8 x 16,8 x 10 cm)' : 'Plastik Mika (21,8 x 16,8 x 7 cm)' }}
                    </td>
                    <td class=" align-middle">
                        -
                    </td>
                    <td class=" align-middle">
                        {!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}
                    </td>
                    <td class=" align-middle">
                        {{ $p['no_barcode'] }}
                    </td>
                    <td class=" align-middle">
                        {{ $tgl1 }}
                    </td>
                    <td class=" align-middle">
                        Ok
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-8">
            <div class="">
                <table width="100%" border="1"
                    style="border-collapse: collapse; text-align: left; font-size: 10px">
                    <!-- Bagian Barang Diterima -->
                    <tr>
                        <th colspan="2" style="padding: 5px;border-right: 1px solid black;">Barang diterima Warehouse
                            FG/ Produk Jadi:</th>
                        <th style="padding: 5px; border-bottom: 1px solid black; border-top: 1px solid black">
                            Tanda tangan
                        </th>
                    </tr>
                    <tr>
                        <td style="padding: 5px; width: 20%;">Tanggal</td>
                        <td style="padding: 5px;border-right: 1px solid black;">: {{ $tgl1 }}</td>
                        <td rowspan="2"></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid black; " class="text-nowrap">Nama Penerima
                        </td>
                        <td style="padding: 5px;border-right: 1px solid black;border-bottom: 1px solid black;">: Ratna
                            Sari
                        </td>

                    </tr>

                    <!-- Bagian Penyerahan Barang -->
                    <tr>
                        <th colspan="2" style="padding: 5px;border-right: 1px solid black;">Penyerahan Barang kepada
                            Warehouse FG/ Produk Jadi:
                        </th>
                        <th style="padding: 5px; border-bottom: 1px solid black; border-top: 1px solid black">
                            Tanda tangan
                        </th>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">Tanggal</td>
                        <td style="padding: 5px;border-right: 1px solid black;">: {{ $tgl1 }}</td>
                        <td rowspan="2"></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px;">Nama Penerima</td>
                        <td style="padding: 5px;border-right: 1px solid black;">: Maysarah</td>

                    </tr>
                </table>
            </div>
        </div>



    </div>

    {{-- <div class="row">
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
    </div> --}}
</x-hccp-print>
