<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2 mb-3">
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload Excel
        </button>
    </div>

    <!-- Modal Upload -->
    <form id="uploadForm" enctype="multipart/form-data">
        <x-modal idModal="uploadModal" title="Upload File Excel" size="md">
            @csrf
            <div class="mb-3">
                <label for="excelFile" class="form-label">Pilih File Excel (.xlsx atau .xls)</label>
                <input type="file" class="form-control" id="excelFile" name="excel_file" accept=".xlsx,.xls"
                    required>
                <div class="form-text">Ukuran maksimal 10MB. Hanya file Excel yang valid.</div>
            </div>

        </x-modal>
    </form>
    {{-- <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="excelFile" class="form-label">Pilih File Excel (.xlsx atau .xls)</label>
                            <input type="file" class="form-control" id="excelFile" name="excel_file"
                                accept=".xlsx,.xls" required>
                            <div class="form-text">Ukuran maksimal 10MB. Hanya file Excel yang valid.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <!-- Tabel Files -->
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama File</th>
                <th>Tanggal Upload</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_file }}</td>
                    <td>{{ tanggal(\Carbon\Carbon::parse($d->created_at)->format('Y-m-d')) }} oleh {{ $d->admin }}
                    </td>
                    <td align="right">
                        <a href="{{ route('qa.capa.1.download', $d->id) }}" class="btn btn-sm btn-success"
                            target="_blank">
                            <i class="fas fa-download"></i> Download
                        </a>
                        <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                            href="{{ route('qa.capa.1.destroy', $d->id) }}" class="btn btn-sm btn-danger delete-btn">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Handle Upload
                $('#uploadForm').on('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);
                    let submitBtn = $(this).find('button[type="submit"]');
                    submitBtn.prop('disabled', true).text('Uploading...');

                    $.ajax({
                        url: "{{ route('qa.capa.1.store') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#uploadModal').modal('hide');
                                $('#excelFile').val(''); // Reset input
                                alertToast('sukses',
                                    'Upload berhasil!'); // Asumsi pakai AlertToast 'sukses',notif
                                window.location.reload();

                            } else {
                                alertToast('error', 'Upload gagal: ' + (response.message ||
                                    'Coba lagi.'));
                            }
                        },
                        error: function(xhr) {
                            let msg = 'Terjadi kesalahan: ';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg += xhr.responseJSON.message;
                            } else {
                                msg += 'Server error.';
                            }
                            alertToast('error', msg);
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false).text('Upload');
                        }
                    });

                });


            });
        </script>
    @endsection

</x-app-layout>
