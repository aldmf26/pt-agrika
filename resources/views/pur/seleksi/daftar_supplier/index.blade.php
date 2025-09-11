<x-app-layout :title="$title">
    <x-nav-link route="pur.seleksi.1.index" />
    <br>

    <div class="d-flex justify-content-end gap-2">
        <div>
            <a href="{{ route('pur.seleksi.1.print', ['kategori' => $kategori]) }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-print"></i>
                Print</a>

            <a href="{{ route('pur.seleksi.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Daftar Supplier</a>

            @if ($kategori != 'lainnya')
                <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Barang </button>
                <div x-data="{ showProduk: false }">
                    <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-lg">
                        @livewire('ppc.tbh-barang', ['kategori' => $kategori])
                    </x-modal>
                </div>
            @endif
        </div>
    </div>
    <div x-data="{
        idSuplier: null,
    }">
        <table id="example" class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>Contact Person</th>
                    <th>No Telp</th>
                    <th width="100">Hasil Evaluasi</th>
                    <th width="100">Seleksi Supplier</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($kategori != 'lainnya')
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama_supplier }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->contact_person }}</td>
                            <td>{{ $d->no_telp }}</td>
                            <td>
                                @forelse ($d->evaluasi as $evaluasi)
                                    <a href="{{ route('pur.seleksi.1.evaluasi', $evaluasi->id) }}"
                                        class="mb-1 btn btn-xs btn-primary">Evaluasi Bulan
                                        {{ $evaluasi->periode_evaluasi }}</a>
                                @empty
                                    <a href="#addEvaluasi" data-bs-toggle="modal"
                                        @click="idSuplier = {{ $d->id }}" class="mb-1 btn btn-xs btn-info"><i
                                            class="fas fa-plus"></i> Evaluasi</a>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.seleksi', $d) }}" target="_blank"
                                    class="mb-1 btn btn-xs btn-info"><i class="fas fa-print"></i> Print</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.edit', $d->id) }}" class="btn btn-xs btn-primary"><i
                                        class="fas fa-edit"></i></a>

                                <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    href="{{ route('pur.seleksi.1.destroy', $d->id) }}"
                                    class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($rumah_walet as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords($r->nama) }}</td>
                            <td>{{ $r->alamat }}</td>
                            <td></td>
                            <td></td>
                            <td>
                                {{-- @forelse ($r->evaluasi as $evaluasi)
                                    <a href="{{ route('pur.seleksi.1.evaluasi', $evaluasi->id) }}"
                                        class="mb-1 btn btn-xs btn-primary">Evaluasi Bulan
                                        {{ $evaluasi->periode_evaluasi }}</a>
                                @empty
                                    <a href="#addEvaluasi" data-bs-toggle="modal"
                                        @click="idSuplier = {{ $r->id }}" class="mb-1 btn btn-xs btn-info"><i
                                            class="fas fa-plus"></i> Evaluasi</a>
                                @endforelse --}}
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.seleksi_sbw', $r) }}" target="_blank"
                                    class="mb-1 btn btn-xs btn-info"><i class="fas fa-print"></i> Print</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.edit', $r->id) }}" class="btn btn-xs btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    href="{{ route('pur.seleksi.1.destroy', $r->id) }}"
                                    class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <form action="{{ route('pur.evaluasi.1.store') }}" method="post">
            @csrf
            <x-modal title="Evaluasi" idModal="addEvaluasi">
                <input type="hidden" name="id_suplier" :value="idSuplier">
                <label for="periode">Periode (bulan)</label>
                <input required type="text" placeholder="Contoh: 1, 2, 3" id="periode" name="periode"
                    class="form-control">
            </x-modal>
        </form>
    </div>


</x-app-layout>
