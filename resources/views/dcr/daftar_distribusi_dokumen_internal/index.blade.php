<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
            {{-- <a href="{{ route('dcr.7.print') }}" target="_blank" class="btn btn-primary float-end me-2"><i
                    class="fas fa-print"></i> print</a> --}}
            {{-- <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Divisi</th>
                            <th class="text-center">Jumlah Dokumen</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar as $d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $d->divisi }}</td>
                                <td class="text-center">{{ $d->jumlah_dokumen }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dcr.4.print', ['divisi_id' => $d->divisi_id]) }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-print"></i> print</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <style>
        .modal-lg-max {
            max-width: 90% !important;
        }
    </style>
    <form action="{{ route('dcr.4.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-max">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Add Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">Divisi</label>
                                <select name="divisi_id" class="form-control divisi select2" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <hr>
                            </div>

                            <div class="col-lg-12" id="dokumen-wrapper">
                                <div class="row dokumen-row mb-2">
                                    <div class="col-lg-4">
                                        <label for="">Dokumen</label>
                                        <select name="dokumen_id[]" class="form-control dokumen select2" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($dokumen as $d)
                                                <option value="{{ $d->id }}">{{ $d->judul }}
                                                    ({{ $d->no_dokumen }})
                                                    - {{ $d->nama_divisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-end">
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-dokumen">Hapus</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button type="button" id="add-dokumen" class="btn btn-primary btn-sm mt-2">+ Tambah
                                    Dokumen</button>
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
        <script>
            $(document).ready(function() {
                // tombol tambah
                $('#add-dokumen').click(function() {
                    let newRow = `
            <div class="row dokumen-row mb-2">
                <div class="col-lg-4">
                    <select name="dokumen_id[]" class="form-control dokumen select2" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($dokumen as $d)
                            <option value="{{ $d->id }}">{{ $d->judul }} ({{ $d->no_dokumen }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-dokumen">Hapus</button>
                </div>
            </div>
        `;
                    $('#dokumen-wrapper').append(newRow);
                    $('.select2').select2({
                        dropdownParent: $('#tambah'), // Ganti dengan ID modal kamu
                        width: '100%'
                    });
                });

                // tombol hapus
                $(document).on('click', '.remove-dokumen', function() {
                    $(this).closest('.dokumen-row').remove();
                });
            });
        </script>
    @endsection
</x-app-layout>
