<div>

    <select class="select2barang" name="id_barang">
        <option value="">-- Pilih Item --</option>
        @foreach ($barangs as $p)
            <option value="{{ $p->id }}" data-kode="{{ $p->kode_barang }}">
                {{ $p->nama_barang }} </option>
        @endforeach
        <option value="tambah">+ Barang</option>
    </select>

    <x-modal title="Tambah Barang" id="modalTambahBarang" btnSave="T">
        <div class="row">

            <div class="col-12 mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" id="nama_barang" class="form-control" placeholder="Nama Barang"
                    wire:model.defer="barangBaru.kode_barang">
                {{-- <select id="kode_barang" class="select2modal form-select" wire:model.defer="barangBaru.kode_barang">
                    <option value="">-- Pilih Kode Barang --</option>
                    @foreach ($kodes as $kode)
                        <option value="{{ $kode->id }}">{{ $kode->nama }}</option>
                    @endforeach
                </select> --}}
            </div>
            <div class="col-12 mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" id="nama_barang" class="form-control" placeholder="Nama Barang"
                    wire:model.defer="barangBaru.nama_barang">
            </div>
            <div class="col-12 mb-3">
                <label for="satuan" class="form-label">Satuan Barang</label>
                <input type="text" id="satuan" class="form-control" placeholder="Satuan Barang"
                    wire:model.defer="barangBaru.satuan">
            </div>
            <div class="col-12 mb-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select id="supplier_id" class="select2modal form-select" wire:model.defer="barangBaru.supplier_id">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($supliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
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
            function updateKodeLot() {
                var kode_barang = $('.select2barang').find(':selected').data('kode') || '';
                var tgl_kedatangan = $('input[name="tgl_penerimaan"]').val();
                var tgl_expired = $('input[name="tgl_expired"]').val();

                if (tgl_kedatangan && tgl_expired && kode_barang) {
                    var kedatangan_parts = tgl_kedatangan.split('-');
                    var kd_tgl = kedatangan_parts[2];
                    var kd_bulan = kedatangan_parts[1];
                    var kd_tahun = kedatangan_parts[0];

                    var expired_parts = tgl_expired.split('-');

                    var exp_bulan = expired_parts[1];
                    var exp_tahun = expired_parts[0];

                    var kode_lot = `${kd_tgl}-${kd_bulan}${kd_tahun}-${kode_barang}-${exp_bulan}-${exp_tahun}`;
                    $("input[name=kode_lot]").val(kode_lot);
                }
            }

            // Event listener untuk semua elemen yang mempengaruhi kode lot
            $('.select2barang, input[name="tgl_penerimaan"], input[name="tgl_expired"]').change(updateKodeLot);

            // Panggil fungsi sekali saat halaman dimuat (jika ada data default)
            $(document).ready(updateKodeLot);
            // Delay the initialization slightly to ensure DOM is fully ready
            setTimeout(function() {

                $('.select2barang').select2();

                $('.select2barang').on('select2:select', function(e) {
                    var data = e.params.data;
                    if (data.id == 'tambah') {
                        $('#modalTambahBarang').modal('show');
                    }
                });
            }, 100);
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                $('#modalTambahBarang').modal('hide');
                setTimeout(function() {
                    $('.select2barang').select2();
                }, 100);
            });
        });
    </script>
@endsection
