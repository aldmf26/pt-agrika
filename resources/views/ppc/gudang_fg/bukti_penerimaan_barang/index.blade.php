<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        {{-- <div>
            <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i> Produk</button>
            <div x-data="{ showProduk: false }">
                <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                    <img src="{{ asset('img/format_bahan_jadi.jpeg') }}">

                </x-modal>
            </div>
        </div> --}}
        <div>
            {{-- <a href="{{ route('ppc.gudang-fg.3.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Bukti Penerimaan</a> --}}
        </div>
    </div>


    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Pcs</th>
                <th>Gr</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ tanggal($p['tgl_input']) }}</td>
                    <td>{{ number_format($p['pcs'], 0) }}</td>
                    <td>{{ number_format($p['gr'], 0) }}</td>
                    <td class="text-center"><a href="{{ route('ppc.gudang-fg.3.print', $p['tgl_input']) }}" target="_blank"
                            class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                            Print</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
