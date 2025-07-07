<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <h5 class="float-start"></h5>


            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Pcs</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pencucian as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
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
            <div class="row" x-data='@json(['rows' => $anak])'>
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-lg-3">
                    <label for="">Nama pengawas</label>
                    <input type="text" class="form-control" name="nama_operator" value="{{ auth()->user()->name }}"
                        readonly>
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
                    <label for="">Waktu cuci per pcs</label>
                    <input type="text" class="form-control" name="waktu_penyucian" value="30">
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-3">
                        <label>Nama operator cabut</label>
                    </div>
                    <div class="col-lg-3">
                        <label>No box</label>
                    </div>
                    <div class="col-lg-2">
                        <label>Pcs</label>
                    </div>
                    {{-- <div class="col-lg-2">
                        <label>Gr</label>
                    </div> --}}
                </div>
                <template x-for="(row, index) in rows" :key="row.id_anak">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="pegawai_id[]" x-model="row.id_anak"
                                readonly>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="nama[]" x-model="row.nama" readonly>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" name="no_box[]">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" name="pcs[]">
                        </div>
                        <div class="col-lg-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" @click="rows.splice(index, 1)"
                                x-show="rows.length > 1">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </template>


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
