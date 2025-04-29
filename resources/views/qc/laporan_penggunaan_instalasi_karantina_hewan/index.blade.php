<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                        class="btn btn-sm btn-primary float-end ms-2"><i class="fas fa-plus"></i>
                        Data</a> --}}
                    <button type="button" data-bs-toggle="modal" data-bs-target="#import"
                        class="btn btn-sm btn-primary float-end ms-2"><i class="fas fa-file-upload"></i>
                        Import</button>
                    {{-- <a target="_blank" href="{{ route('qc.laporan_pelaksanaan_ekspor.print') }}"
                        class="btn btn-sm btn-primary float-end"><i class="fas fa-print"></i>Print</a> --}}

                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start align-middle">#</th>
                                <th class="text-start align-middle">Nota</th>
                                <th class="text-start align-middle">Tanggal</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $l->nota }}</td>
                                    <td>{{ date('d-m-Y', strtotime($l->created_at)) }}</td>
                                    <td class="text-center"><a target="_blank"
                                            href="{{ route('qc.laporan_penggunaan_instalasi_karantina_hewan.print', ['nota' => $l->nota]) }}"
                                            class="btn btn-xs  btn-primary"><i class="fas fa-print"></i></a>
                                    </td>
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

                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <label>Tanggal Pemeriksaan</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Jenis Media Pembawa</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Jumlah (ekor/kg)</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Negara / Area Asal</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Negara / Area Tujuan</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Tanggal Pengeluaran</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Petugas Karantina Hewan</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Ket/kejadian khusus selama masa pengamatan (*)</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Keterangan</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" @click="rows.splice(index, 1)"
                                x-show="rows.length > 1">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="col-lg-12">
                            <hr>
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

    <form action="{{ route('qc.laporan_penggunaan_instalasi_karantina_hewan.import') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <x-modal_plus size="modal-lg" id="import">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
            </div>
        </x-modal_plus>
    </form>




</x-app-layout>
