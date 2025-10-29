<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            {{-- <nav>
                <ul class="nav nav-pills float-start">
                    <li class="nav-item">
                        <a class="nav-link {{ $k == 'satu' ? 'active' : '' }}"
                            href="{{ route('ppc.gudang-rm.8.index', ['k' => 'satu']) }}">Barang & Kemasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $k == 'lainnya' ? 'active' : '' }}"
                            href="{{ route('ppc.gudang-rm.8.index', ['k' => 'lainnya']) }}">Sbw</a>
                    </li>
                </ul>
            </nav> --}}
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

                <table id="example" class="table table-bordered ">
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
                        @if ($k != 'lainnya')
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
                                        <a target="_blank" class="ms-1 btn btn-xs float-end btn-info"
                                            href="{{ route('ppc.gudang-rm.8.lacak', $param) }}">Lacak</a>

                                        <a class="btn btn-xs float-end btn-primary"
                                            href="{{ route('ppc.gudang-rm.8.print', $param) }}"><i
                                                class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($sbw as $d)
                                @php
                                    $sbw = DB::table('grade_sbw_kotor')->where('id', $d['grade_id'])->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Sbw</td>
                                    <td>{{ $sbw->nama ?? '-' }}</td>
                                    <td>Gr</td>
                                    <td>{{ number_format($d['gr'], 0) }}</td>
                                    <td>
                                        @php
                                            $param = [
                                                'nm_barang' => $sbw->nama ?? '',
                                                'kategori' => 'sbw',
                                                'id' => $d['grade_id'],
                                            ];
                                        @endphp
                                        <a class="btn btn-xs float-end btn-primary"
                                            href="{{ route('ppc.gudang-rm.8.print', $param) }}"><i
                                                class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
