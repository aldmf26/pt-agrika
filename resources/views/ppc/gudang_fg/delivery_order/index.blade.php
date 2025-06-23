<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        {{-- <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Produk</button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    <img src="{{ asset('img/format_bahan_jadi.jpeg') }}">

                    @livewire('ppc.tbh-produk')
                </x-modal>
            </div>
        </div> --}}
        <div>
            <a href="{{ route('ppc.gudang-fg.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Delivery</a>
        </div>
    </div>


    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>No Order</th>
                <th>Tanggal Order</th>
                <th>Pelanggan</th>
                <th>Ttl Produk</th>
                <th>Disetujui Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratJalans as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nomor_order }}</td>
                    <td>{{ tanggal($d->tanggal_order) }}</td>
                    <td>{{ $d->pelanggan->nama_pelanggan }}</td>
                    <td>
                        {{ $d->detailSuratJalan->count('jumlah') }} Item
                    </td>
                    <td>{{ $d->disetujui_oleh }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary"
                            href="{{ route('ppc.gudang-fg.1.print', $d->nomor_order) }}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
