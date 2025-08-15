<x-app-layout :title="$title">
    <x-nav-link route="ppc.gudang-rm.7.index" />
    <br>
    <div x-data="{ checked: [] }">
        <div class="d-flex justify-content-end gap-2">
            {{-- <div>
                <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Barang </button>
                <div x-data="{ showProduk: false }">
                    <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                        @livewire('ppc.tbh-barang')
                    </x-modal>
                </div>
            </div> --}}
            <div>
                <a href="{{ route('ppc.gudang-rm.7.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                    Bukti Pengeluaran Barang</a>
            </div>
        </div>

        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama Pemohon</th>
                    <th>Departemen</th>

                    <th>Pcs</th>
                    <th>Gr</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($kategori != 'lainnya')
                    @foreach ($buktis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($item->tgl) }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->departemen }}</td>

                            <td>{{ $item->pcs }} pcs</td>
                            <td>{{ $item->gr }} gr</td>
                            <td>
                                @php
                                    $param = [
                                        'nama' => $item->nama,
                                        'tgl' => $item->tgl,
                                        'departemen' => $item->departemen,
                                    ];
                                @endphp
                                <a class="btn btn-xs float-end btn-primary"
                                    href="{{ route('ppc.gudang-rm.7.print', $param) }}"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($buktis2 as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($item['tanggal']) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>Cabut Bulu</td>
                            <td>{{ number_format($item['pcs'], 0) }} pcs</td>
                            <td>{{ number_format($item['gr'], 0) }} gr</td>
                            <td>
                                @php
                                    $param = [
                                        'id_penerima' => $item['id_penerima'],
                                        'tgl' => $item['tanggal'],
                                        'nama' => $item['name'],
                                        'k' => $kategori,
                                    ];
                                @endphp
                                <a class="btn btn-xs float-end btn-primary" target="_blank"
                                    href="{{ route('ppc.gudang-rm.7.print', $param) }}"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</x-app-layout>
