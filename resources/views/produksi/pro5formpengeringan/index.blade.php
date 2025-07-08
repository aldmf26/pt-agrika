<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Nama operator pengeringan</th>
                        <th colspan="2">Berat awal <br> <span class="fst-italic fw-lighter">Qty before dry</th>
                        <th colspan="2">Berat kering <br> <span class="fst-italic fw-lighter">Qty After drying</th>
                        <th rowspan="2">Hcr <br> <span><span class="fst-italic fw-lighter">(gr)</th>
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabut as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($p['tgl']) }}</td>
                            <td>{{ ucwords(strtolower($p['name'])) }}</td>
                            <td>{{ number_format($p['pcs_awal'], 0) }}</td>
                            <td>{{ number_format($p['gr_awal'], 0) }}</td>
                            <td>{{ number_format($p['pcs_akhir'], 0) }} </td>
                            <td>{{ number_format($p['gr_akhir'], 0) }}</td>
                            <td>{{ number_format($p['gr_awal'] - $p['gr_akhir'], 0) }}</td>
                            <td>
                                @php
                                    $tgl = $p['tgl'];
                                    $id_pengawas = $p['id_pengawas'];
                                    $pengawas = $p['name'];

                                @endphp
                                <a target="_blank"
                                    href="{{ route('produksi.5.print', ['tgl' => $tgl, 'id_pengawas' => $id_pengawas, 'pengawas' => $pengawas]) }}"
                                    class="btn btn-warning btn-sm"> <i class="fas fa-print"></i> </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- <form action="{{ route('produksi.5.store') }}" method="post">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row" x-data="{ rows: [{ id: Date.now() }] }" x-init="$nextTick(() => initSelect2())">
                <div class="col-lg-3 mb-4">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal">
                </div>
                <div class="col-lg-3 mb-4">
                    <label for="">Pengawas</label>
                    <input type="text" class="form-control" name="pengawas">
                </div>
                <template x-for="(row, index) in rows" :key="row.id">
                    <div class="row mb-4">
                        <div class="col-lg-2">
                            <label for="">Data karyawan</label>
                            <select class="select2 form-control" name="pegawai_id[]" x-ref="select"
                                x-init="$nextTick(() => initSelect2())">
                                <option value="">-Pilih Pegawai-</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->karyawan_id_dari_api }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label for="">No Box</label>
                            <input type="text" class="form-control" name="no_box[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Jenis</label>
                            <input type="text" class="form-control" name="grade[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Pcs</label>
                            <input type="text" class="form-control" name="pcs[]">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Gr</label>
                            <input type="text" class="form-control" name="gr[]">
                        </div>
                        <div class="col-lg-2 ">
                            <label for="">Pcs Akhir</label>
                            <input type="text" class="form-control" name="pcs_akhir[]">
                        </div>
                        <div class="col-lg-2 mt-2">
                            <label for="">Gr Akhir</label>
                            <input type="text" class="form-control" name="gr_akhir[]">
                        </div>
                        <div class="col-lg-2 mt-2">
                            <label for="">Hcr</label>
                            <input type="text" class="form-control" name="hcr[]">
                        </div>
                        <div class="col-lg-4 mt-2">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="ket[]">
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
    </form> --}}
</x-app-layout>
