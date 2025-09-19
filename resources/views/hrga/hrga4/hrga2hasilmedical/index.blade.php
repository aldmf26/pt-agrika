<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> import</button>
            <a href="{{ route('hrga4.2.print') }}" target="_blank" class="btn btn-primary float-end me-2"><i
                    class="fas fa-print"></i> print</a>
            {{-- <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tempat, Tanggal Lahir</th>
                            <th class="text-center">Tanggal Pemeriksaan</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Bagian/Posisi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekap as $r)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->nama }}</td>
                                <td>{{ $r->tempat_tgl_lahir }}</td>
                                <td>{{ tanggal($r->tgl_pemeriksaan) }}</td>
                                <td>{{ $r->jenis_kelamin }}</td>
                                <td>{{ $r->bagian }}</td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <form action="{{ route('hrga4.2.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Import Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="file">File Excel</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    @section('scripts')
    @endsection
</x-app-layout>
