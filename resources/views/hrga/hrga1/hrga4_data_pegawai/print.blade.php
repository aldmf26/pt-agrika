<x-hccp-print :title="$title" :dok="$dok">
    
    <span>Update :  11 Dec 2024</span>
    <table class="table border-dark table-bordered">
        <thead>
            <tr class="text-center align-middle">
                <th class="head">NO</th>
                <th class="head">DIVISI / DEPT</th>
                <th class="head">NAMA</th>
                <th class="head">JENIS KELAMIN/ <br> TANGGGAL LAHIR</th>
                <th class="head">STATUS</th>
                <th class="head">TANGGAL MASUK</th>
                <th class="head">POSISI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->divisi->divisi ?? '' }}</td>
                    <td>{{ $d->nama ?? '' }}</td>
                    <td>{{ $d->jenis_kelamin ?? '' }} /{{ $d->tgl_lahir ?? '' }}</td>
                    <td>{{ $d->status ?? '' }}</td>
                    <td>{{ $d->tgl_masuk ?? '' }}</td>
                    <td>{{ $d->posisi ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-7"></div>
        <div class="col-5">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[SPV. HR]</td>
                        <td class="text-center">[KA. HRGA]</td>
                        <td class="text-center">[DIREKTUR]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>