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
                        <th class="head text-center">NO</th>
                        <th class="head text-center">Nama Produk</th>
                        <th class="head text-center">Jumlah</th>
                        <th class="head text-center">Cakupan Pemusnahan</th>
                        <th class="head text-center">Alasan Pemusnahan</th>
                        <th class="head text-center">Tgl Pemusnahan</th>
                        <th class="head text-center">Paraf Pelaksana</th>
                        <th class="head text-center">Paraf Saksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_produk }}</td>
                        <td>{{ $d->jumlah }}</td>
                        <td>{{ $d->cakupan }}</td>
                        <td>{{ $d->alasan }}</td>
                        <td>{{ tanggal($d->tgl) }}</td>
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
                            <td class="text-center">[QC / QA]</td>
                            <td class="text-center">[FSTL & Director]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</x-hccp-print>
