<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('qa.penanganan-produk.1.create') }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i>
                Add</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Kejadian</th>
                <th>Sumber / Penyebab</th>
                <th>Nama Produk</th>
                <th>Kode Produksi</th>
                <th>Jumlah Produk</th>
                <th>Status</th>
                <th>Penanganan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penanganan as $d)
                <td class="td_atas">{{ $loop->iteration }}</td>
                <td class="td_atas">{{ tanggal($d->tgl_kejadian) }}</td>
                <td class="td_atas">{{ $d->sumber_penyebab }}</td>
                <td class="td_atas">{{ $d->rwb->grade->nama }}</td>
                <td class="td_atas">{{ $d->kode_produksi }}</td>
                <td class="td_atas">{{ $d->jumlah_produk }} gram</td>
                <td class="td_atas">{{ $d->status }}</td>
                <td class="td_atas">{{ $d->penanganan }}</td>
                <td class="text-nowrap">
                    <a class="btn btn-xs  btn-primary" target="_blank"
                        href="{{ route('qa.penanganan-produk.1.print', $d->id) }}"><i class="fas fa-print"></i>
                        Print</a>
                    <a href="{{ route('qa.penanganan-produk.1.edit', $d->id) }}" class="btn btn-warning btn-xs "><i
                            class="fas fa-edit"></i> Edit</a>
                    <a href="{{ route('qa.penanganan-produk.1.destroy', $d->id) }}"
                        onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-xs "><i
                            class="fas fa-trash"></i> Hapus</a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
