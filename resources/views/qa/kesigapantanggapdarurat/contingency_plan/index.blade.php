<x-app-layout :title="$title" :container="'container-fluid'">
    <div x-data="Contingency_planManager()">
        <div class="d-flex justify-content-end gap-2 mb-3">
            <button @click="openCreateModal()" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add
            </button>

            <a href="{{ route('qa.kesigapan.4.contingency_plan_print') }}" class="btn btn-sm btn-primary"
                target="_blank"><i class="fas fa-print"></i>
                Print</a>
        </div>

        <!-- Table -->
        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Cases</th>
                    <th class="text-center">Responsibility & Autority</th>
                    <th class="text-center">Preparedness</th>
                    <th class="text-center">Response (If The Cases Come Into Real Condition)</th>
                    <th class="text-center">Related Documents</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td>{{ $d->cases }}</td>
                        <td>{{ $d->responsibility ?? '' }}</td>
                        <td>{!! nl2br(e($d->preparedness ?? '')) !!}</td>
                        <td>{!! nl2br(e($d->response ?? '')) !!}</td>
                        <td>{!! nl2br(e($d->related_documents ?? '')) !!}</td>
                        <td class="text-center">
                            <button
                                @click="openEditModal(
                                    {{ $d->id }},
                                    {{ json_encode($d->cases ?? '') }},
                                    {{ json_encode($d->responsibility ?? '') }},
                                    {{ json_encode($d->preparedness ?? '') }},
                                    {{ json_encode($d->response ?? '') }},
                                    {{ json_encode($d->related_documents ?? '') }}
                                )"
                                class="btn btn-warning btn-xs me-1">
                                <i class="fas fa-plus"></i> Contingency Plan
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Edit -->
        <div class="modal fade" :class="{ 'show d-block': showEditModal }" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Contingency Plan</h5>
                        <button type="button" class="btn-close" @click="closeEditModal()"></button>
                    </div>
                    <form method="POST" :action="editRoute">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-center">Responsibility & Autority <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="responsibility" class="form-control"
                                            x-model="editForm.responsibility" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-center">Preparedness <span
                                                class="text-danger">*</span></label>
                                        <textarea rows="5" name="preparedness" class="form-control" x-model="editForm.preparedness" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-center">Response (If The Cases Come Into Real
                                            Condition) <span class="text-danger">*</span></label>
                                        <textarea rows="5" name="response" class="form-control" x-model="editForm.response" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-center">Related Documents <span
                                                class="text-danger">*</span></label>
                                        <textarea rows="5" name="related_documents" class="form-control" x-model="editForm.related_documents" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="closeEditModal()">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        function Contingency_planManager() {
            return {
                showCreateModal: false,
                showEditModal: false,
                editForm: {
                    cases: '',
                    responsibility: '',
                    preparedness: '',
                    response: '',
                    related_documents: ''
                },
                editRoute: '',

                openCreateModal() {
                    this.showCreateModal = true;
                },

                closeCreateModal() {
                    this.showCreateModal = false;
                },

                openEditModal(id, cases, responsibility, preparedness, response, related_documents) {
                    this.editForm.cases = cases;
                    this.editForm.responsibility = responsibility;
                    this.editForm.preparedness = preparedness;
                    this.editForm.response = response;
                    this.editForm.related_documents = related_documents;
                    this.editRoute = `{{ route('qa.kesigapan.4.contingency_plan_update', '') }}/${id}`;
                    this.showEditModal = true;
                },

                closeEditModal() {
                    this.showEditModal = false;
                    this.editForm = {
                        cases: '',
                        responsibility: '',
                        preparedness: '',
                        response: '',
                        related_documents: ''
                    };
                }
            }
        }
    </script>
</x-app-layout>
