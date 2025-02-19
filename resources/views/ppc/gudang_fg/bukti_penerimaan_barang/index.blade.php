<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Produk</button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    <img src="{{ asset('img/format_bahan_jadi.jpeg') }}">

                    @livewire('ppc.tbh-produk')
                </x-modal>
            </div>
        </div>
        <div>
            <a href="{{ route('ppc.gudang-fg.3.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Bukti Penerimaan</a>
        </div>
    </div>


    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Terima</th>
                <th>Ttl Serah</th>
                <th>Ttl Terima</th>
                <th>Ttl Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal($d->tanggal_terima) }}</td>
                    <td>{{ $d->serah }}</td>
                    <td>{{ $d->terima }}</td>
                    <td>{{ $d->ttl_item }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{route("ppc.gudang-fg.3.print", $d->tanggal_terima)}}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  
</x-app-layout>
