<x-app-layout :title="$title" :size="'col-lg-6'">
    <div class="row">
        {{-- <div class="col-12">
            <a href="{{ route('ppc.gudang-fg.2.create') }}" class="btn btn-sm btn-primary float-end"><i
                    class="fas fa-plus"></i> Data</a>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengiriman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['bulan'] }}</td>
                            <td>{{ $item['tahun'] }}</td>
                            <td>
                                <a class="btn btn-xs  btn-primary" target="_blank"
                                    href="{{ route('ppc.gudang-fg.2.print', ['bulan' => $item['bulan'], 'tahun' => $item['tahun']]) }}"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
