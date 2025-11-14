<x-app-layout :title="$title">
    <div class="container mt-4">
        <form action="{{ route('ia.4.update', $laporan) }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-2">
                    <div>
                        <label for="tgl_audit" class="form-label">Tanggal Audit</label>
                        <input type="date" value="{{ $laporan->tgl_audit }}" class="form-control" id="tgl"
                            name="tgl_audit" required>
                    </div>
                </div>
                <div class="col-1">
                    <div>
                        <label for="urutan" class="form-label">Urutan</label>
                        <input readonly type="text" class="form-control" value="{{ $laporan->urutan }}"
                            id="urutan" name="urutan" required>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div>
                        <label for="divisi" class="form-label">divisi</label>
                        <select name="divisi" class="selectAudtor" id="">
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisi as $d)
                                <option @selected($laporan->divisi == $d->divisi) value="{{ $d->divisi }}">{{ $d->divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="auditee" class="form-label">Auditor</label>
                        <select name="audite" class="form-control selectAudtor">
                            <option value="">Pilih Auditor</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->nama }}"
                                    {{ $laporan->audite == $u->nama ? 'selected' : '' }}>
                                    {{ $u->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="finding" class="form-label">Finding</label>
                        <input type="text" class="form-control" id="finding" name="finding"
                            value="{{ $laporan->finding }}" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="">
                        <label for="tindakan" class="form-label">Tindak Perbaikan</label>
                        <textarea rows="10" class="form-control" id="tindakan" name="perbaikan" required>{{ $laporan->perbaikan }}</textarea>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="">
                        <label for="tindakan" class="form-label">Tindak Pencegahan</label>
                        <textarea rows="10" class="form-control" id="tindakan" name="pencegahan" required>{{ $laporan->pencegahan }}</textarea>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="pic" class="form-label">PIC</label>
                        <select name="pic" class="form-control selectAudtor">
                            <option value="">Pilih PIC</option>
                            @foreach ($user as $u)
                                <option value="{{ $u->nama }}" {{ $laporan->pic == $u->nama ? 'selected' : '' }}>
                                    {{ $u->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="completion_date" class="form-label">Completion Date</label>
                        <input type="date" class="form-control" id="completion_date" name="completion_date"
                            value="{{ $laporan->completion_date }}" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            value="{{ $laporan->status }}" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 d-flex justify-content-end">
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
