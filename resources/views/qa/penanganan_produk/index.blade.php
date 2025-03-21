<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('qa.penanganan-produk.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Barang</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Kejadian</th>
                <th>Sumber / Penyebab</th>
                <th>Nama Produk</th>
                <th>Kode Produksi</th>
                <th>Jumlah Produk</th>
                <th>Status</th>
                <th>Penanganan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penanganan as $d)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal($d->tgl_kejadian) }}</td>
                    <td>{{ $d->sumber_penyebab }}</td>
                    <td>{{ $d->nama_produk }}</td>
                    <td>{{ $d->kode_produksi }}</td>
                    <td>{{ $d->jumlah_produk }}</td>
                    <td>{{ $d->status }}</td>
                    <td>{{ $d->penanganan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{route("qa.penanganan-produk.1.print", $d->id)}}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
