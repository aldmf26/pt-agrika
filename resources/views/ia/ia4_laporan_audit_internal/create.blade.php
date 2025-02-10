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
                <div class="col-md-1 col-sm-4">
                    <div>
                        <label for="no_ftpp" class="form-label">No FTPP</label>
                        <input type="text" class="form-control" id="no_ftpp" name="no_ftpp" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div>
                        <label for="departemen" class="form-label">Departemen</label>
                        <input type="text" class="form-control" id="departemen" name="departemen" required>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4">
                    <div>
                        <label for="tgl_audit" class="form-label">Tanggal Audit</label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="tgl_audit" name="tgl_audit" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="auditee" class="form-label">Auditee</label>
                        <input type="text" class="form-control" id="auditee" name="auditee" required>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div>
                        <label for="auditor" class="form-label">Auditor</label>
                        <input type="text" class="form-control" id="auditor" name="auditor" required>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12">
                    <div class="">
                        <label for="laporan_audit" class="form-label">Laporan Audit</label>
                        <textarea rows="10" class="form-control" id="laporan_audit" name="laporan_audit" required></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-end mt-3">Simpan</button>
        </form>
    </div>

</x-app-layout>
