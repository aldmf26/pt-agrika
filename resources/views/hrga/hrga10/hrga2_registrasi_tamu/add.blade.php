<x-app-layout :title="$title">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('hrga10.2.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input value="{{ date('Y-m-d') }}" type="date" class="form-control" id="tanggal"
                                name="tanggal" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input placeholder="nama tamu" type="text" class="form-control" id="nama"
                                name="nama" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="suhu">Suhu Badan (<37,3 C)</label>
                                    <input placeholder="suhu badan ?" type="text" class="form-control" id="suhu"
                                        name="suhu" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="masker">Masker</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="masker" id="masker_ya"
                                    value="ya" checked>
                                <label class="form-check-label" for="masker_ya">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="masker" id="masker_tidak"
                                    value="tidak">
                                <label class="form-check-label" for="masker_tidak">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input placeholder="alamat tamu" type="text" class="form-control" id="alamat"
                                name="alamat" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nomor_kendaraan">Nomor Kendaraan</label>
                            <input placeholder="Nomor Kendaraan / DA" type="text" class="form-control"
                                id="nomor_kendaraan" name="nomor_kendaraan" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="keperluan">Keperluan</label>
                            <input placeholder="keperluan ?" type="text" class="form-control" id="keperluan"
                                name="keperluan" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="bertemu_dengan">Bertemu Dengan</label>
                            <input placeholder="bertemu dengan ?" type="text" class="form-control"
                                id="bertemu_dengan" name="bertemu_dengan" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jam_keluar">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div>
                            <label for="">Visitor/ <x-label_ind text="Pengunjung" /></label>
                            <div id="sig" data-signature="#sig" data-clear="#clear" data-sync="#signature64">
                            </div>
                            <button type="button" id="clear" class="btn btn-danger">Clear</button>
                            <textarea id="signature64" name="visitor_signature" style="display: none"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Save</button>
            </form>
</x-app-layout>
