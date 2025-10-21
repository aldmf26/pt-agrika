<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12 d-flex justify-content-end gap-2">

            <a href="{{ route('ia.4.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</a>
            <a href="{{ route('ia.4.print') }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                Print</a>
        </div>

        <div class="col-12">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center" width="120">Tanggal</th>
                        <th class="text-center">Tindakan</th>
                        <th class="text-center">Finding</th>
                        <th class="text-center">Audite</th>
                        <th class="text-center">PIC</th>
                        <th class="text-center">Completion Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $r)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $r->divisi }}</td>
                            <td>{{ tanggal($r->tgl_audit) }}</td>
                            <td>{{ $r->tindakan }}</td>
                            <td>{{ $r->finding }}</td>
                            <td>{{ $r->audite }}</td>
                            <td>{{ $r->pic }}</td>
                            <td>{{ tanggal($r->completion_date) }}</td>
                            <td>{{ $r->status }}</td>
                            <td align="right">
                                <a href="{{ route('ia.4.edit', $r) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    href="{{ route('ia.4.destroy', $r->id) }}" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
