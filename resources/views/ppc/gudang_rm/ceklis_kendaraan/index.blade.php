<x-app-layout :title="$title" :size="'col-lg-6'">
    <div class="row">
        <div class="col-12">
            {{-- <a href="{{ route('ppc.gudang-rm.6.create') }}" class="btn btn-sm btn-primary float-end"><i
                    class="fas fa-plus"></i> Data</a> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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

                                    <td>Data : {{ $item->bulan }}/{{ $item->tahun }}</td>

                                    <td>
                                        <a target="_blank" class="btn btn-xs float-end btn-primary"
                                            href="{{ route('ppc.gudang-rm.6.print', ['bulan' => $item->bulan, 'tahun' => $item->tahun]) }}"><i
                                                class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
