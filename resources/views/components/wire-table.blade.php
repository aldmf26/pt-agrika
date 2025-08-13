<div class="d-flex justify-content-between mt-2">
    <div>
        <select wire:model.live="paginate" id="" class="form-control">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <div class="d-flex gap-2">
        <div>
            <div wire:loading class="spinner-border text-primary" role="status" bis_skin_checked="1">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div>
            <input type="text" wire:model.live="search" class="form-control mb-2" placeholder="Cari pegawai..." />
        </div>
    </div>
</div>

{{ $slot }}

<div class="mt-3 ">
    {{ $datas->links() }}
</div>
