<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2 mb-3">
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload File
        </button>
    </div>

    <!-- Modal Upload -->
    <form id="uploadForm" enctype="multipart/form-data">
        <x-modal idModal="uploadModal" title="Upload File Excel" size="lg">
            @csrf
            <div class="mb-3">
                <label for="excelFile" class="form-label">Pilih File atau Drag & Drop</label>
                <div id="dropZone" class="border-2 border-dashed rounded p-4 text-center bg-light"
                    style="cursor: pointer; transition: all 0.3s;">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 3rem; color: #6c757d;"></i>
                    <p class="mt-2 mb-0">Drag & drop file di sini atau klik untuk memilih</p>
                    <small class="text-muted">Maksimal 10MB per file. Format: xlsx, xls, doc, docx, pdf, jpg, jpeg, png,
                        webp</small>
                </div>
                <input type="file" multiple class="form-control d-none" id="excelFile" name="excel_file[]"
                    accept=".xlsx,.xls,.doc,.docx,.pdf,.jpg,.jpeg,.png,.webp">
                <input type="hidden" name="kategori" value="{{ $kategori }}">
            </div>

            <!-- Preview Files -->
            <div id="filesPreview" class="mb-3">
                <label class="form-label">File yang akan diupload:</label>
                <div id="filesList" class="list-group"></div>
                <div id="noFiles" class="alert alert-info small mb-0">Belum ada file yang dipilih</div>
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
                const dropZone = $('#dropZone');
                const fileInput = $('#excelFile');
                const filesList = $('#filesList');
                const noFilesMsg = $('#noFiles');
                const submitBtn = $('#submitBtn');

                // Click to select files
                dropZone.on('click', function() {
                    fileInput.click();
                });

                // Drag and drop events
                dropZone.on('dragover', function(e) {
                    e.preventDefault();
                    dropZone.css({
                        'border-color': '#0d6efd',
                        'background-color': '#e7f1ff'
                    });
                });

                dropZone.on('dragleave', function() {
                    dropZone.css({
                        'border-color': '#dee2e6',
                        'background-color': '#f8f9fa'
                    });
                });

                dropZone.on('drop', function(e) {
                    e.preventDefault();
                    dropZone.css({
                        'border-color': '#dee2e6',
                        'background-color': '#f8f9fa'
                    });

                    let files = e.originalEvent.dataTransfer.files;
                    fileInput[0].files = files;
                    updateFilesList();
                });

                // File input change
                fileInput.on('change', function() {
                    updateFilesList();
                });

                // Update files preview list
                function updateFilesList() {
                    filesList.empty();
                    let files = fileInput[0].files;

                    if (files.length === 0) {
                        noFilesMsg.show();
                        submitBtn.prop('disabled', true);
                        return;
                    }

                    noFilesMsg.hide();
                    submitBtn.prop('disabled', false);

                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        let size = (file.size / 1024 / 1024).toFixed(2);
                        let icon = getFileIcon(file.type);

                        let fileItem = `
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas ${icon}" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <div class="fw-bold small">${file.name}</div>
                                        <small class="text-muted">${size} MB</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-file" data-index="${i}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        filesList.append(fileItem);
                    }

                    // Remove file event
                    $('.remove-file').on('click', function(e) {
                        e.preventDefault();
                        let index = $(this).data('index');
                        removeFile(index);
                    });
                }

                // Get file icon based on type
                function getFileIcon(fileType) {
                    if (fileType.includes('spreadsheet') || fileType.includes('excel')) return 'fa-file-excel';
                    if (fileType.includes('word') || fileType.includes('document')) return 'fa-file-word';
                    if (fileType.includes('pdf')) return 'fa-file-pdf';
                    if (fileType.includes('image')) return 'fa-file-image';
                    return 'fa-file';
                }

                // Remove file from selection
                function removeFile(index) {
                    let dataTransfer = new DataTransfer();
                    let files = fileInput[0].files;

                    for (let i = 0; i < files.length; i++) {
                        if (i !== index) {
                            dataTransfer.items.add(files[i]);
                        }
                    }

                    fileInput[0].files = dataTransfer.files;
                    updateFilesList();
                }

                // Handle Upload
                $('#uploadForm').on('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);
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
                                fileInput.val(''); // Reset input
                                filesList.empty();
                                noFilesMsg.show();
                                alertToast('sukses', response.message || 'Upload berhasil!');
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
                            submitBtn.prop('disabled', false).text('Upload Files');
                        }
                    });
                });
            });
        </script>
    @endsection

</x-app-layout>
