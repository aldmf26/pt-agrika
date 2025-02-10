<x-app-layout :title="$title">
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form>
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
                                <input type="text" class="form-control" placeholder="Nama Customer">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat:</label>
                                <textarea class="form-control" rows="2" placeholder="Alamat Customer"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Order No:</label>
                                <input type="text" class="form-control" value="01" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal:</label>
                                <input type="date" class="form-control" value="2025-01-22">
                            </div>
                        </div>
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
                            <tbody x-data="{ rows: [] }">
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <select x-select2 class="select2-alpine" name="produk[]"
                                                style="width: 100%;">
                                                <option value="">-- Pilih Item --</option>
                                                @foreach ($produks as $p)
                                                <option value="{{$p->id}}">{{$p->nama_produk}} | {{$p->satuan}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="100 pack mika / @500gr">
                                        </td>

                                        <td>

                                        </td>
                                        <td>
                                            <select class="form-select">
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
                                <input type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Supir:</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Dibuat oleh</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Disetujui oleh</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pengirim</label>
                                    <div class="border p-3 text-center mb-2" style="height: 100px;">
                                        &nbsp;
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="mb-3">
                        <label class="form-label">Keterangan:</label>
                        <textarea class="form-control" rows="2" placeholder="Tanda terima terlampir"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
