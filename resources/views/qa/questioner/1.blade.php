<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Sub Kategori</th>
            <th>Pertanyaan</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pertanyaan as $item)
            <tr>
                <td>{{ $item->no_pertanyaan }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->sub_kategori }}</td>
                <td>{{ $item->teks_pertanyaan }}</td>
                <td>{{ $item->catatan }}</td>
                <td>
                    {{-- <a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Hapus</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
