<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('ppc.gudang-rm.6.create') }}" class="btn btn-sm btn-primary float-end"><i
                    class="fas fa-plus"></i> Data</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bulan & Tahun</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checklists as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->bulan }}-{{ $item->tahun }}</td>

                            <td>
                                <a class="btn btn-xs float-end btn-primary"
                                    href="{{ route('ppc.gudang-rm.6.print', ['bulan' => $item->bulan, 'tahun' => $item->tahun]) }}"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
