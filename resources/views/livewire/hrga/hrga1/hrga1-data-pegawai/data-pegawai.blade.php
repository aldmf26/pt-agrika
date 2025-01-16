<div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</button>
    </div>
    <div class="d-flex justify-content-between mt-2">
        <div>
            <select wire:model.live="paginate" id="" class="form-control">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div>
            <input type="text" wire:model.live="search" class="form-control mb-2" placeholder="Cari produk..." />
        </div>
    </div>

    <table class="table table-striped border-dark">
        <thead>
            <tr>
                <th class="">No</th>
                <th class="">Divisi / Dept</th>
                <th class="">Nama</th>
                <th class="">Jenis Kelamin/ <br>Tgl lahir</th>
                <th class="">Status</th>
                <th class="">Tgl Masuk</th>
                <th class="">Posisi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Cabut</td>
                <td>Muhammad Fahrizaldi</td>
                <td>Pria / 26-06-1999</td>
                <td>Kontrak</td>
                <td>{{ tanggal('2025-01-01') }}</td>
                <td>Kontrak</td>
            </tr>

        </tbody>

    </table>
    {{-- <div class="mt-3 ">
        {{ $produk->links('vendor.pagination.bootstrap-5') }}
    </div> --}}
</div>
