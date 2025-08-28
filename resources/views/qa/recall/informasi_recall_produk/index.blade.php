<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('qa.5.1.create') }}" class="btn btn-sm  btn-primary float-end"><i class="fas fa-plus"></i>
                {{ $title }}</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th colspan="4">Informasi produk</th>
                        <th colspan="4">Informasi pelanggan</th>
                    </tr>
                    <tr>
                        <th>Nama produk</th>
                        <th>kode produk</th>
                        <th>Tanggal produk <br> Kode batch</th>
                        <th>Jumlah recall <br> pack / kg / gram</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jumlah didistribusikan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
