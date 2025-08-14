<x-hccp-print :title="$title" :dok="$dok">

    <span>Update : {{ date('d-m-Y') }}</span>
    <table class="table border-dark table-bordered">
        <thead>
            <tr style="font-size: 12px" class="text-center align-middle">
                <th class="head">No</th>
                <th class="head">Divisi</th>
                <th class="head text-start">Nama</th>
                <th class="head">Nomor Ktp (Nik)</th>
                <th class="head">Posisi</th>
                <th class="head">Jenis Kelamin</th>
                <th class="head" width="10%">Tanggal Lahir</th>
                <th class="head">Status <br> <span style="font-size: 10px">(Tetap / <br> Kontrak / <br>
                        Borongan)</span></th>
                <th class="head" width="10%">Tanggal Masuk</th>
                <th class="head">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr style="font-size: 13px" class="text-center align-middle">
                    <td>{{ $loop->iteration }}</td>
                    <td align="left">{{ $d->divisi->divisi ?? 'Cabut Bulu' }}</td>
                    <td align="left">{{ $d->nama ?? '' }}</td>
                    <td>{{ $d->nik ?? '' }}</td>
                    <td>{{ $d->posisi ?? '' }}</td>
                    <td>{{ $d->jenis_kelamin }}</td>
                    <td>{{ $d->tgl_lahir ? ddmmyyy($d->tgl_lahir) : '' }}</td>
                    <td>{{ $d->status ?? '' }}</td>
                    <td>{{ $d->tgl_masuk ? ddmmyyy($d->tgl_masuk) : '' }}</td>
                    <td>{{ $d->deleted_at == null ? '-' : ddmmyyy($d->deleted_at) }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-7"></div>
        <div class="col-3"></div>
        <div class="col-2">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Disetujui Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[KA. HRGA]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
