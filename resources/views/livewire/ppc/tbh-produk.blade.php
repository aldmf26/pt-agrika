<div>
    <div class="row">
        <div class="col-4">
            <span class="badge bg-primary pointer" @click="showProduk = !showProduk">Lihat Produk</span>
        </div>
        <div x-show="showProduk">
            <div class="input-group mb-2 mt-3">
                <input type="text" id="pencarianInput" class="form-control form-control-sm" placeholder="Cari produk"
                    aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div style="overflow: auto; height: 300px">
                <table id="tblInput" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Kode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama_produk }}</td>
                                <td>{{ $d->kode_produk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="store">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input type="text" wire:model="forms.nm_produk" class="form-control">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="">Satuan</label>
                    <input type="text" wire:model="forms.satuan" class="form-control">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="">Sistem Kode</label>
                    <input placeholder="DD MMYYYY KK MM YY" x-mask:dynamic="creditCardMask" type="text"
                        wire:model="forms.kode" class="form-control">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button type="submit" class="float-end btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('scripts')
    <script>
        function creditCardMask(input) {
            return input.startsWith('34') || input.startsWith('37') ?
                '9999 999999 99999' :
                '99 999999 99 99 99'
        }
        pencarian('pencarianInput', 'tblInput');
    </script>
@endsection
