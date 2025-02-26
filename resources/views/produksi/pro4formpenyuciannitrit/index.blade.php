<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <h5 class="float-start">Tanggal : {{ tanggal($tgl) }}</h5>


            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Tambah</button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> View</button>
            <a href="{{ route('produksi.4.print', ['tgl' => $tgl]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">No</th>
                        <th class="text-center" rowspan="2">Nama Operator Cabut <br> <span
                                class="fst-italic fw-lighter">Operator
                                name</span></th>
                        <th class="text-center" rowspan="2">Kode Batch/Lot <br> <span
                                class="fst-italic fw-lighter">Batch/Lot
                                code</span></th>
                        <th class="text-center" colspan="2">Jumlah <br> <span
                                class="fst-italic fw-lighter">Quantity</span></th>
                        <th class="text-center" colspan="2">Jam Cuci <br> <span class="fst-italic fw-lighter">Washing
                                time</span></th>
                        <th class="text-center" rowspan="2">Total Waktu <br> <span
                                class="fst-italic fw-lighter">Time</span></th>
                        <th class="text-center" rowspan="2">Waktu Cuci Per Pcs <br> <span
                                class="fst-italic fw-lighter">(50 detik/s)</span></th>
                        <th class="text-center" rowspan="2">Nama Operator Pencucian <br> CCP 1<br>
                            <span class="fst-italic fw-lighter">Cleaner name CCP 1</span>
                        </th>
                        <th class="text-center" rowspan="2">Keterangan<br> <span
                                class="fst-italic fw-lighter">Remaks</span></th>
                    </tr>
                    <tr>
                        <th class="text-center">Pcs</th>
                        <th class="text-center">Gr</th>
                        <th class="text-center">Awal/Mulai</th>
                        <th class="text-center">Akhir/Stop</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pencucian as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->pegawai->nama }}</td>
                            <td>{{ $p->no_box }}</td>
                            <td>{{ $p->pcs }}</td>
                            <td>{{ $p->gr }}</td>
                            <td>{{ $p->start }}</td>
                            <td>{{ $p->end }}</td>
                            <td></td>
                            <td>{{ $p->waktu_penyucian }}</td>
                            <td>{{ $p->nama_operator }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <form action="{{ route('produksi.4.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-lg-3">
                    <label for="">Nama Pengawas</label>
                    <input type="text" class="form-control" name="nama_operator">
                </div>
                <div class="col-lg-2">
                    <label for="">Start</label>
                    <input type="time" class="form-control" name="start">
                </div>
                <div class="col-lg-2">
                    <label for="">End</label>
                    <input type="time" class="form-control" name="end">
                </div>
                <div class="col-lg-2">
                    <label for="">Waktu Cuci Per Pcs</label>
                    <input type="text" class="form-control" name="waktu_penyucian" value="50">
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-3">
                        <label>Nama Operator Cabut</label>
                    </div>
                    <div class="col-lg-3">
                        <label>No Box</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Pcs</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Gr</label>
                    </div>
                </div>
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <select class="select2 form-control" name="pegawai_id[]" x-ref="select"
                                x-init="$nextTick(() => initSelect2())">
                                <option value="">-Pilih Pegawai-</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->karyawan_id_dari_api }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="no_box[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="pcs[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="gr[]">
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
