<x-app-layout :title="$title">
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form method="post" action="" x-data="{ rows: [] }">
                    @csrf
                    <!-- Header Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>PT. Agrika Gatya Arum</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Telp:</label>
                                        <input readonly value="{{ $profil->telepon }}" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Fax:</label>
                                        <input readonly value="{{ $profil->fax }}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">To:</label>
                                <select class="select2pelanggan" name="id_pelanggan"
                                    onchange="getAlamat($(this).val())">
                                    <option value="">-- Pilih Customer --</option>
                                    @foreach ($pelanggans as $c)
                                        <option value="{{ $c->id }}" data-alamat="{{ $c->alamat }}">
                                            {{ $c->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat:</label>
                                <textarea name="alamat" class="form-control" rows="2" id="alamat" readonly></textarea>
                            </div>
                            <script>
                                function getAlamat(id) {
                                    $('#alamat').val($('select[name=id_pelanggan] option:selected').data('alamat'));
                                }
                            </script>
                        </div>
                        <div class="col-md-6" x-data="orderForm()">
                            <div class="mb-3">
                                <label class="form-label">Order No:</label>
                                <input name="no_order" type="text" x-model="no_order" class="form-control"
                                    value="{{ $no_order }}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label class="form-label">Tanggal Kirim:</label>
                                        <input name="tgl" type="date" class="form-control" x-model="tgl"
                                            @change="updateNoOrder()" value="{{ date('Y-m-d') }}">
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="">
                                        <label class="form-label">ETD:</label>
                                        <input required
                                            value="{{ date('Y-m-d', strtotime(date('Y-m-d') . ' +2 days')) }}"
                                            name="tgl_etd" type="date" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <script>
                            function orderForm() {
                                return {
                                    tgl: '{{ date('Y-m-d') }}',
                                    no_order: '',

                                    updateNoOrder() {
                                        if (!this.tgl) return;

                                        const date = new Date(this.tgl);
                                        const bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
                                        const month = bulanRomawi[date.getMonth()];
                                        const year = String(date.getFullYear()); // ambil 3 digit terakhir (misal 2025 => 025)

                                        // Bisa diganti dengan no urut real dari backend, di sini contoh pakai 02 saja
                                        const urutan = "{{ $no_order }}";

                                        this.no_order = `${urutan}/${month}/${year}`;
                                    },

                                    init() {
                                        this.updateNoOrder();
                                    }
                                }
                            }
                        </script>

                    </div>

                    <!-- Item Table -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item & Kode</th>
                                    <th>Jumlah</th>
                                    <th>Catatan</th>
                                    <th>CoA*</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <select x-select2 class="select2-alpine" name="produk[]"
                                                style="width: 100%;">
                                                <option value="">-- Pilih Item --</option>
                                                @foreach ($produks as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama_produk }} |
                                                        {{ $p->satuan }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input onclick="this.select();" type="text" class="form-control text-end"
                                                name="jumlah[]" value="100">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="catatan"
                                                name="catatan[]">
                                        </td>
                                        <td>
                                            <select name="perlu_coa[]" class="form-select">
                                                <option value="Y">Y</option>
                                                <option value="T">T</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button @click="rows.splice(rows.indexOf(row), 1)"
                                                class="btn btn-sm btn-danger" type="button"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </template>
                                <tr>
                                    <td @click="rows.push('')" colspan="6"><button
                                            class="btn-block btn btn-sm btn-primary" type="button"><i
                                                class="fas fa-plus"></i> Baris</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">* Disertai CoA Ya (Y) atau Tidak (T)</small>
                    </div>

                    <!-- Vehicle and Signatures Section -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No Kendaraan:</label>
                                <input name="no_kendaraan" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Supir:</label>
                                <input name="supir" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Dibuat oleh</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input readonly value="{{ auth()->user()->name }}" name="dibuat_oleh"
                                        type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Disetujui oleh</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input name="disetujui_oleh" type="text" class="form-control"
                                        placeholder="Nama">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pengirim</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input name="pengirim" type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mb-3">
                        <label class="form-label">Keterangan:</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Tanda terima terlampir"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" :disabled="rows.length == 0">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {

                $('.select2pelanggan').select2({})
            });
        </script>
    @endsection
</x-app-layout>
