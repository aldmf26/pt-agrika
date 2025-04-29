<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">


                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                        class="btn btn-sm btn-primary float-end ms-2"><i class="fas fa-plus"></i>
                        Data</a>
                    <a target="_blank" href="{{ route('qc.laporan_pelaksanaan_ekspor.print') }}"
                        class="btn btn-sm btn-primary float-end"><i class="fas fa-print"></i>Print</a>


                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start align-middle" rowspan="2">#</th>
                                <th class="text-start align-middle" rowspan="2">Nama dan Tanggal PEB</th>
                                <th class="text-start align-middle" rowspan="2">Uraian Barang</th>
                                <th class="text-start align-middle" rowspan="2">Nomor Pos Tarif/Hs</th>
                                <th class="text-center align-middle" colspan="2">Jumlah</th>
                            </tr>
                            <tr>
                                <th class="text-end">Volume</th>
                                <th class="text-end">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $l->nama }} & {{ $l->tanggal }}</td>
                                    <td>{{ $l->uraian_barang }}</td>
                                    <td>{{ $l->nomor_pos }}</td>
                                    <td class="text-end">{{ $l->volume }}</td>
                                    <td class="text-end">Rp {{ number_format($l->nilai, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('qc.laporan_pelaksanaan_ekspor.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }">

                <div class="row mb-2">
                    <div class="col-lg-2">
                        <label>Nama</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Tanggal PEB</label>
                    </div>
                    <div class="col-lg-1">
                        <label>Uraian Barang</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Nomor Pos Tarif/Hs</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Volume</label>
                    </div>
                    <div class="col-lg-1">
                        <label>Nilai</label>
                    </div>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">

                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="nama[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="date" class="form-control" name="tanggal[]">
                        </div>
                        <div class="col-lg-1">
                            <input type="text" class="form-control" name="uraian_barang[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="nomor_pos[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="volume[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="nilai[]">
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
    </form>




</x-app-layout>
