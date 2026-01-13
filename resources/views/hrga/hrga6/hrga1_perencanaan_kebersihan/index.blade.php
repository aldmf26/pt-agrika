<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-end">
                <a href="#" data-bs-target="#tambah" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i
                        class="fas fa-plus"></i>Add</a>
                <a href="{{ route('hrga6.1.print', ['id_lokasi' => $id_lokasi]) }}" target="_blank"
                    class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Print</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div>
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        Area Concern : Produksi
                        {{-- <ul class="nav nav-pills" style="font-size: 12px">
                            @foreach ($lokasi as $l)
                                <li class="nav-item ">
                                    <a class="nav-link @if ($area == $l->lokasi) active @endif"aria-current="page"
                                        href="{{ route('hrga6.1.index', ['area' => $l->lokasi]) }}">{{ ucwords($l->lokasi) }}</a>
                                </li>
                            @endforeach

                        </ul> --}}
                    </div>

                </div>

                <table id="example" class="table table-bordered ">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Nama Alat/Area</th>
                            <th>Identifikasi Alat/Area</th>
                            <th>Metode Sanitasi</th>
                            <th>Penanggung Jawab</th>
                            <th>Frekuensi</th>
                            <th>Sarana Cleaning</th>
                            <th>Sanitizer & Pengenceran</th>
                            <th>Updated</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            <tr>
                                <td style="vertical-align: top !important;">{{ $loop->iteration }}</td>
                                <td style="vertical-align: top !important;">{{ ucfirst(strtolower($d->nm_alat)) }}</td>
                                <td style="vertical-align: top !important;">
                                    {{ ucfirst(strtolower($d->identifikasi_alat)) }}</td>
                                <td style="vertical-align: top !important;">{{ ucfirst(strtolower($d->metode)) }}</td>
                                <td style="vertical-align: top !important;">{{ ucwords($d->penanggung_jawab) }}</td>
                                <td style="vertical-align: top !important;">{{ ucfirst(strtolower($d->frekuensi)) }}
                                </td>
                                <td style="vertical-align: top !important;">
                                    {{ ucfirst(strtolower($d->sarana_cleaning)) }}</td>
                                <td style="vertical-align: top !important;">{{ $d->sanitizer }}
                                </td>
                                <td style="vertical-align: top !important;">{{ date('d-m-Y', strtotime($d->tgl)) }}</td>
                                <td style="vertical-align: top !important;">


                                    <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $d->id_perencanaan }}"
                                        data-nm="{{ $d->nm_alat }}" data-identifikasi="{{ $d->identifikasi_alat }}"
                                        data-metode="{{ $d->metode }}" data-pj="{{ $d->penanggung_jawab }}"
                                        data-frekuensi="{{ $d->frekuensi }}" data-sarana="{{ $d->sarana_cleaning }}"
                                        data-sanitizer="{{ $d->sanitizer }}" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('hrga6.1.destroy', $d->id_perencanaan) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <form action="{{ route('hrga6.1.store') }}" method="post">
                @csrf
                <x-modal idModal="tambah" title="Jadwal Sanitasi" size="modal-full" btnSave="Y">
                    <table class="table table-bordered" x-data="{
                        rows: ['1']
                    }">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Alat/Area</th>
                                <th>Identifikasi Alat/Area</th>
                                <th>Metode Sanitasi</th>
                                <th>Penanggung Jawab</th>
                                <th>Frekuensi</th>
                                <th>Sarana Cleaning</th>
                                <th>Sanitizer & Pengenceran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, index) in rows" :key="index">
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input type="hidden" name="id_lokasi" value="{{ $id_lokasi }}">
                                        <input type="text" class="form-control" name="nm_alat[]"
                                            placeholder="Nama Alat/Area (Contoh: Mesin Produksi 1)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="identifikasi_alat[]"
                                            placeholder="Identifikasi Alat (Contoh: Mesin Produksi 1)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="metode[]"
                                            placeholder="Metode Sanitasi (Contoh: Disinfeksi)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="penanggung_jawab[]"
                                            placeholder="Nama Penanggung Jawab (Contoh: Budi)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="frekuensi[]"
                                            placeholder="Frekuensi Sanitasi (Contoh: Harian)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="sarana_cleaning[]"
                                            placeholder="Sarana Cleaning (Contoh: Air)">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="sanitizer[]"
                                            placeholder="Sanitizer & Pengenceran (Contoh: Klorin 1%)">
                                    <td>
                                        <button x-show="index > 0" class="btn btn btn-sm btn-danger" type="button"
                                            @click="rows.splice(index, 1)">-</button>

                                    </td>
                                </tr>

                            </template>
                            <tr>
                                <td colspan="9"><button class="btn btn-sm btn-info btn-block" type="button"
                                        @click="rows.push('')">+ Tambah baris</button></td>
                            </tr>
                        </tbody>


                    </table>
                </x-modal>
            </form>

            <form action="{{ route('hrga6.1.update') }}" method="POST">
                @csrf
                <x-modal idModal="editModal" title="Edit Jadwal Sanitasi" size="modal-full" btnSave="Y">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="row">
                        <div class="col-lg-4 mb-2">
                            <label>Nama Alat/Area</label>
                            <input type="text" class="form-control" name="nm_alat" id="edit_nm_alat">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Identifikasi Alat</label>
                            <input type="text" class="form-control" name="identifikasi_alat"
                                id="edit_identifikasi">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Metode Sanitasi</label>
                            <input type="text" class="form-control" name="metode" id="edit_metode">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Penanggung Jawab</label>
                            <input type="text" class="form-control" name="penanggung_jawab" id="edit_pj">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Frekuensi</label>
                            <input type="text" class="form-control" name="frekuensi" id="edit_frekuensi">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Sarana Cleaning</label>
                            <input type="text" class="form-control" name="sarana_cleaning" id="edit_sarana">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Sanitizer & Pengenceran</label>
                            <input type="text" class="form-control" name="sanitizer" id="edit_sanitizer">
                        </div>
                    </div>

                </x-modal>
            </form>

        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-edit')) {
                    let btn = e.target.closest('.btn-edit');

                    document.getElementById('edit_id').value = btn.dataset.id;
                    document.getElementById('edit_nm_alat').value = btn.dataset.nm;
                    document.getElementById('edit_identifikasi').value = btn.dataset.identifikasi;
                    document.getElementById('edit_metode').value = btn.dataset.metode;
                    document.getElementById('edit_pj').value = btn.dataset.pj;
                    document.getElementById('edit_frekuensi').value = btn.dataset.frekuensi;
                    document.getElementById('edit_sarana').value = btn.dataset.sarana;
                    document.getElementById('edit_sanitizer').value = btn.dataset.sanitizer;
                }
            });
        </script>
    @endsection
</x-app-layout>
