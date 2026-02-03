<x-app-layout :title="$title">
    <!-- Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
            <i class="fas fa-trash"></i> Hapus <span id="selectedCount">0</span>
        </button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Upload File
        </button>
    </div>

    <!-- Hidden Form untuk Bulk Delete -->
    <form id="bulkDeleteForm" method="POST" style="display: none;">
        @csrf
        @method('POST')
        <div id="idsContainer"></div>
    </form>

    <!-- Modal Upload (dengan folder management via Livewire) -->
    <form id="uploadForm" enctype="multipart/form-data">
        <x-modal btnSave="T" idModal="uploadModal" title="Upload File" size="modal-lg">
            @csrf

            <!-- Folder Management (Livewire Component) -->
            <livewire:folder-manager :kategori="$kategori" key="folder-{{ $kategori }}" />

            <!-- Hidden input to capture selected folder from Livewire -->
            <input type="hidden" name="folder" id="selectedFolder" value="">

            <hr class="my-3">

            <!-- File Selection -->
            <div class="mb-3">
                <label for="excelFile" class="form-label">Pilih File atau Drag & Drop</label>
                <div id="dropZone" class="border-2 border-dashed rounded p-4 text-center bg-warning"
                    style="cursor: pointer; transition: all 0.3s;">
                    <i class="fas fa-cloud-upload-alt" style="font-size: 3rem; color: #6c757d;"></i>
                    <p class="mt-2 mb-0">Drag & drop file di sini atau klik untuk memilih</p>
                    <small class="text-muted">Maksimal 10MB per file, maksimal 20 file sekaligus</small>
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

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" id="submitBtn" class="btn btn-md btn-primary" disabled>Upload Files</button>
            </div>
        </x-modal>
    </form>

    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="🔍 Cari file atau folder...">
    </div>

    <!-- Files List -->
    <div id="filesList" class="card">
        <div id="filesTableBody">
            <!-- Diisi oleh JavaScript -->
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                const dropZone = $('#dropZone');
                const fileInput = $('#excelFile');
                const filesList = $('#filesList');
                const noFilesMsg = $('#noFiles');
                const submitBtn = $('#submitBtn');
                const bulkDeleteBtn = $('#bulkDeleteBtn');
                const folderSelect = $('#folderSelect');
                const filesTableBody = $('#filesTableBody');
                const searchInput = $('#searchInput');
                let allFiles = [];
                let allFolders = [];
                let filteredFiles = [];

                // Load folders & files on page load
                loadFoldersAndFiles();

                // Edit folder inline
                window.startEditFolder = function(folderName) {
                    let folderId = folderName.replace(/\s+/g, '_');
                    let input = $(`#editInput_${folderId}`);
                    let btns = $(`#editBtns_${folderId}`);
                    let label = $(`.folder-header[data-folder="${folderName}"]`).find('strong');

                    input.val(folderName).show();
                    btns.show();
                    label.hide();
                    input.focus();
                };

                // Cancel edit
                $(document).on('click', '.cancelEdit', function() {
                    let folderName = $(this).data('folder');
                    let folderId = folderName.replace(/\s+/g, '_');
                    $(`#editInput_${folderId}`).hide().val('');
                    $(`#editBtns_${folderId}`).hide();
                    $(`.folder-header[data-folder="${folderName}"]`).find('strong').show();
                });

                function loadFoldersAndFiles() {
                    $.ajax({
                        url: "{{ route('qa.capa.1.getFoldersAndFiles') }}",
                        type: 'GET',
                        data: {
                            kategori: "{{ $kategori }}"
                        },
                        success: function(response) {
                            allFolders = response.folders || [];
                            allFiles = response.files || [];
                            filteredFiles = [...allFiles];

                            // Render files (Livewire handle folder dropdown)
                            renderFilesTable();
                        },
                        error: function(xhr) {
                            console.error('Error loading files:', xhr);
                        }
                    });
                }

                function renderFilesTable() {
                    filesTableBody.empty();

                    // Group filtered files by folder
                    let grouped = {};
                    filteredFiles.forEach(function(file) {
                        let folder = file.folder || 'Root';
                        if (!grouped[folder]) grouped[folder] = [];
                        grouped[folder].push(file);
                    });

                    // If no results
                    if (Object.keys(grouped).length === 0) {
                        filesTableBody.html(`
                            <div class="p-5 text-center text-muted">
                                <i class="fas fa-folder-open" style="font-size: 3rem;"></i>
                                <p class="mt-3">Belum ada file</p>
                            </div>
                        `);
                        return;
                    }

                    // Render folders with files
                    let html = '';
                    Object.keys(grouped).sort().forEach(function(folder) {
                        let files = grouped[folder];
                        let isRoot = folder === 'Root';
                        let folderId = folder.replace(/\s+/g, '_');

                        // Folder header
                        html += `
                            <div class="border-bottom">
                                <div class="d-flex align-items-center p-3 bg-light folder-header" data-folder="${folder}">
                                    <i class="fas fa-chevron-down toggle-folder" style="cursor:pointer; width:20px;"></i>
                                    <span class="flex-grow-1"><strong>📁 ${folder}</strong> <span class="badge bg-secondary">${files.length}</span></span>
                                    ${!isRoot ? `
                                                <form method="POST" action="{{ route('qa.capa.1.updateFolder') }}" style="display: inline;" id="editForm_${folder.replace(/\s+/g, '_')}">
                                                    @csrf
                                                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                                                    <input type="hidden" name="old_folder" value="${folder}">
                                                    <input type="text" name="new_folder" style="display: none; width: 150px;" class="form-control form-control-sm" id="editInput_${folder.replace(/\s+/g, '_')}">
                                                    <div style="display: none;" id="editBtns_${folder.replace(/\s+/g, '_')}">
                                                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                                        <button type="button" class="btn btn-sm btn-secondary cancelEdit" data-folder="${folder}">Batal</button>
                                                    </div>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-outline-primary edit-folder me-2" onclick="startEditFolder('${folder}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form method="POST" action="{{ route('qa.capa.1.deleteFolder') }}" style="display: inline;" onsubmit="return confirm('Hapus folder dan semua file di dalamnya?');">
                                                    @csrf
                                                    <input type="hidden" name="folder" value="${folder}">
                                                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-folder">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            ` : ''}
                                </div>
                                <div class="files-in-${folderId}">
                        `;

                        // Files in folder
                        files.forEach(function(file) {
                            html += `
                                <div class="d-flex align-items-center p-3 border-bottom file-row">
                                    <input type="checkbox" class="form-check-input file-checkbox me-3" value="${file.id}">
                                    <i class="fas fa-file me-2"></i>
                                    <div class="flex-grow-1">
                                        <div><strong>${file.nama_file}</strong></div>
                                        <small class="text-muted">${file.created_at}</small>
                                    </div>
                                    <a href="${file.download_url}" class="btn btn-sm btn-success me-2" target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="${file.delete_url}" onclick="return confirm('Hapus file ini?')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            `;
                        });

                        html += `</div></div>`;
                    });

                    filesTableBody.html(html);

                    // Folder toggle
                    $('.toggle-folder').off('click').on('click', function() {
                        let header = $(this).closest('.folder-header');
                        let folder = header.data('folder');
                        let folderId = folder.replace(/\s+/g, '_');
                        let filesDiv = filesTableBody.find(`.files-in-${folderId}`);
                        filesDiv.slideToggle();
                        $(this).toggleClass('fa-chevron-down fa-chevron-right');
                    });

                    // Reload after delete form submission
                    $('form[action="{{ route('qa.capa.1.deleteFolder') }}"]').on('submit', function() {
                        setTimeout(() => {
                            loadFoldersAndFiles();
                        }, 800);
                    });

                    // Attach checkbox events
                    attachCheckboxEvents();
                }

                // Search functionality
                searchInput.on('keyup', function() {
                    let query = $(this).val().toLowerCase().trim();

                    if (query.length === 0) {
                        filteredFiles = [...allFiles];
                    } else {
                        filteredFiles = allFiles.filter(function(file) {
                            return file.nama_file.toLowerCase().includes(query) ||
                                (file.folder && file.folder.toLowerCase().includes(query));
                        });
                    }

                    renderFilesTable();
                });


                // ===== UPLOAD FUNCTIONALITY =====
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

                    // Check max files limit
                    if (files.length > 20) {
                        alertToast('warning',
                            `⚠️ Maksimal 20 file per upload. Anda memilih ${files.length} file. Silakan pilih ulang.`
                        );
                        fileInput.val('');
                        filesList.empty();
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
                                    <div class="fw-bold small">${i+1}. </div>
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

                // Handle Upload - Simple & Clean
                $('#uploadForm').on('submit', function(e) {
                    e.preventDefault();
                    let folder = folderSelect.val() || null;
                    let formData = new FormData(this);
                    formData.set('folder', folder);
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
                                if (response.partial) {
                                    alertToast('warning', response.message);
                                } else {
                                    alertToast('sukses', response.message);
                                }

                                setTimeout(function() {
                                    $('#uploadModal').modal('hide');
                                    fileInput.val('');
                                    filesList.empty();
                                    noFilesMsg.show();
                                    loadFoldersAndFiles();
                                }, 1500);
                            } else {
                                alertToast('error', response.message || 'Upload gagal');
                                submitBtn.prop('disabled', false).text('Upload Files');
                            }
                        },
                        error: function(xhr) {
                            let msg = 'Terjadi kesalahan: ';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            } else if (xhr.status === 422) {
                                msg = 'Validasi gagal. Periksa format dan ukuran file.';
                            } else {
                                msg += xhr.statusText || 'Server error';
                            }
                            alertToast('error', msg);
                            submitBtn.prop('disabled', false).text('Upload Files');
                        }
                    });
                });

                // ===== BULK DELETE FUNCTIONALITY =====
                function attachCheckboxEvents() {
                    let fileCheckboxes = $('.file-checkbox');

                    fileCheckboxes.off('change').on('change', function() {
                        updateBulkDeleteBtn();
                    });
                }

                function updateBulkDeleteBtn() {
                    let checkedCount = $('.file-checkbox:checked').length;
                    $('#selectedCount').text(checkedCount);

                    if (checkedCount > 0) {
                        bulkDeleteBtn.show();
                    } else {
                        bulkDeleteBtn.hide();
                    }
                }

                bulkDeleteBtn.off('click').on('click', function() {
                    let selectedIds = [];
                    $('.file-checkbox:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    if (selectedIds.length === 0) {
                        alertToast('warning', 'Pilih file yang ingin dihapus');
                        return;
                    }

                    if (!confirm(`Yakin ingin menghapus ${selectedIds.length} file?`)) {
                        return;
                    }

                    let idsContainer = $('#idsContainer');
                    idsContainer.empty();
                    selectedIds.forEach(function(id) {
                        idsContainer.append(`<input type="hidden" name="ids[]" value="${id}">`);
                    });

                    $('#bulkDeleteForm').attr('action', "{{ route('qa.capa.1.bulkDestroy') }}").submit();
                });
            });
        </script>
    @endsection

</x-app-layout>
