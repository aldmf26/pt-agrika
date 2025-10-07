<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2 mb-3">
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload Excel
        </button>
    </div>

    <!-- Modal Upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
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
    </div>

    <!-- Tabel Files -->
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama File</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTable
                let table = $('#example').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '{{ route('qa.capa.1.index') }}',
                        type: 'GET',
                        dataSrc: '' // Asumsi response JSON array langsung
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama_file'
                        },
                        {
                            data: 'created_at',
                            render: function(data) {
                                return new Date(data).toLocaleDateString('id-ID');
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ url('files/download') }}/${row.id}" class="btn btn-success" title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-danger delete-btn" data-id="${row.id}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                            }
                        }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' // Bahasa Indonesia
                    }
                });

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
                                table.ajax.reload(null, false); // Reload tanpa reset paging
                                toastr.success(
                                    'Upload berhasil!'); // Asumsi pakai Toastr untuk notif
                            } else {
                                toastr.error('Upload gagal: ' + (response.message || 'Coba lagi.'));
                            }
                        },
                        error: function(xhr) {
                            let msg = 'Terjadi kesalahan: ';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg += xhr.responseJSON.message;
                            } else {
                                msg += 'Server error.';
                            }
                            toastr.error(msg);
                        },
                        complete: function() {
                            submitBtn.prop('disabled', false).text('Upload');
                        }
                    });
                });

                // Handle Delete
                $(document).on('click', '.delete-btn', function() {
                    if (confirm('Yakin mau hapus file ini?')) {
                        let id = $(this).data('id');
                        $.ajax({
                            url: "{{ route('qa.capa.1.destroy', ':id') }}".replace(':id', id),
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    table.ajax.reload(null, false);
                                    toastr.success('File dihapus!');
                                }
                            },
                            error: function() {
                                toastr.error('Gagal hapus file.');
                            }
                        });
                    }
                });
            });
        </script>
    @endsection

</x-app-layout>
