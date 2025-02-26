<x-app-layout :title="$title">
<div class="row">
    <div class="col-12">
        <a href="{{ route('ppc.gudang-fg.2.create') }}" class="btn btn-sm btn-primary float-end"><i class="fas fa-plus"></i> Data</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>No Kendaraan</th>
                    <th>Pengemudi</th>
                    <th>Tujuan</th>
                    <th>Customer</th>
                    <th>Keputusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checklists as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal($item->tanggal) }}</td>
                    <td>{{ $item->nomor_kendaraan }}</td>
                    <td>{{ $item->pengemudi }}</td>
                    <td>{{ $item->tujuan }}</td>
                    <td>{{ $item->customer }}</td>
                    <td>{{ $item->keputusan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{route("ppc.gudang-fg.2.print", $item->nomor_kendaraan)}}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>