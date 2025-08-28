<x-hccp-print :title="$title" :dok="$dok">
    <style>
        table {
            font-family: 'arial'
        }
    </style>
    <div class="row">
        <div class="col-12">
            <table class="table table-xs table-bordered border-dark">
                <thead>
                    <tr>
                        <th class=" text-center">NO</th>
                        <th class=" text-start">Nama Produk</th>
                        <th class=" text-start">Jumlah</th>
                        <th class=" text-start">Cakupan Pemusnahan</th>
                        <th class=" text-start">Alasan Pemusnahan</th>
                        <th class=" text-start">Tgl Pemusnahan</th>
                        <th class=" text-start">Paraf Pelaksana</th>
                        <th class=" text-start">Paraf Saksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $d->rwb->grade->nama }}</td>
                            <td>{{ $d->jumlah_produk }} gram</td>
                            <td>{{ $d->cakupan_pemusnahan }}</td>
                            <td>{{ $d->alasan_pemusnahan }}</td>
                            <td>{{ empty($d->tgl_pemusnahan) ? '-' : tanggal($d->tgl_pemusnahan) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <table width="100%">
        <tr>
            <td width="60%">

            </td>
            <td style="width: 40%">
                <table class="" style="font-size: 11px; text-align: end; width: 100%">
                    <thead>
                        <tr>
                            <td class="text-center" width="33.33%">Dibuat Oleh:</td>
                            <td class="text-center" width="33.33%"></td>
                            <td class="text-center" width="33.33%">Mengetahui:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">QC / QA</td>
                            <td class="text-center">FSTL</td>
                            <td class="text-center">Director</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</x-hccp-print>
