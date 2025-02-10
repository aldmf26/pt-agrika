<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12 d-flex justify-content-end gap-2">

            <a href="{{ route('ia.4.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</a>
        </div>

        <div class="col-12">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Departemen</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Jumlah Laporan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $d->departemen }}</td>
                            <td>{{ tanggal($d->tgl_audit) }}</td>
                            <td>{{ $d->count }}</td>
                            <td align="right">
                                @php
                                    $param = [
                                        'tgl' => $d->tgl_audit,
                                        'departemen' => $d->departemen,
                                    ];
                                @endphp
                                {{-- <a href="{{ route('ia.4.edit', $param) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-edit"></i> Edit</a> --}}
                                <a href="{{ route('ia.4.print', $param) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
