<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12 d-flex justify-content-end gap-2">

            <a href="{{ route('ia.4.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</a>
        </div>
        
        <div class="col-12">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Departemen</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Auditee</th>
                        <th class="text-center">Auditor</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
               
            </table>
        </div>
    </div>
</x-app-layout>
