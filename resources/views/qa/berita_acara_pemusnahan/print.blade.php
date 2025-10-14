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
                        <th class=" text-center align-middle">No</th>
                        <th class=" text-center align-middle">Nama Produk</th>
                        <th class=" text-center align-middle">Jumlah</th>
                        <th class=" text-center align-middle">Cakupan Pemusnahan</th>
                        <th class=" text-center align-middle">Alasan Pemusnahan</th>
                        <th class=" text-center align-middle">Tgl Pemusnahan</th>
                        <th class=" text-center align-middle">Paraf Pelaksana</th>
                        <th class=" text-center align-middle">Paraf Saksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ $d->rwb->grade->nama }}</td>
                            <td>{{ $d->jumlah_produk }} GR</td>
                            <td>{{ $d->beritaAcara->cakupan ?? '-' }}</td>
                            <td>{{ $d->beritaAcara->alasan }}</td>
                            <td class="text-end">{{ empty($d->beritaAcara->tgl) ? '-' : tanggal($d->beritaAcara->tgl) }}
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
