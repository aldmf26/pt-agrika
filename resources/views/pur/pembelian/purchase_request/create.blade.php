<x-app-layout :title="$title">
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="kategori" class="form-control kategori">
                        <option selected value="barang" selected>Barang</option>
                        <option value="kemasan">Kemasan</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Diminta Oleh</label>
                    <input type="text" name="diminta_oleh" placeholder="diminta oleh" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Posisi</label>
                    <input type="text" name="posisi" placeholder="posisi" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">No Pr</label>
                    <input type="text" readonly value="{{ $no_pr }}" name="no_pr" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tgl" value="{{ date('Y-m-d') }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="manajer_departemen" placeholder="manajer departemen" class="form-control"
                value="0">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Alasan Permintaan</label>
                    <textarea name="alasan_permintaan" placeholder="alasan permintaan" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-6" x-data="{ rows: ['1'] }">
                <label for="">Detail Permintaan</label>
                <table class="table table-bordered">
                    <thead class="bg-info">
                        <tr>
                            <th class="text-white text-center" width="80">Jumlah</th>
                            <th class="text-white text-center">Item dan Spesifikasi</th>
                            <th class="text-white text-center">Tanggal dibutuhkan</th>
                            <th class="text-white text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(row, index) in rows" :key="index">
                            <tr>
                                <td>
                                    <input required autocomplete="off" type="text" inputmode="numeric"
                                        name="jumlah[]" class="form-control form-control-sm" />
                                </td>
                                <td>
                                    <select name="item_spesifikasi[]" class="select2" id="">
                                        <option value="">Pilih Item</option>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->nama_barang }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="tgl_dibutuhkan[]"
                                        class="form-control form-control-sm" />
                                </td>
                                <td>
                                    <span @click="rows.splice(index, 1); $nextTick(() => initSelect2())"
                                        class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></span>
                                </td>
                            </tr>
                        </template>
                        <tr>
                            <td colspan="4">
                                <button type="button" class="btn btn-xs btn-info text-white btn-block"
                                    @click="rows.push(''); $nextTick(() => initSelect2())"><i class="fas fa-plus"></i>
                                    Baris</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-primary float-end">Simpan</button>
    </form>

    @section('scripts')
        <script>
            function initSelect2() {
                $('.select2').select2();
            }

            $(document).ready(function() {
                initSelect2();

                $('.kategori').change(function() {
                    var kategori = $(this).val();
                    var url = new URL(window.location.href);
                    url.searchParams.set('kategori', kategori);
                    window.location.href = url.href;
                });
            });
        </script>
    @endsection
</x-app-layout>
