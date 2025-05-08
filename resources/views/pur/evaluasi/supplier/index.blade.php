<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        {{-- <div>

            <a href="{{ route('pur.seleksi.1.print') }}" class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                Print</a>

            <a href="{{ route('pur.seleksi.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Daftar Supplier</a>
        </div> --}}
    </div>

<table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>Produsen</th>
                <th>Contact Person</th>
                <th>No Telp</th>
                <th>Jenis Produk / Layanan</th>
                <th>Hasil Evaluasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</x-app-layout>
