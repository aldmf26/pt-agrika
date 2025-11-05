<x-hccp-print :title="$title" :dok="$dok">

    <span>Update : {{ tanggal(date('Y-m-d')) }}</span>
    <div class="row">
        <div class="col-12">
            <table class="table border-dark table-bordered">
                <thead>
                    <tr style="font-size: 12px" class="text-center align-middle">
                        <th class="text-center">No</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center ">Nama</th>
                        <th class="text-center">Nomor Ktp (Nik)</th>
                        <th class="text-center">Posisi</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center" width="10%">Tanggal Lahir</th>
                        <th class="text-center">Status (Tetap / Kontrak / <br>
                            Borongan)</th>
                        <th class="text-center" width="10%">Tanggal Masuk</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas->sortByDesc('tgl_masuk') as $d)
                        <tr style="font-size: 13px" class="text-center align-middle">
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $d->divisi->divisi ?? 'Cabut Bulu' }}</td>
                            <td class="text-start">{{ ucwords($d->nama) ?? '' }}</td>
                            <td class="text-end">{{ $d->nik ?? '' }}</td>
                            <td>{{ ucwords($d->posisi) ?? '' }}</td>
                            <td>{{ ucwords($d->jenis_kelamin) }}</td>
                            <td class="text-end">{{ tanggal($d->tgl_lahir) ? tanggal($d->tgl_lahir) : '' }}</td>
                            <td>{{ ucwords($d->status) ?? '' }}</td>
                            <td class="text-end">{{ tanggal($d->tgl_masuk) ? tanggal($d->tgl_masuk) : '' }}</td>
                            <td>{{ $d->deleted_at == null ? '-' : tanggal($d->deleted_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
        <div class="col-7"></div>
        <div class="col-3"></div>
        <div class="col-2">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(KEPALA HRGA)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
