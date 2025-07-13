<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengemasan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($p['tgl_input']) }}</td>
                            <td>{{ number_format($p['pcs']) }}</td>
                            <td>{{ number_format($p['gr']) }}</td>
                            <td class="text-center">
                                <a target="_blank" href="{{ route('produksi.10.print', ['tgl' => $p['tgl_input']]) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <form action="{{ route('produksi.10.store') }}" method="POST">
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
    </form> --}}

    {{-- <form action="" method="get">
        <x-modal_plus size="modal-sm" id="view">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl">
                </div>

            </div>

        </x-modal_plus>
    </form> --}}
</x-app-layout>
