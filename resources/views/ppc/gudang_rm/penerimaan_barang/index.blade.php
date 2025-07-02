<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Barang </button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    @livewire('ppc.tbh-barang', ['kategori' => 'barang'])
                </x-modal>
            </div>

        </div>
        <div>
            <a href="{{ route('ppc.gudang-rm.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Penerimaan Barang</a>
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>No Po</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Tanggal Penerimaan</th>
                <th>Supplier</th>
                <th>No Kendaraan</th>
                <th>Pengemudi</th>
                <th>Jumlah Barang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->no_po }}</td>
                    <td>{{ $d->barang->nama_barang }}</td>
                    <td>{{ $d->barang->kode_barang }}</td>
                    <td>{{ tanggal($d->tanggal_terima) }}</td>
                    <td>{{ $d->supplier->nama_supplier }}</td>
                    <td>{{ $d->no_kendaraan }}</td>
                    <td>{{ $d->pengemudi }}</td>
                    <td>{{ $d->jumlah_barang }}</td>
                    <td>{{ $d->status_penerimaan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary"
                            href="{{ route('ppc.gudang-rm.1.print', $d->id) }}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
    </table>

</x-app-layout>
