<x-app-layout :title="$title">
    <div class="row">
        <div class="col-6 d-flex justify-content-end gap-2">

            <a href="{{ route('ia.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</a>
        </div>
        <div class="col-6">
        </div>
        <div class="col-6">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ tanggal($d->tgl) }}</td>
                            <td align="right">
                                <a href="{{ route('ia.2.edit', $d->tgl) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <a href="{{ route('ia.2.print', $d->tgl) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
