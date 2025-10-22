<x-app-layout :title="$title">
    <x-nav-link route="pur.seleksi.1.index" />
    <br>

    <div class="d-flex justify-content-end gap-2">
        <div>
            <a href="{{ route('pur.seleksi.1.print', ['kategori' => $kategori]) }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-print"></i>
                Print</a>

            <a href="{{ route('pur.seleksi.1.create', ['kategori' => $kategori]) }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i>
                Daftar Supplier</a>

            @if ($kategori != 'lainnya')
                <button data-bs-toggle="modal" data-bs-target="#tambah" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Barang </button>
                <div x-data="{ showProduk: false }">
                    <x-modal btnSave="T" idModal="tambah" title="Tambah Produk" size="modal-full">
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
                                @php
                                    $evaluasi_s1 = $d->evaluasi()->where('semester', 1)->first();
                                    $evaluasi_s2 = $d->evaluasi()->where('semester', 2)->first();
                                @endphp

                                {{-- @forelse ($d->evaluasi as $evaluasi)
                                    <a href="{{ route('pur.seleksi.1.evaluasi', $evaluasi->id) }}"
                                        class="mb-1 btn btn-xs btn-primary">Evaluasi Bulan
                                        {{ $evaluasi->periode_evaluasi }}</a>
                                @empty
                                    <a href="#addEvaluasi" data-bs-toggle="modal"
                                        @click="idSuplier = {{ $d->id }}" class="mb-1 btn btn-xs btn-info"><i
                                            class="fas fa-plus"></i> Evaluasi</a>
                                @endforelse --}}
                                <a href="{{ route('pur.seleksi.1.evaluasi', ['semester' => 1, 'id' => $d->id]) }}"
                                    class="mb-2 btn btn-xs {{ $evaluasi_s1 ? 'btn-primary' : 'btn-outline-primary' }}">Semester
                                    I</a>
                                <a href="{{ route('pur.seleksi.1.evaluasi', ['semester' => 2, 'id' => $d->id]) }}"
                                    class="btn btn-xs {{ $evaluasi_s2 ? 'btn-primary' : 'btn-outline-primary' }}">Semester
                                    II</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.create_seleksi', $d) }}"
                                    class="mb-1 btn btn-xs btn-info"><i class="fas fa-plus"></i> Seleksi</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.edit', [$d->id, $kategori]) }}" class="btn btn-xs btn-primary"><i
                                        class="fas fa-edit"></i></a>

                                <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    href="{{ route('pur.seleksi.1.destroy', $d->id) }}"
                                    class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($rumah_walet as $r)
                        @php
                            $evaluasi_s1 = $r->evaluasi()->where('semester', 1)->first();
                            $evaluasi_s2 = $r->evaluasi()->where('semester', 2)->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords($r->nama) }}</td>
                            <td>{{ $r->alamat }}</td>
                            <td>{{ $r->contact_person }}</td>
                            <td>{{ $r->no_telp }}</td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.evaluasi_sbw', ['semester' => 1, 'id' => $r->id]) }}"
                                    class="mb-2 btn btn-xs {{ $evaluasi_s1 ? 'btn-primary' : 'btn-outline-primary' }}">Semester
                                    I</a>
                                <a href="{{ route('pur.seleksi.1.evaluasi_sbw', ['semester' => 2, 'id' => $r->id]) }}"
                                    class="btn btn-xs {{ $evaluasi_s2 ? 'btn-primary' : 'btn-outline-primary' }}">Semester
                                    II</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.create_seleksi_sbw', $r) }}"
                                    class="mb-1 btn btn-xs btn-info"><i class="fas fa-plus"></i> Seleksi</a>
                            </td>
                            <td>
                                <a href="{{ route('pur.seleksi.1.edit', [$r->id, $kategori]) }}"
                                    class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
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
