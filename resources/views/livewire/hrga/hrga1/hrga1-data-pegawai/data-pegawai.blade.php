<div>


    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="d-flex justify-content-end">
        <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</button>
    </div>

    <x-wire-table :datas="$datas">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="">No</th>
                    <th class="">Divisi / Dept</th>
                    <th class="">Nik</th>
                    <th class="">Nama</th>
                    <th class="">Jenis Kelamin/ <br>Tgl lahir</th>
                    <th class="">Status</th>
                    <th class="">Tgl Masuk</th>
                    <th class="">Posisi</th>
                </tr>
            </thead>
            @foreach ($datas as $i => $d)
                <tbody>
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->divisi->divisi ?? '' }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->jenis_kelamin }} / {{ $d->tgl_lahir }}</td>
                        <td>{{ $d->status }}</td>
                        <td>
                            {{ $d->tgl_masuk == null ? '-' : tanggal($d->tgl_masuk) }}
                            @if ($d->tgl_masuk != null)
                                ({{ $lamaKerja = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInYears(now()) }} tahun {{ $lamaKerja2 = (int) \Carbon\Carbon::parse($d->tgl_masuk)->diffInMonths(now()) % 12 }} bulan)
                            @endif
                        </td>
                        <td>{{ $d->posisi }}</td>
                    </tr>

                </tbody>
            @endforeach
        </table>
    </x-wire-table>
</div>
