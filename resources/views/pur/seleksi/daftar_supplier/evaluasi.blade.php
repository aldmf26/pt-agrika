<x-app-layout :title="$title">
    <form action="{{ route('pur.seleksi.1.evaluasi_update', $supplier->id) }}" method="post" x-data="{
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
                        value="{{ $supplier->produsen ?? '' }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group mt-3">
                    <label for="periode_evaluasi">Periode Bulan Evaluasi:</label>
                    <input value="{{ $evaluasi->periode_evaluasi ?? '' }}" type="number" placeholder="masukan bulan"
                        id="periode_evaluasi" name="periode_evaluasi" class="form-control"
                        value="{{ $supplier->periode_evaluasi ?? '' }}">
                </div>
            </div>
        </div>

        {{-- kuantitas tidak sesuai --}}
        <h6>Jumlah pengiriman dengan kuantitas yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-info" type="button" @click="showKuantitas = !showKuantitas">Tambah</button>
        <div x-show="showKuantitas" x-transition>
            <x-evaluasi-input :evaluasi="$evaluasi" kriteria="kuantitas" />

            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="kuantitas_tanggal[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="karena" name="kuantitas_karena[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Hasil Penilaian</label>
                        <input type="text" id="karena" name="kuantitas_penilaian[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
            </x-multiple-input>
        </div>
        <hr>

        {{-- Waktu tidak sesuai --}}
        <h6>Jumlah pengiriman dengan Waktu yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-info" type="button" @click="showWaktu = !showWaktu">Tambah</button>
        <div x-show="showWaktu" x-transition>
            <x-evaluasi-input :evaluasi="$evaluasi" kriteria="waktu" />

            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="waktu_tanggal[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="karena" name="waktu_karena[]" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Hasil Penilaian</label>
                        <input type="text" id="karena" name="waktu_penilaian[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
            </x-multiple-input>
        </div>
        <hr>

        {{-- Kualitas tidak sesuai --}}
        <h6>Jumlah pengiriman dengan Kualitas yang tidak sesuai:</h6>
        <button class="btn btn-xs btn-info" type="button" @click="showKualitas = !showKualitas">Tambah</button>
        <div x-show="showKualitas" x-transition>
            <x-evaluasi-input :evaluasi="$evaluasi" kriteria="kualitas" />

            <x-multiple-input>
                <div class="col-2">
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" name="kualitas_tanggal[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Karena</label>
                        <input type="text" id="karena" name="kualitas_karena[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="jumlah">Hasil Penilaian</label>
                        <input type="text" id="karena" name="kualitas_penilaian[]"
                            class="form-control form-control-sm">
                    </div>
                </div>
            </x-multiple-input>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-3">
                <h6>Harga Produk/Jasa:</h6>
                <label>Keterangan</label>
                <input placeholder="keterangan" type="text" name="harga_keterangan"
                    value="{{ $detailAda ?? ($evaluasi->detail->where('jenis_kriteria', 'harga')->first()->alasan ?? '') }}"
                    class="form-control">
                <label>Penilaian</label>
                <input placeholder="hasil penilaian" type="text" name="harga_penilaian"
                    value="{{ $detailAda ?? ($evaluasi->detail->where('jenis_kriteria', 'harga')->first()->penilaian ?? '') }}"
                    class="form-control">
            </div>

            <div class="col-3">
                <h6>Kemudahan Komunikasi:</h6>

                <label>Keterangan</label>
                <input placeholder="keterangan" type="text" name="komunikasi_keterangan"
                    value="{{ $detailAda ?? ($evaluasi->detail->where('jenis_kriteria', 'komunikasi')->first()->alasan ?? '') }}"
                    class="form-control">

                <label>Penilaian</label>
                <input placeholder="hasil penilaian" type="text" name="komunikasi_penilaian"
                    value="{{ $detailAda ?? ($evaluasi->detail->where('jenis_kriteria', 'komunikasi')->first()->penilaian ?? '') }}"
                    class="form-control">

            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </form>



    @if ($detailAda)
        @php
            $kuantitas = $evaluasi->detail->where('jenis_kriteria', 'kuantitas')->whereNotNull('alasan');
            $waktu = $evaluasi->detail->where('jenis_kriteria', 'waktu')->whereNotNull('alasan');
            $kualitas = $evaluasi->detail->where('jenis_kriteria', 'kualitas')->whereNotNull('alasan');

            $harga = $evaluasi->detail->where('jenis_kriteria', 'harga')->whereNotNull('alasan')->first();
            $komunikasi = $evaluasi->detail->where('jenis_kriteria', 'komunikasi')->whereNotNull('alasan')->first();
            
            $totalPenilaian =
                $kuantitas->avg('penilaian') +
                $waktu->avg('penilaian') +
                $kualitas->avg('penilaian') +
                $harga->penilaian +
                $komunikasi->penilaian;

            $rataRata = $totalPenilaian / 5;
        @endphp
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <p class="h4">Kriteria Evaluasi:</p>
                    <div>
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('pur.seleksi.1.evaluasi_print', $supplier->evaluasi) }}"><i
                                class="fa fa-print"></i>
                            Cetak</a>
                    </div>
                </div>

                <table class="table table-dark mt-1 border-dark table-bordered">
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
                            <x-evaluasi-detail :datas="$kuantitas" />
                        </td>
                        <td align="center">{{ number_format($kuantitas->avg('penilaian'), 0) }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ketepatan Waktu Pengiriman</td>
                        <td>
                            Jumlah pengiriman dengan waktu pengiriman yang tidak sesuai: <br>
                            <x-evaluasi-detail :datas="$waktu" />

                        </td>
                        <td align="center">{{ number_format($waktu->avg('penilaian'), 0) }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ketepatan Kualitas Pengiriman</td>
                        <td>
                            Jumlah pengiriman dengan kualitas yang tidak sesuai: <br>
                            <x-evaluasi-detail :datas="$kualitas" />

                        </td>
                        <td align="center">{{ number_format($kualitas->avg('penilaian'), 0) }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Harga Produk/Jasa</td>
                        <td>{{ $harga->alasan }}</td>
                        <td align="center">{{ number_format($harga->penilaian, 0) }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kemudahan Komunikasi</td>
                        <td>{{ $komunikasi->alasan }}</td>
                        <td align="center">{{ number_format($komunikasi->penilaian, 0) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="center">{{ number_format($totalPenilaian, 0) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Rata-rata</td>
                        <td align="center">{{ number_format($rataRata, 0) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    @endif

</x-app-layout>
