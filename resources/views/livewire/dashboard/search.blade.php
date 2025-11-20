<div>
    <main>
        <div x-data="searchInput">
            <input class="form-control" type="text" placeholder="cari menu" wire:model.live.debounce.300ms="search">
            <div wire:loading>
                <div class="spinner-grow text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            @if ($search)
                <table class="table table-bordered table-dark table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $item)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @if (!empty($item->subtitle))
                                        <a href="{{ route($item->link) }}?kategori={{ $item->subtitle }}">Buka</a>
                                    @else
                                        <a href="{{ route($item->link) }}">Buka</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</div>
