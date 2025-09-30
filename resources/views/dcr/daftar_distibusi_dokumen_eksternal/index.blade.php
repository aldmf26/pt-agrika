<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

            <a href="{{ route('dcr.5.print') }}" target="_blank" class="btn btn-primary float-end me-2"><i
                    class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Judul Dokumen</th>
                            <th class="text-center">No Dokumen</th>
                            <th class="text-center">Peninjauan terakhir (setahun sekali)</th>
                            <th class="text-center">Status Berlaku (Berlaku/ Tidak Berlaku)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->judul_dokumen }}</td>
                                <td>{{ $d->no_dokumen }}</td>
                                <td>{{ $d->peninjauan_terakhir }}</td>
                                <td>{{ $d->status }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <form action="{{ route('dcr.2.store') }}" method="post" enctype="multipart/form-data">
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
