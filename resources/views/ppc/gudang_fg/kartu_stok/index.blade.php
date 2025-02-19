<x-app-layout :title="$title">
    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok Akhir</th>
                <th>Gudang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kartu as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->produk->nama_produk }}</td>
                    <td>{{ $d->produk->satuan }}</td>
                    <td>{{ number_format($d->stok_akhir,0) }}</td>
                    <td>FG</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{route("ppc.gudang-fg.4.print", $d->id_produk)}}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
</x-app-layout>