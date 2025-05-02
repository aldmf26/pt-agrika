<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <h5 class="float-start">Tanggal : {{ tanggal($tgl) }}</h5>
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> view</button>
            <a href="{{ route('produksi.9.print', ['tgl' => $tgl]) }}" class="btn btn-primary float-end me-2"
                target="_blank"><i class="fas fa-print"></i>
                print</a>

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Penampaan <br> <span class="fst-italic fw-lighter">Tray</th>
                        <th rowspan="2">Kode Batch/Lot <br> <span class="fst-italic fw-lighter">Batch/Lot code</th>
                        <th rowspan="2">Jenis <br> <span class="fst-italic fw-lighter">Type</th>
                        <th colspan="2">Jumlah <br> <span class="fst-italic fw-lighter">Quantity</th>
                        <th rowspan="2">Tventing (°C) </th>
                        <th rowspan="2">Tventing (mnt) </th>
                        <th rowspan="2">Ttot (°C) </th>
                        <th rowspan="2">Ttot (mnt) </th>
                        <th rowspan="2">Petugas pengecekan (paraf) </th>
                        <th rowspan="2">Keterangan </th>
                    </tr>
                    <tr>
                        <th>Pcs</th>
                        <th>Gr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemanasan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->tray }}</td>
                            <td>{{ $p->kode_batch }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>{{ $p->pcs }}</td>
                            <td>{{ $p->gr }}</td>
                            <td>{{ $p->tventing_c }}</td>
                            <td>{{ $p->tventing_mnt }}</td>
                            <td>{{ $p->ttot_c }}</td>
                            <td>{{ $p->ttot_mnt }}</td>
                            <td></td>
                            <td>{{ $p->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    <!-- Modal -->

    <form action="{{ route('produksi.9.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-lg-3">
                    <label for="">Suhu ruang walet awal</label>
                    <input type="text" class="form-control" name="suhu_sarang_walet_awal">
                </div>
                <div class="col-lg-3">
                    <label for="">Suhu ruang </label>
                    <input type="text" class="form-control" name="suhu_ruang">
                </div>
                <div class="col-lg-3">
                    <label for="">Penambahan air </label>
                    <input type="text" class="form-control" name="penambahan_air">
                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Mesin pemanas </label>
                    <input type="text" class="form-control" name="mesin_pemanasan">
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label for="">Tray</label>
                            <input type="text" class="form-control" name="tray[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Kode batch/lot</label>
                            <input type="text" class="form-control" name="kode_batch[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Jenis</label>
                            <input type="text" class="form-control" name="jenis[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Pcs</label>
                            <input type="text" class="form-control" name="pcs[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Gr</label>
                            <input type="text" class="form-control" name="gr[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Tventing (°C)</label>
                            <input type="text" class="form-control" name="tventing_c[]">
                        </div>
                        <div class="col-lg-2 mt-2">
                            <label for="">Tventing (mnt)</label>
                            <input type="text" class="form-control" name="tventing_mnt[]">
                        </div>
                        <div div class="col-lg-2 mt-2">
                            <label for="">Ttot (°C)</label>
                            <input type="text" class="form-control" name="ttot_c[]">
                        </div>
                        <div div class="col-lg-2 mt-2">
                            <label for="">Ttot (mnt)</label>
                            <input type="text" class="form-control" name="ttot_mnt[]">
                        </div>
                        <div div class="col-lg-2 mt-2">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan[]">
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
                        @click="rows.push({ id: Date.now() }); $nextTick(() => initSelect2())">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                </div>

            </div>
        </x-modal_plus>
    </form>

    <form action="" method="get">
        <x-modal_plus size="modal-sm" id="view">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl">
                </div>

            </div>

        </x-modal_plus>
    </form>
</x-app-layout>
