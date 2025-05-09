<x-app-layout :title="$title">
    <form action="" method="post" x-data="{
        showKuantitas: false,
        showWaktu: false,
        showKualitas: false
    }">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-group mt-3">
                    <label for="nama_supplier_outsource">Nama Supplier/Outsource:</label>
                    <input readonly type="text" id="nama_supplier_outsource" name="nama_supplier_outsource"
                        class="form-control" value="{{ $supplier->nama_supplier }}" readonly>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mt-3">
                    <label for="produk_jasa">Produk/Jasa:</label>
                    <input readonly type="text" id="produk_jasa" name="produk_jasa" class="form-control"
                        value="{{ $supplier->produsen ?? '' }}" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mt-3">
                    <label for="periode_evaluasi">Periode Evaluasi:</label>
                    <input type="text" id="periode_evaluasi" name="periode_evaluasi" class="form-control"
                        value="{{ $supplier->periode_evaluasi ?? '' }}" required>
                </div>
            </div>
        </div>

        {{-- kuantitas tidak sesuai --}}
        <h6>Jumlah pengiriman dengan kuantitas yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-primary" type="button" @click="showKuantitas = !showKuantitas">Tambah</button>
        <div x-show="showKuantitas" x-transition>
            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="jumlah" name="jumlah[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
            </x-multiple-input>
        </div>
        <hr>
        {{-- Waktu tidak sesuai --}}
        <h6>Jumlah pengiriman dengan Waktu yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-primary" type="button" @click="showWaktu = !showWaktu">Tambah</button>
        <div x-show="showWaktu" x-transition>
            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="jumlah" name="jumlah[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
            </x-multiple-input>
        </div>
        <hr>

        {{-- Kualitas tidak sesuai --}}
        <h6>Jumlah pengiriman dengan Kualitas yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-primary" type="button" @click="showKualitas = !showKualitas">Tambah</button>
        <div x-show="showKualitas" x-transition>
            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="tanggal[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="jumlah" name="jumlah[]" class="form-control form-control-sm"
                            required>
                    </div>
                </div>
            </x-multiple-input>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <p class="h4">Kriteria Evaluasi:</p>
                <table class="table table-dark border-dark table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Keterangan</th>
                        <th>Hasil Penilaian</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ketepatan Kuantitas Pengiriman</td>
                        <td>
                            Jumlah pengiriman dengan kuantitas yang tidak sesuai: <br>
                            <u>0 kali pengiriman</u>, yaitu: <br>
                            a. Terjadi pada ddmmyyyy karena apa <br>
                            b. <br>
                            c. <br>
                            d. <br>
                            e. <br>
                        </td>
                        <td align="center">100</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ketepatan Waktu Pengiriman</td>
                        <td>
                            Jumlah pengiriman dengan waktu pengiriman yang tidak sesuai: <br>
                            <u>0 kali pengiriman</u>, yaitu: <br>
                            a. <br>
                            b. <br>
                            c. <br>
                            d. <br>
                            e. <br>
                        </td>
                        <td align="center">100</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ketepatan Kualitas Pengiriman</td>
                        <td>
                            Jumlah pengiriman dengan kualitas yang tidak sesuai: <br>
                            <u>0 kali pengiriman</u>, yaitu: <br>
                            a. <br>
                            b. <br>
                            c. <br>
                            d. <br>
                            e. <br>
                        </td>
                        <td align="center">100</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Harga Produk/Jasa</td>
                        <td></td>
                        <td align="center">90</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kemudahan Komunikasi</td>
                        <td></td>
                        <td align="center">90</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="center">480</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Rata-rata</td>
                        <td align="center">96</td>
                    </tr>
                </table>
            </div>
        </div>


    </form>

</x-app-layout>
