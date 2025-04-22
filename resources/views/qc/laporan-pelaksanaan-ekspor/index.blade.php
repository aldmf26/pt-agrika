<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end gap-2">
                        <div>

                        </div>
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                                Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" rowspan="2">#</th>
                                <th class="text-center align-middle" rowspan="2">Nama dan Tanggal PEB</th>
                                <th class="text-center align-middle" rowspan="2">Uraian Barang</th>
                                <th class="text-center align-middle" rowspan="2">Nomor Pos Tarif/Hs</th>
                                <th class="text-center align-middle" colspan="2">Jumlah</th>
                            </tr>
                            <tr>
                                <th class="text-center">Volume</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $l->nama }} & {{ $l->tanggal }}</td>
                                    <td>{{ $l->uraian_barang }}</td>
                                    <td>{{ $l->nomo_pos }}</td>
                                    <td>{{ $l->jumlah }}</td>
                                    <td>{{ $l->volume }}</td>
                                    <td>Rp {{ number_format($l->nilai, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- <form action="{{ route('qa.agendadan_jadwal_tinjauan_manajemen.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{
                rows: {{ json_encode($agenda) }}
            }">
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-2">
                        <label>Waktu (Dari)</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Waktu (Sampai)</label>
                    </div>
                    <div class="col-lg-3">
                        <label>Agenda</label>
                    </div>
                    <div class="col-lg-3">
                        <label>PIC</label>
                    </div>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">

                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <input type="hidden" :value="row.id_agenda" name="id[]">
                            <input type="time" class="form-control" :value="row.dari_jam" name="start[]" required>
                        </div>
                        <div class="col-lg-2">
                            <input type="time" class="form-control" :value="row.sampai_jam" name="finish[]" required>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" :value="row.agenda" name="agenda[]" required>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" :value="row.pic" name="pic[]" required>
                        </div>
                        <div class="col-lg-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" @click="rows.splice(index, 1)"
                                x-show="rows.length > 1">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary mt-2 btn-block"
                        @click="rows.push({ id: Date.now() }); $nextTick()">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                </div>

            </div>

        </x-modal_plus>
    </form> --}}




</x-app-layout>
