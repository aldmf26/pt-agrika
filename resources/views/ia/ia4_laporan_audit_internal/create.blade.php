<x-app-layout :title="$title">
    @if (session()->has('error'))
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="container mt-4">
        <form action="" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-2">
                    <div>
                        <label for="tgl_audit" class="form-label">Tanggal Audit</label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="tgl"
                            name="tgl_audit" required>
                    </div>
                </div>
                <div class="col-1">
                    <div>
                        <label for="urutan" class="form-label">Urutan</label>
                        <input readonly type="text" class="form-control" value="{{ $urutan }}" id="urutan"
                            name="urutan" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div>
                        <label for="divisi" class="form-label">divisi</label>
                        <select name="divisi" class="selectAudtor" id="">
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $d)
                                <option value="{{ $d->divisi }}">{{ $d->divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div>
                        <label for="auditee" class="form-label">Auditor</label>
                        <select name="audite" class="form-control selectAudtor">
                            <option value="">Pilih Auditor</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->nama }}">{{ $u->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div>
                        <label for="finding" class="form-label">Finding</label>
                        <textarea rows="10" class="form-control" id="tindakan" name="finding" required></textarea>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="">
                        <label for="tindakan" class="form-label">Tindak Perbaikan</label>
                        <textarea rows="10" class="form-control" id="tindakan" name="perbaikan" required></textarea>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="">
                        <label for="tindakan" class="form-label">Tindak Pencegahan</label>
                        <textarea rows="10" class="form-control" id="tindakan" name="pencegahan" required></textarea>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div>
                        <label for="pic" class="form-label">PIC</label>
                        <select name="pic" class="form-control selectAudtor">
                            <option value="">Pilih PIC</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->nama }}">{{ $u->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div>
                        <label for="completion_date" class="form-label">Completion Date</label>
                        <input type="date" class="form-control" id="completion_date" name="completion_date" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                </div>
                <div class="col-md-1 col-sm-12 d-flex justify-content-end">
                    <div>
                        <button type="submit" class="btn btn-primary float-end mt-4">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.selectAudtor').select2();
                }, 100);
            });
        </script>
    @endsection
</x-app-layout>
