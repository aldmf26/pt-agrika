<x-hccp-print :title="$title" :dok="$dok">
    <style>
        table {
            font-family: 'arial'
        }
    </style>
    <div class="row">
        <div class="col-12">
            <table class="table ">
                <tr>
                    <td class="text-center">1.</td>
                    <td width="10">Tanggal Kejadian</td>
                    <td width="5">:</td>
                    <td>{{ tanggal($datas->tgl_kejadian) }}</td>
                </tr>
                <tr>
                    <td class="text-center">2.</td>
                    <td>Sumber/Penyebab</td>
                    <td>:</td>
                    <td>{{ $datas->sumber_penyebab }}</td>
                </tr>
                <tr>
                    <td class="text-center">3.</td>
                    <td>Nama produk</td>
                    <td>:</td>
                    <td>{{ $datas->nama_produk }}</td>
                </tr>
                <tr>
                    <td class="text-center">4.</td>
                    <td>Kode produksi</td>
                    <td>:</td>
                    <td>{{ $datas->kode_produksi }}</td>
                </tr>
                <tr>
                    <td class="text-center">5.</td>
                    <td>Jumlah Produk</td>
                    <td>:</td>
                    <td>{{ $datas->jumlah_produk }} gram</td>
                </tr>
                <tr>
                    <td class="text-center">6.</td>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ $datas->status }}</td>
                </tr>
                <tr>
                    <td class="text-center">7.</td>
                    <td>Penanganan</td>
                    <td>:</td>
                    <td>
                        <div>
                            @foreach (explode("\n", $datas->penanganan) as $index => $line)
                                <div style="margin-left: 20px; text-indent: -20px;">
                                    {{ trim($line) }}
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <span class="text-end">Tanggal : {{ tanggal($datas->created_at) }} </span>
    </div>
    <table width="100%">
        <tr>
            <td width="60%">

            </td>
            <td style="width: 40%">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">mengetahui:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[QC]</td>
                            <td class="text-center">[FSTL & Director]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</x-hccp-print>
