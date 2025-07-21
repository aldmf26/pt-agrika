<div>
    <main>
        <div x-data="searchInput">
            <input class="form-control" type="text" placeholder="cari dokumen dengan : nama, no dokumen, atau PIC, tags"
                wire:model.live="search">
            <div wire:loading>
                <div class="spinner-grow text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            @if ($search)
                <table class="table table-striped table-bordered table-dark table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Jenis</th>
                            <th scope="col">No Dokumen</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Judul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $item)
                            <tr>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->no_dokumen }}</td>
                                <td>{{ $item->divisi }}</td>
                                <td>{{ $item->pic }}</td>
                                <td>{{ $item->judul }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</div>
