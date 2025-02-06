<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fas fa-plus"></i> Data
            </button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#print">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Materi Pelatihan</th>
                        <th>I/E <br> *</th>
                        <th>Narasumber</th>
                        <th>Sasaran Peserta</th>
                        <th>Tanggal Rencana</th>
                        <th>Tanggal Realisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($program as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->materi_pelatihan }}</td>
                            <td>{{ $p->sumber == 'internal' ? 'I' : 'E' }}</td>
                            <td>{{ $p->narasumber }}</td>
                            <td>{{ $p->sasaran_peserta }}</td>
                            <td>{{ $p->tgl_rencana }}</td>
                            <td>{{ $p->tgl_realisasi }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
    <form action="{{ route('hrga3.2.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="">Materi Pelatihan</label>
                                <input type="text" name="materi_pelatihan" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">I/E</label>
                                <select name="sumber" class="form-control" id="">
                                    <option value="internal">Internal</option>
                                    <option value="eksternal">Eksternal</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Narasumber</label>
                                <input type="text" name="narasumber" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sasaran Peserta</label>
                                <input type="text" name="sasaran_peserta" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Tanggal Rencana</label>
                                <input type="date" name="tgl_rencana" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Tanggal Realisasi</label>
                                <input type="date" name="tgl_realisasi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('hrga3.2.print') }}" method="get" target="_blank">
        <div class="modal fade" id="print" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control">
                                    @foreach ($tahuns as $t)
                                        <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
