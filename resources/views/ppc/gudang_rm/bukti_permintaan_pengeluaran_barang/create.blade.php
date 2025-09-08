<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" value="{{ date('Y-m-d') }}" name="tgl" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Nama Pemohon</label>
                                <select name="nama" id="" class="select2pemohon pemohon">
                                    <option value="">-- Pilih Pemohon --</option>
                                    @foreach ($user as $p)
                                        <option data-departemen="{{ $p->divisi->divisi }}" value="{{ $p->nama }}">
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">departemen</label>
                                <input type="text" readonly name="departemen" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Penerima Warehouse Material</label>
                                <select name="penerima_wm" id="" class="select2pemohon">
                                    <option value="">-- Pilih Pemohon --</option>
                                    @foreach ($user as $p)
                                        <option data-departemen="{{ $p->divisi->divisi }}" value="{{ $p->nama }}">
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for=""><br>&nbsp;Penerima Produksi </label>
                                <select name="penerima_pr" id="" class="select2pemohon">
                                    <option value="">-- Pilih Pemohon --</option>
                                    @foreach ($user as $p)
                                        <option data-departemen="{{ $p->divisi->divisi }}" value="{{ $p->nama }}">
                                            {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">No</th>
                                    <th class="text-center" rowspan="2" width="30%">Nama Barang</th>
                                    <th class="text-center" rowspan="2">Sisa Stok</th>
                                    <th class="text-center" colspan="2">Jumlah</th>
                                    <th class="text-center" rowspan="2" width="20%">Kode Lot SBW</th>
                                    <th class="text-center" rowspan="2">Status Ok/Tidak Ok</th>
                                    <th class="text-center" rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Diminta Pcs/Gr</th>
                                    <th class="text-center">Diterima Pcs/Gr</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(row, index) in rows">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <select x-ref="selectEl" class="form-control"
                                                :name="'id_barang[' + index + ']'" x-init="$nextTick(() => {
                                                    $($refs.selectEl).select2();
                                                    $($refs.selectEl).on('change', function(e) {
                                                        updateKodeLot(index, e.target.value);
                                                    });
                                                })">
                                                <option value="">-- Pilih Item --</option>
                                                @foreach ($labels as $p)
                                                    <option value="{{ $p['kode_lot'] }}">{{ $p['nama_barang'] }} |
                                                        {{ $p['satuan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" x-model="row.stok_akhir" name="sisa_stok[]"
                                                class="form-control text-end" readonly>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div>
                                                    <input min="0" @focus="$el.select()" x-model="row.pcs"
                                                        placeholder="pcs" type="number" name="diminta_pcs[]"
                                                        class="form-control text-end" required>
                                                </div>
                                            </div>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div>
                                                    <input min="0" readonly x-model="row.pcs"
                                                        @focus="$el.select()" placeholder="pcs" type="number"
                                                        name="diterima_pcs[]" class="form-control text-end" required>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <input readonly type="text" name="kode_lot[]" x-model="row.kode_lot"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <select name="status[]" class="form-control" id="">
                                                <option value="OK">OK</option>
                                                <option value="TIDAK OK">TIDAK OK</option>
                                            </select>
                                        </td>
                                        </td>
                                        <td>
                                            <span @click="rows.splice(index, 1)" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i></span>
                                        </td>
                                    </tr>
                                </template>
                                <tr>
                                    <td colspan="8">
                                        <button type="button" @click="addRow"
                                            class="btn-block btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                                            Tambah
                                            Baris Data</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select2pemohon').select2();

                    $('.pemohon').on('change', function() {
                        var departemen = $(this).find(':selected').data('departemen');
                        $('input[name="departemen"]').val(departemen);
                    });
                }, 100);
            });
            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    labels: @json($labels), // Data barang dari PHP
                    addRow() {

                        this.rows.push({
                            pcs: 0,
                            gr: 0,
                            kode_lot: '',
                            id_barang: '',
                            stok_akhir: 0
                        });
                    },
                    updateKodeLot(index, kodeLot) {
                        const item = this.labels.find(i => i.kode_lot === kodeLot);
                        if (item) {
                            this.rows[index].kode_lot = item.kode_lot;
                            this.rows[index].stok_akhir = item.stok_akhir;
                        }
                    }
                }));
            });
        </script>
    @endsection
</x-app-layout>
