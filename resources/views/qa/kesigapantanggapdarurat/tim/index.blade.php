<x-app-layout :title="$title" :container="'container-fluid'">
    <div x-data="timManager()">
        <div class="d-flex justify-content-end gap-2 mb-3">
            <button @click="openCreateModal()" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add
            </button>

            <a href="{{ route('qa.kesigapan.2.tim_print') }}" class="btn btn-sm btn-primary" target="_blank"><i
                    class="fas fa-print"></i>
                Print</a>

        </div>

        <!-- Table -->
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tim as $d)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->hp }}</td>
                        <td class="text-center">
                            <button
                                @click="openEditModal({{ $d->id }}, '{{ $d->name }}', '{{ $d->title }}', '{{ $d->hp }}')"
                                class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form method="POST" action="{{ route('qa.kesigapan.2.tim_delete', $d->id) }}"
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
                        <h5 class="modal-title">Tambah Tim</h5>
                        <button type="button" class="btn-close" @click="closeCreateModal()"></button>
                    </div>
                    <form method="POST" action="{{ route('qa.kesigapan.2.tim_store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP <span class="text-danger">*</span></label>
                                <input type="text" name="hp" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeCreateModal()">Batal</button>
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
                        <h5 class="modal-title">Edit Tim</h5>
                        <button type="button" class="btn-close" @click="closeEditModal()"></button>
                    </div>
                    <form method="POST" :action="editRoute">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" x-model="editForm.name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" x-model="editForm.title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP <span class="text-danger">*</span></label>
                                <input type="text" name="hp" class="form-control" x-model="editForm.hp"
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
        function timManager() {
            return {
                showCreateModal: false,
                showEditModal: false,
                editForm: {
                    name: '',
                    title: '',
                    hp: ''
                },
                editRoute: '',

                openCreateModal() {
                    this.showCreateModal = true;
                },

                closeCreateModal() {
                    this.showCreateModal = false;
                },

                openEditModal(id, name, title, hp) {
                    this.editForm.name = name;
                    this.editForm.title = title;
                    this.editForm.hp = hp;
                    this.editRoute = `{{ route('qa.kesigapan.2.tim_update', '') }}/${id}`;
                    this.showEditModal = true;
                },

                closeEditModal() {
                    this.showEditModal = false;
                    this.editForm = {
                        name: '',
                        title: '',
                        hp: ''
                    };
                }
            }
        }
    </script>
</x-app-layout>
