<x-app-layout :title="$title">
    <div x-data="{ checked: [] }">
        <div class="d-flex justify-content-end gap-2">
            <div>
                <a href="{{ route('ppc.gudang-rm.9.print') }}" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-print"></i> Print </a>
           
            </div>

        </div>

        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Kode Barang</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_barang }}</td>
                        <td>{{ $d->kategori }}</td>
                        <td>{{ $d->kode_barang . ' - ' . $d->kode_bahan_baku->nama }}</td>
                        <td>{{ $d->satuan }}</td>
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
