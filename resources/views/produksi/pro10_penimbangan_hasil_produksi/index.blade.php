<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <h5 class="float-start">Tanggal : {{ tanggal($tgl) }}</h5>
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> View</button>
            <a href="{{ route('produksi.10.print', ['tgl' => $tgl]) }}" class="btn btn-primary float-end me-2"
                target="_blank"><i class="fas fa-print"></i>
                Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Jenis Produk <br> <span
                                class="fst-italic fw-lighter">Grade</span></th>
                        <th rowspan="2" class="text-center">Kode Batch/Lot
                            <br> <span class="fst-italic fw-lighter">Batch/Lot code</span>
                        </th>
                        <th colspan="3" class="text-center">Jumlah
                            <br> <span class="fst-italic fw-lighter">Quantity</span>
                        </th>
                        <th rowspan="2" class="text-center">Keterangan
                            <br> <span class="fst-italic fw-lighter">Remarks</span>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">Pcs</th>
                        <th class="text-center">Gr</th>
                        <th class="text-center">Box</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penimbangan as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $p->jenis_produk }}</td>
                            <td class="text-center">{{ $p->kode_batch }}</td>
                            <td class="text-center">{{ $p->pcs }}</td>
                            <td class="text-center">{{ $p->gr }}</td>
                            <td class="text-center">{{ $p->box }}</td>
                            <td class="text-center">{{ $p->keterangan }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ route('produksi.10.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>

                <div class="col-lg-12">
                    <hr>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label for="">Jenis Produk</label>
                            <input type="text" class="form-control" name="jenis_produk[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Kode Batch/Lot</label>
                            <input type="text" class="form-control" name="kode_batch[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Pcs</label>
                            <input type="text" class="form-control" name="pcs[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Gr</label>
                            <input type="text" class="form-control" name="gr[]">
                        </div>
                        <div class="col-lg-1">
                            <label for="">Box</label>
                            <input type="text" class="form-control" name="box[]">
                        </div>
                        <div div class="col-lg-2 ">
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
