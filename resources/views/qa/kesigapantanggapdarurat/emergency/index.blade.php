<x-app-layout :title="$title" :container="'container-fluid'">
    <div x-data="EmergencyManager()">
        <div class="d-flex justify-content-end gap-2 mb-3">
            <button @click="openCreateModal()" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add
            </button>

            <a href="{{ route('qa.kesigapan.3.emergency_print') }}" class="btn btn-sm btn-primary" target="_blank"><i
                    class="fas fa-print"></i>
                Print</a>
        </div>

        <!-- Table -->
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Cases</th>
                    <th class="text-center">Ruang Lingkup</th>
                    <th class="text-center">Reason</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td>{{ $d->cases }}</td>
                        <td>{{ $d->ruang_lingkup }}</td>
                        <td>{{ $d->reason }}</td>
                        <td class="text-center">
                            <button
                                @click="openEditModal({{ $d->id }}, '{{ $d->cases }}', '{{ $d->ruang_lingkup }}', '{{ $d->reason }}')"
                                class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form method="POST" action="{{ route('qa.kesigapan.3.emergency_delete', $d->id) }}"
                                style="display:inline;" @submit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus data ini?')" type="submit"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Create -->
        <div class="modal fade" :class="{ 'show d-block': showCreateModal }" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Emergency</h5>
                        <button type="button" class="btn-close" @click="closeCreateModal()"></button>
                    </div>
                    <form method="POST" action="{{ route('qa.kesigapan.3.emergency_store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Cases <span class="text-danger">*</span></label>
                                <input type="text" name="cases" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ruang Lingkup <span class="text-danger">*</span></label>
                                <input type="text" name="ruang_lingkup" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reason
                                    (Contribution to Quality and Food Safety Issue) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="reason" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                @click="closeCreateModal()">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" :class="{ 'show d-block': showEditModal }" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Emergency</h5>
                        <button type="button" class="btn-close" @click="closeEditModal()"></button>
                    </div>
                    <form method="POST" :action="editRoute">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Cases <span class="text-danger">*</span></label>
                                <input type="text" name="cases" class="form-control" x-model="editForm.cases"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ruang Lingkup <span class="text-danger">*</span></label>
                                <input type="text" name="ruang_lingkup" class="form-control"
                                    x-model="editForm.ruang_lingkup" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reason (Contribution to Quality and Food Safety Issue) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="reason" class="form-control" x-model="editForm.reason"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeEditModal()">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        function EmergencyManager() {
            return {
                showCreateModal: false,
                showEditModal: false,
                editForm: {
                    cases: '',
                    ruang_lingkup: '',
                    reason: ''
                },
                editRoute: '',

                openCreateModal() {
                    this.showCreateModal = true;
                },

                closeCreateModal() {
                    this.showCreateModal = false;
                },

                openEditModal(id, cases, ruang_lingkup, reason) {
                    this.editForm.cases = cases;
                    this.editForm.ruang_lingkup = ruang_lingkup;
                    this.editForm.reason = reason;
                    this.editRoute = `{{ route('qa.kesigapan.3.emergency_update', '') }}/${id}`;
                    this.showEditModal = true;
                },

                closeEditModal() {
                    this.showEditModal = false;
                    this.editForm = {
                        cases: '',
                        ruang_lingkup: '',
                        reason: ''
                    };
                }
            }
        }
    </script>
</x-app-layout>
