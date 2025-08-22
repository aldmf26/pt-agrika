<x-app-layout :title="$title">
    <form action="{{ route('qa.penanganan-produk.1.update') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">1. Tanggal Kejadian</label>
                    <input type="hidden" name="id" value="{{ $produk->id }}">
                    <input value="{{ $produk->tgl_kejadian }}" required type="date" name="tanggal_kejadian"
                        placeholder="Tanggal Kejadian" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">2. Sumber / Penyebab</label>
                    <input required type="text" name="sumber_penyebab" placeholder="Cerita rentetan kejadian"
                        class="form-control" value="{{ $produk->sumber_penyebab }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">3. Nama produk</label>
                    <select name="nama_produk" id="" class="select2sbw">
                        <option value="">Pilih Produk</option>
                        @foreach ($sbw as $s)
                            <option value="{{ $s->id }}" @selected($s->id == $produk->nama_produk)
                                data-no_lot="{{ $s->no_lot }}">{{ $s->nama }} -
                                {{ $s->no_lot }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">4. Kode produksi</label>
                    <input required type="text" readonly name="kode_produksi" placeholder="Tulis Batch number"
                        class="form-control" value="{{ $produk->kode_produksi }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">5. Jumlah produk</label>
                    <div class="input-group">
                        <input required type="text" name="jumlah_produk" placeholder="Jumlah produk"
                            class="form-control" value="{{ $produk->jumlah_produk }}">
                        <div class="input-group-append">
                            <span class="input-group-text">gram </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">6. Status </label>
                    <select name="status" id="" class="form-control">
                        <option value="hold" @selected($produk->status == 'Hold')>Hold</option>
                        <option value="reject" @selected($produk->status == 'Reject')>Reject</option>
                        <option value="rework" @selected($produk->status == 'Rework')>Rework</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">7. Penanganan</label>
                    <textarea required name="penanganan"
                        placeholder="Jabarkan satu demi satu langkah yang harus dilakukan terhadap status keputusan produk"
                        class="form-control" rows="3">{{ $produk->penanganan }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>
    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select2sbw').select2();
                }, 100);

                $('.select2sbw').change(function() {
                    var no_lot = $('.select2sbw').find(':selected').data('no_lot');
                    $('[name="kode_produksi"]').val(no_lot);
                });
            });
        </script>
    @endsection
</x-app-layout>
