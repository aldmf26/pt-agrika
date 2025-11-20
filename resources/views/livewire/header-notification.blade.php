<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div x-data="{ open: false }" @click.outside="open = false">
        <a @click="open = ! open" href="#" id="topbarUserDropdown"
            class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="avatar avatar-md2" style="bottom: 10px;">
                <i class="bi bi-bell bi-sub fs-4"></i>
                <span class="badge badge-notification bg-danger">{{ $notifications->count() }}</span>
            </div>
        </a>

        <div x-show="open" class="position-absolute">
            
            @if ($notifications->count() > 0)
                <table class="dropdownAldi table-hover table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Departemen</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Bulan Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="text-center align-middle">

                        @foreach ($notifications as $notif)
                            <tr class="pointer"
                                wire:click="route('{{ $notif->route_name }}', '{{ $notif->departemen }}')">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $notif->departemen }}</td>
                                <td>{{ $notif->nama }}</td>
                                <td>{{ $notif->month . ' / ' . $notif->year }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center dropdownAldi">Tidak Ada Notifikasi</p>
            @endif
        </div>
    </div>
</div>
