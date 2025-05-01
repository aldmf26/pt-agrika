<x-app-layout :title="$title">

    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('pur.pembelian.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Purchase Request</a>
        </div>
    </div>
   
    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-start">No PR</th>
                <th>Tanggal</th>
                <th>Diminta Oleh</th>
                <th>Posisi</th>
                <th>Departemen</th>
                <th>Manajer Departemen</th>
                <th>Alasan Permintaan</th>
                <td class="text-center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start">{{ $d->no_pr }}</td>
                    <td>{{ tanggal($d->tgl) }}</td>
                    <td>{{ $d->diminta_oleh }}</td>
                    <td>{{ $d->posisi }}</td>
                    <td>{{ $d->departemen }}</td>
                    <td>{{ $d->manager_departemen }}</td>
                    <td>{{ $d->alasan_permintaan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{ route('pur.pembelian.1.print', $d->id) }}"><i
                                class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
