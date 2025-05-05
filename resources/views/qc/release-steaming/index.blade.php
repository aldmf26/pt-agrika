<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-end ms-2"
                href="{{ route('qc.release_steaming.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}"><i
                    class="fas fa-print"></i> print</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end"><i
                    class="fas fa-plus"></i> add</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jam sampling <br>(Jam keluar)</th>
                        <th>Nomor urut <br>mesin steam</th>
                        <th>Nama produk</th>
                        <th>Kode steaming : no urut - <br> tanggal bulan tahun <br> steaming </th>
                        <th>Hasil <br> pemeriksaan <br> (suhu oC)</th>
                        <th>Status produk <br> (release/ hold/ <br> reject)</th>
                        <th>Petugas pemeriksa & <br> paraf</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('H:i', strtotime($d->jam_sampling)) }} </td>
                            <td>{{ $d->nomor_urut_mesin_steam }}</td>
                            <td>{{ $d->nama_produk }}</td>
                            <td>{{ $d->no_urut }} - {{ date('dmY', strtotime($d->tgl)) }}</td>
                            <td>{{ $d->hasil_pemeriksaan }} °C</td>
                            <td>{{ $d->status }}</td>
                            <td></td>
                            <td>{{ $d->Keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('qc.release_steaming.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label>Jam sampling</label>
                            <input type="time" class="form-control" name="jam_sampling[]">
                        </div>
                        <div class="col-lg-2">
                            <label>No urut mesin steam</label>
                            <input type="text" class="form-control" name="nomor_urut_mesin_steam[]">
                        </div>
                        <div class="col-lg-2">
                            <label>Nama produk</label>
                            <input type="text" class="form-control" name="nama_produk[]">
                        </div>
                        <div class="col-lg-2">
                            <label>Tgl</label>
                            <input type="date" class="form-control" name="tgl[]">
                        </div>
                        <div class="col-lg-2">
                            <label>Hasil pemeriksaan</label>
                            <input type="text" class="form-control" name="hasil_pemeriksaan[]">
                        </div>
                        <div class="col-lg-2">
                            <label>Status</label>
                            <select name="status[]" id="" class="form-control">
                                <option value="">Pilih</option>
                                <option value="release">Release</option>
                                <option value="hold">Hold</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan[]">
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
                        <i class="fas fa-plus"></i> Tambah baris
                    </button>
                </div>

            </div>

        </x-modal_plus>
    </form>
</x-app-layout>
