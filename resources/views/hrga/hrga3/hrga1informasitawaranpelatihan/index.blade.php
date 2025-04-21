<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button>

            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#print"><i
                    class="fas fa-print"></i> Print</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-align-center text-center">No</th>
                        <th rowspan="2" class="text-align-center text-center">Tanggal Informasi</th>
                        <th rowspan="2" class="text-align-center text-center">Jenis Pelatihan</th>
                        <th rowspan="2" class="text-align-center text-center">Sasaran Pelatihan</th>
                        <th rowspan="2" class="text-align-center text-center">
                            Tema Pelatihan <br> [yang ditawarkan]
                        </th>
                        <th rowspan="2" class="text-align-center text-center">Sumber Informasi</th>
                        <th rowspan="2" class="text-align-center text-center">Personil Penghubung</th>
                        <th>No.Telp</th>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informasi as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->tanggal)) }}</td>
                            <td>{{ $i->jenis }}</td>
                            <td>{{ $i->sasaran }}</td>
                            <td>{{ $i->tema }}</td>
                            <td>{{ $i->sumber_informasi }}</td>
                            <td>{{ $i->personil_penghubung }}</td>
                            <td>{{ $i->no_telp }} <br> {{ $i->email }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('hrga3.1.store') }}" method="POST">
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
                                <label for="">Tanggal Informasi</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Jenis Pelatihan</label>
                                <input type="text" name="jenis" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sasaran Pelatihan</label>
                                <input type="text" name="sasaran" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Tema Pelatihan</label>
                                <input type="text" name="tema" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sumber Informasi</label>
                                <input type="text" name="sumber_informasi" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Personil Penghubung</label>
                                <input type="text" name="personil_penghubung" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">No Telp</label>
                                <input type="text" name="no_telp" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" required>
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
    <form action="{{ route('hrga3.1.print') }}" method="Get" target="_blank">
        <div class="modal fade" id="print" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Print Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <label for="">Dari</label>
                                <input type="date" name="tgl1" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Sampai</label>
                                <input type="date" name="tgl2" class="form-control" required>
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
