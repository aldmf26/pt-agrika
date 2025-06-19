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
                                <input type="nama" name="nama" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">departemen</label>
                                <input type="text" name="departemen" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Penerima Warehouse Material</label>
                                <input type="penerima_wm" name="example" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Penerima Produksi</label>
                                <input type="penerima_pr" name="example" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">No</th>
                                    <th class="text-center" rowspan="2">Nama Barang</th>
                                    <th class="text-center" colspan="2">Jumlah</th>
                                    <th class="text-center" rowspan="2">Kode Lot SBW</th>
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
                                            <select x-select2 class="select2-alpine" name="id_barang[]"
                                                style="width: 100%;">
                                                <option value="">-- Pilih Item --</option>
                                                @foreach ($labels as $p)
                                                    <option value="{{ $p['kode_lot'] }}">{{ $p['nama_barang'] }} |
                                                        {{ $p['satuan'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div>
                                                    <input x-model="row.pcs" placeholder="pcs" type="number"
                                                        name="diminta_pcs[]" class="form-control text-end" required>
                                                </div>
                                                <div>
                                                    <input x-model="row.gr" placeholder="gr" type="number"
                                                        name="diminta_gr[]" class="form-control text-end" required>
                                                </div>
                                            </div>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div>
                                                    <input readonly x-model="row.pcs" placeholder="pcs" type="number"
                                                        name="diterima_pcs[]" class="form-control text-end" required>
                                                </div>
                                                <div>
                                                    <input readonly x-model="row.gr" placeholder="gr" type="number"
                                                        name="diterima_gr[]" class="form-control text-end" required>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <select x-select2 class="select2-alpine" name="noreg[]"
                                                style="width: 100%;">
                                                <option value="">-- Pilih Item --</option>
                                                {{-- @foreach ($labels as $p)
                                                    @if (!isset($uniqueLabels[$p->noregrbw_nmprodusen]))
                                                        <option value="{{ $p->noregrbw_nmprodusen }}">
                                                            {{ $p->noregrbw_nmprodusen }}</option>
                                                        @php $uniqueLabels[$p->noregrbw_nmprodusen] = true; @endphp
                                                    @endif
                                                @endforeach --}}
                                            </select>
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    addRow() {
                        // Setiap baris baru memiliki pcs dan gr default 0
                        this.rows.push({
                            pcs: 0,
                            gr: 0
                        });
                    }
                }))
            })
        </script>
    @endsection
</x-app-layout>
