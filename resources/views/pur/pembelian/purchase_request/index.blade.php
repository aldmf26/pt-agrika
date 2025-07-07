<x-app-layout :title="$title">

    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('pur.pembelian.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Purchase Request</a>
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-start">No PR</th>
                <th>Tanggal</th>
                <th>Diminta Oleh</th>
                <th>Posisi</th>
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
                    <td>{{ $d->alasan_permintaan }}</td>
                    <td>
                        @if ($d->status == 'disetujui')
                            @if ($d->sudahPo->count() == 0)
                                <a class="btn btn-xs btn-info"
                                    href="{{ route('pur.pembelian.2.create', ['id_pr' => $d->id]) }}">po</a>
                            @endif
                            <a class="btn btn-xs btn-primary" href="{{ route('pur.pembelian.1.print', $d->id) }}"><i
                                    class="fas fa-print"></i></a>
                        @else
                            <a class="btn btn-xs btn-info"
                                href="{{ route('pur.pembelian.1.selesai', $d->id) }}">selesai</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
