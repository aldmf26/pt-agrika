<div>
    <select name="id_rumah_walet" class="select2rumahWalet" id="">
        <option value="">-Pilih Rumah Walet-</option>
        @foreach ($rumahWalet as $p)
            <option value="{{ $p->id }}">{{ $p->nama }}</option>
        @endforeach
        <option value="tambah">+ Rumah Walet</option>
    </select>

    <x-modal title="Tambah Rumah Walet" id="modalTambahRumhWalet" btnSave="T">
        <div class="row">
            <div class="col-12 mb-3">
                <label for="namaRumahWalet" class="form-label">Nama Rumah Walet</label>
                <input type="text" id="namaRumahWalet" class="form-control" placeholder="Nama Rumah Walet"
                    wire:model.defer="rumahWaletBaru.nama">
            </div>
            <div class="col-12 mb-3">
                <label for="alamatRumahWalet" class="form-label">Alamat Rumah Walet</label>
                <input type="text" id="alamatRumahWalet" class="form-control" placeholder="Alamat Rumah Walet"
                    wire:model.defer="rumahWaletBaru.alamat">
            </div>
            <div class="col-12 mb-3">
                <label for="noRegRumahWalet" class="form-label">No Reg Rumah Walet</label>
                <input type="text" id="noRegRumahWalet" class="form-control" placeholder="No Reg Rumah Walet"
                    wire:model.defer="rumahWaletBaru.no_reg">
            </div>
        </div>

        <button type="button" wire:click="tambah" class="float-end btn btn-sm btn-primary">
            <span wire:loading.class.remove="d-none" class="d-none spinner-border spinner-border-sm me-2" role="status"
                aria-hidden="true"></span>
            Simpan
        </button>
    </x-modal>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {

            // Delay the initialization slightly to ensure DOM is fully ready
            setTimeout(function() {

                $('.select2rumahWalet').select2();

                $('.select2rumahWalet').on('select2:select', function(e) {
                    var data = e.params.data;
                    if (data.id == 'tambah') {
                        $('#modalTambahRumhWalet').modal('show');
                    }
                });
            }, 100);
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                $('#modalTambahRumhWalet').modal('hide');
                setTimeout(function() {
                    $('.select2rumahWalet').select2();
                }, 100);
            });
        });
    </script>
@endsection
