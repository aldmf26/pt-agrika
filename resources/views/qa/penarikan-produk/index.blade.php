<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn  btn-primary float-end"><i
                    class="fas fa-plus"></i>
                add</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th colspan="4">Informasi produk</th>
                        <th colspan="4">Informasi pelanggan</th>
                    </tr>
                    <tr>
                        <th>Nama produk</th>
                        <th>kode produk</th>
                        <th>Tanggal produk <br> Kode batch</th>
                        <th>Jumlah recall <br> pack / kg / gram</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jumlah didistribusikan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($penanganan as $d)
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal($d->tgl_kejadian) }}</td>
                    <td>{{ $d->sumber_penyebab }}</td>
                    <td>{{ $d->nama_produk }}</td>
                    <td>{{ $d->kode_produksi }}</td>
                    <td>{{ $d->jumlah_produk }}</td>
                    <td>{{ $d->status }}</td>
                    <td>{{ $d->penanganan }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary"
                            href="{{ route('qa.penanganan-produk.1.print', $d->id) }}"><i class="fas fa-print"></i></a>
                    </td>
                    </tr>
                @endforeach --}}
                </tbody>
            </table>
        </div>

    </div>

    <x-modal_plus size="modal-xl" id="tambah">
        <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
            <div class="col-lg-2">
                <label for="">Tanggal</label>
                <input type="date" class="form-control" name="tanggal">
            </div>
            <div class="col-lg-12">
                <hr class="my-4">
            </div>
            <template x-for="(row, index) in rows" :key="row.id">
                <div class="row mb-4">
                    <div class="col-lg-2">
                        <label for="">Nama produk</label>
                        <input type="text" class="form-control" name="nama_produk[]">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Kode produk</label>
                        <input type="text" class="form-control" name="kode_produk[]">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Tanggal produk</label>
                        <input type="text" class="form-control" name="tanggal_produk[]">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Kode batch</label>
                        <input type="text" class="form-control" name="kode_batch[]">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Jumlah recall</label>
                        <input type="text" class="form-control" name="jumlah_recall[]">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Nama pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan[]">
                    </div>
                    <div class="col-lg-4 mt-2">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat[]">
                    </div>
                    <div class="col-lg-3 mt-2">
                        <label for="">Jumlah didistribusikan</label>
                        <input type="text" class="form-control" name="jumlah[]">
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
</x-app-layout>
