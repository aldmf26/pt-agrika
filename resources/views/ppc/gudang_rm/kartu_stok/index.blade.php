<x-app-layout :title="$title">
    <x-nav-link route="ppc.gudang-rm.8.index" />
    <br>
    <br>
    <div x-data="{ checked: [] }">
        <div class="d-flex justify-content-end gap-2">
            <div>
                {{-- <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Barang </button>
                <div x-data="{ showProduk: false }">
                    <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                        @livewire('ppc.tbh-barang')
                    </x-modal>
                </div> --}}
            </div>

        </div>

        <table id="example" class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->kategori }}</td>
                        <td>{{ $d->nama_barang }}</td>
                        <td>{{ $d->satuan }}</td>
                        <td>{{ number_format($d->stok_akhir ?? 0, 0) }}</td>
                        <td>
                            @php
                                $param = [
                                    'id' => $d->id,
                                    'kategori' => $d->kategori,
                                ];
                            @endphp
                            <a class="btn btn-xs float-end btn-primary"
                                href="{{ route('ppc.gudang-rm.8.print', $param) }}"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
