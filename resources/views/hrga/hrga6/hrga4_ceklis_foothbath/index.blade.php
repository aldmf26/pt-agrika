<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm">Foothbath
                    Template</a>
            </div>
        </div>
        <div class="col-lg-12">
            <section class="row">
                <table class="table table-hover table-dark" id="table1">
                    <thead>
                        <tr>
                            <th width="5">#</th>
                            <th>Bulan</th>
                            <th>Area</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            @php
                                $param = ['bulan' => $d->bulan, 'tahun' => $d->tahun, 'id_lokasi' => $d->id_lokasi];
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a
                                        href="{{ route('hrga6.4.create', $param) }}">{{ formatTglGaji($d->bulan, $d->tahun) }}</a>
                                </td>
                                <td>{{ $d->lokasi }}</td>
                                <td>
                                    <a target="_blank" class="btn btn-sm btn-primary"
                                        href="{{ route('hrga6.4.print', $param) }}"><i class="fas fa-print"></i>
                                        Cetak</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <x-modal btnSave="T" idModal="tambah" title="Tambah Data">
                @livewire('hrga6.foothbath-template')
            </x-modal>
        </div>
    </div>
</x-app-layout>
