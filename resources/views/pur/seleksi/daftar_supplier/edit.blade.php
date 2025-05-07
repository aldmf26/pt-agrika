<x-app-layout :title="$title">
    <form action="{{ route('pur.seleksi.1.update', $supplier->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Nama Supplier</label>
                    <input required type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}"
                        placeholder="Nama Supplier" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Alamat Supplier</label>
                    <input required type="text" name="alamat_supplier" value="{{ $supplier->alamat }}"
                        placeholder="Alamat Supplier" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Produsen</label>
                    <input type="text" name="produsen" value="{{ $supplier->produsen }}" placeholder="Produsen"
                        class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ $supplier->contact_person }}"
                        placeholder="Contact Person" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">No Telp</label>
                    <input type="text" name="no_telp" value="{{ $supplier->no_telp }}" placeholder="No Telp"
                        class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Jenis Produk / Layanan</label>
                    <input type="text" name="jenis_produk" value="{{ $supplier->kategori }}"
                        placeholder="Jenis Produk / Layanan" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="ket" value="{{ $supplier->ket }}" placeholder="Keterangan"
                        class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Hasil Evaluasi</label>
                    <input type="text" name="hasil" value="{{ $supplier->hasil_evaluasi }}" placeholder="Hasil"
                        class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Simpan</button>
            </div>
        </div>
    </form>
</x-app-layout>
