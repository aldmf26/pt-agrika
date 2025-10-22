<x-app-layout :title="$title">
    <form action="" method="post" x-data="{
        kategori: '{{ $kategori }}'
    }">
        @csrf
        <x-multiple-input>
            <div class="col-3">
                <div class="form-group">
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                    <label for="">Nama Supplier</label>
                    <input required type="text" name="nama_supplier[]" placeholder="Nama Supplier"
                        class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Alamat Supplier</label>
                    <input required type="text" name="alamat_supplier[]" placeholder="Alamat Supplier"
                        class="form-control">
                </div>
            </div>
            {{-- <div class="col-3">
                <div class="form-group">
                    <label for="">NIK / Produsen</label>
                    <input type="text" name="produsen[]" placeholder="Nik / Produsen" class="form-control">
                </div>
            </div> --}}
            <div class="col-3">
                <div class="form-group">
                    <label for="">Contact Person</label>
                    <input type="text" name="contact_person[]" placeholder="Contact Person" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">No Telp</label>
                    <input type="text" name="no_telp[]" placeholder="No Telp" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">
                        Kategori / Layanan
                        <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"
                            title="isi Barang: untuk bahan baku, isi kemasan : untuk barang kemasan"></i>
                    </label>
                    <select name="jenis_produk[]" x-model="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach (jenisProduk() as $d => $i)
                            <option @selected($d == $kategori) value="{{ $d }}">{{ $i }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3" x-show="kategori == 'lainnya'">
                <div class="form-group">
                    <label for="">No Reg</label>
                    <input type="text" name="no_reg[]" placeholder="No registrasi" class="form-control">
                </div>
            </div>
            <div class="col-3" x-show="kategori == 'lainnya'">
                <div class="form-group">
                    <label for="">Kode</label>
                    <input type="no_reg" name="kode[]" placeholder="Kode Rumah Walet" class="form-control">
                </div>
            </div>

            <div class="col-3">
                <div class="form-group" x-show="kategori != 'lainnya'">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan[]" placeholder="Keterangan" class="form-control">
                </div>
            </div>
            {{-- <div class="col-3">
                <div class="form-group">
                    <label for="">Hasil Evaluasi</label>
                    <input type="text" name="hasil[]" placeholder="Hasil" class="form-control">
                </div>
            </div> --}}
        </x-multiple-input>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>

</x-app-layout>
