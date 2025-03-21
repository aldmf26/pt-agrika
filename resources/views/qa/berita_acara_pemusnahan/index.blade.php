<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('qa.penanganan-produk.2.print') }}" class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                Print</a>

            <a href="{{ route('qa.penanganan-produk.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Barang</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Cakupan Pemusnahan</th>
                <th>Alasan Pemusnahan</th>
                <th>Tgl</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penanganan as $d)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_produk }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ $d->cakupan }}</td>
                    <td>{{ $d->alasan }}</td>
                    <td>{{ tanggal($d->tgl) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
