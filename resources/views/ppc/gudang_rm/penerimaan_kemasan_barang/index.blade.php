<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Barang </button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    @livewire('ppc.tbh-barang')
                </x-modal>
            </div>
        </div>
        <div>
            <a href="{{ route('ppc.gudang-rm.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Penerimaan Kemasan</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Tanggal Penerimaan</th>
                <th>Supplier</th>
                <th>No Kendaraan</th>
                <th>Pengemudi</th>
                <th>Jumlah Barang</th>
                <th>Jumlah Sampel</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->barang->nama_barang }}</td>
                    <td>{{ $d->barang->kode_barang }}</td>
                    <td>{{ tanggal($d->tanggal_penerimaan) }}</td>
                    <td>{{ $d->supplier->nama_supplier }}</td>
                    <td>{{ $d->no_kendaraan }}</td>
                    <td>{{ $d->pengemudi }}</td>
                    <td>{{ $d->jumlah_barang }}</td>
                    <td>{{ $d->jumlah_sampel }}</td>
                    <td>{{ $d->keputusan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary"
                            href="{{ route('ppc.gudang-rm.2.print', $d->id) }}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
