<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-end">
                <a href="#" data-bs-target="#tambah" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i
                        class="fas fa-plus"></i>Data</a>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($d->nm_alat)) }}</td>
                                <td>{{ ucfirst(strtolower($d->identifikasi_alat)) }}</td>
                                <td>{{ ucfirst(strtolower($d->metode)) }}</td>
                                <td>{{ ucfirst(strtolower($d->penanggung_jawab)) }}</td>
                                <td>{{ ucfirst(strtolower($d->frekuensi)) }}</td>
                                <td>{{ ucfirst(strtolower($d->sarana_cleaning)) }}</td>
                                <td>{{ ucfirst(strtolower($d->sanitizer)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->tgl)) }}</td>
                                <td></td>
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
        </div>
    </div>
</x-app-layout>
