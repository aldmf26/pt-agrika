<x-app-layout :title="$title">
    <form action="{{ route('hrga1.1.update', $permohonan) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group d-flex gap-2">
                    <label for="">Status Posisi : </label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_posisi" value="Tetap"
                                id="tetap" required {{ $permohonan->status_posisi == 'Tetap' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tetap">Karyawan Tetap</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_posisi" value="Kontrak"
                                id="kontrak" required {{ $permohonan->status_posisi == 'Kontrak' ? 'checked' : '' }}>
                            <label class="form-check-label" for="kontrak">Karyawan Kontrak</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Divisi</label>
                    <select name="divisi" id="" class="form-select" required>
                        <option value="">Pilih Divisi</option>
                        @foreach ($divisis as $divisi)
                            <option value="{{ $divisi->id }}" @selected($divisi->id == $permohonan->id_divisi)>
                                {{ $divisi->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input value="{{ $permohonan->jumlah }}" type="number" name="jumlah" class="form-control"
                        required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Alasan Penambahan</label>
                    <input value="{{ $permohonan->alasan_penambahan }}" type="text" name="alasan_penambahan"
                        class="form-control" required>
                </div>
            </div>
        </div>

        <span style="text-decoration: underline;"><b>Kualifikasi</b></span>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Umur</label>
                    <input value="{{ $permohonan->umur }}" type="number" name="umur" class="form-control" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <input value="{{ $permohonan->jenis_kelamin }}" type="text" name="jenis_kelamin"
                        class="form-control" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <input value="{{ $permohonan->pendidikan }}" type="text" name="pendidikan" class="form-control"
                        required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Pengalaman</label>
                    <input value="{{ $permohonan->pengalaman }}" type="text" name="pengalaman" class="form-control"
                        required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Pelatihan</label>
                    <input value="{{ $permohonan->pelatihan }}" type="text" name="pelatihan" class="form-control"
                        required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Mental / Sikap</label>
                    <input value="{{ $permohonan->mental }}" type="text" name="mental" class="form-control"
                        required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Uraian Kerja</label>
                    <input value="{{ $permohonan->uraian_kerja }}" type="text" name="uraian_kerja"
                        class="form-control" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Tanggal Dibutuhkan</label>
                    <input type="date" required name="tgl_dibutuhkan" class="form-control"
                        value="{{ $permohonan->tgl_dibutuhkan }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Diajukan Oleh</label>
                    <input type="text" value="{{ $permohonan->diajukan_oleh }}" required name="diajukan_oleh"
                        class="form-control">
                </div>
            </div>
        </div>
        <a class="btn btn-md btn-info" href="{{ route('hrga1.1.index') }}">Cancel</a>
        <button class="btn btn-md float-end btn-primary" type="submit">Save</button>
    </form>
</x-app-layout>
