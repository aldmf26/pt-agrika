<x-hccp-print :title="$title" :dok="$dok">
    <style>
        table {
            font-family: 'arial'
        }
    </style>
    <div class="row">
        <div class="col-12">
            <table class="table table-xs">
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
                    <td>Nama Produk</td>
                    <td>:</td>
                    <td>{{ ucfirst(strtolower($datas->rwb->grade->nama)) }}</td>
                </tr>
                <tr>
                    <td class="text-center">4.</td>
                    <td>Kode Produksi</td>
                    <td>:</td>
                    <td>{{ $datas->kode_produksi }}</td>
                </tr>
                <tr>
                    <td class="text-center">5.</td>
                    <td>Jumlah Produk</td>
                    <td>:</td>
                    <td>{{ $datas->jumlah_produk }} GR</td>
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
        <span class="text-end table-xs">Tanggal : {{ tanggal($datas->created_at) }} </span>
    </div>
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="25%">Dibuat Oleh:</th>
                        <th class="text-center" width="25%">Diketahui Oleh:</th>
                        <th class="text-center" width="25%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            (QC)
                        </td>
                        <td class="text-center align-middle">
                            (FSTL)
                        </td>
                        <td class="text-center align-middle">
                            (DIREKTUR UTAMA)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
