<div>

    <div class="row" x-data="{
        tgl: '',
    
    }">
        <div class="col-4">
            <span class="badge bg-primary pointer" @click="showProduk = !showProduk">Lihat Produk</span>
        </div>
        <div x-show="showProduk">
            <div class="input-group mb-2 mt-3">
                <input wire:model.live="cari" type="text" id="pencarianInput" class="form-control form-control-sm" placeholder="Cari produk"
                    aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div style="overflow: auto; height: 300px">
                @if (!empty($pesan))
                    <div class="alert alert-danger">{{ $pesan }}</div>
                @endif
                <table id="tblInput" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_barang }}</td>
                                <td>{{ $d->nama_barang }}</td>
                                <td>{{ $d->satuan }}</td>
                                <td>{{ $d->supplier->nama_supplier }}</td>
                                {{-- <td>{{ $d->no_lot }}</td> 
                                <td>
                                    <button wire:confirm='"Yakin ingin menghapus data ini?"' type="button"
                                        wire:click="hapus({{ $d->id }})"
                                        class="btn btn-xs btn-danger">Hapus</button>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="store">
        <h6>{{ ucwords($kategori) }}</h6>
        <div class="row">


            <div class="col-3">
                <div class="form-group">
                    <label for="">Kode Barang</label>
                    <input required type="text" wire:model="kodeBarang" class="form-control">
                    {{-- <div wire:ignore>
                        <select class="select2" id="kodeBarang">
                            <option value="">Pilih Kode</option>
                            @foreach ($kodes as $kode)
                                <option value="{{ $kode->kode }}">{{ $kode->kode }} ~ {{ $kode->nama }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input required type="text" wire:model="nama_barang" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Satuan</label>
                    <input required placeholder="satuan" type="text" wire:model="satuan" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Supplier</label>
                    <div wire:ignore>
                        <select required class="select2" id="supplierId">
                            <option value="">Pilih Suplier</option>
                            @foreach ($supliers as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        {{-- Sistem Kode / Lot
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="">A. Tanggal Kedatangan</label>
                    <input type="text" placeholder="DD" wire:model="lot.tgl" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">B. Bulan dan Tahun Kedatangan</label>
                    <input type="text" placeholder="MMYYYY" wire:model="lot.bulanDanTahun" class="form-control">
                </div>
            </div>
            
            <div class="col-2">
                <div class="form-group">
                    <label for="">D. Bulan Ekspired</label>
                    <input type="text" placeholder="MM" min="1" max="12" wire:model="lot.bulanExpired" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="">E. Tahun Ekspired</label>
                    <input type="text" placeholder="YY" wire:model="lot.tahunExpired" class="form-control">
                </div>
            </div>
            
        </div> --}}
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button type="submit" class="float-end btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('scripts')
    <script>
        $('.select2').on('change', function(e) {
            let elementName = $(this).attr('id');
            var data = $(this).select2("val");
            @this.set(elementName, data);
        });
        $(document).on('livewire:dispatch', 'refreshSelect2', function(e) {
            $('.select2').val(null).trigger('change');
        });
    </script>
@endsection
