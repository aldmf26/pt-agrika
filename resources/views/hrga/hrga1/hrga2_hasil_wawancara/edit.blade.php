<x-app-layout :title="$title">
    <form action="{{ route('hrga1.2.update', $pegawai) }}" method="post">
        @csrf
        <div class="row">
            <input type="hidden" name="status" value="kontrak">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input required type="text" name="nama_lengkap" value="{{ $pegawai->nama }}" class="form-control">
                    <input type="hidden" name="id_karyawan_dari_api" value="{{ $pegawai->id_karyawan_dari_api }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">No KTP</label>
                    <input required type="text" name="nik" value="{{ $pegawai->nik }}" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required class="select22">
                        <option value="">Jenis Kelamin</option>
                        <option value="L" @selected(in_array($pegawai->jenis_kelamin, ['L', 'laki-laki', 'Laki-laki', 'LAKI-LAKI']))>Laki-laki
                        </option>
                        <option value="P" @selected(in_array($pegawai->jenis_kelamin, ['P', 'perempuan', 'Perempuan', 'PEREMPUAN']))>Perempuan
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Tgl Lahir</label>
                    <input required type="date" name="tgl_lahir" value="{{ $pegawai->tgl_lahir }}"
                        class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Tgl Masuk</label>
                    <input required type="date" id="tgl_masuk" value="{{ $pegawai->tgl_masuk }}" name="tgl_masuk"
                        class="form-control">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <input placeholder="Contoh: SMA" required type="text" name="pendidikan"
                        value="{{ $pegawai->pendidikan }}" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Divisi</label>
                    <select name="id_divisi" class="select22">
                        <option value="">Posisi</option>
                        @foreach ($divisi as $d)
                            <option value="{{ $d->id }}" @selected($d->id == $pegawai->divisi_id)>{{ $d->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Posisi</label>
                    <input required type="text" name="posisi" value="{{ $pegawai->posisi }}" class="form-control">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Kesimpulan Hasil Wawancara : </label>
                    <textarea name="kesimpulan" class="form-control text_akhir" id="" cols="15" rows="3"
                        style="text-align: left;">{{ $pegawai->hasilWawancara->kesimpulan }}</textarea>
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <label for="">Periode Masa Percobaan :</label>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="1bulan" value="1"
                        {{ $pegawai->penilaianKaryawan->periode == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="1bulan">1 bulan</label>
                </div>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="3bulan" value="3"
                        {{ $pegawai->penilaianKaryawan->periode == 3 ? 'checked' : '' }}>
                    <label class="form-check-label" for="3bulan">3 bulan</label>
                </div>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="6bulan" value="6"
                        {{ $pegawai->penilaianKaryawan->periode == 6 ? 'checked' : '' }}>
                    <label class="form-check-label" for="6bulan">6 bulan</label>
                </div>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">PENILAIAN KARYAWAN</th>
                        </tr>
                        <tr>
                            <th>Kriteria Penilaian</th>
                            <th>Standar Penilaian</th>
                            <th>Hasil Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pendidikan</td>
                            <td><input type="text" name="pendidikan_standar" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pendidikan_standar }}"></td>
                            <td><input type="text" name="pendidikan_hasil" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pendidikan_hasil }}"></td>
                        </tr>
                        <tr>
                            <td>Pengalaman</td>
                            <td><input type="text" name="pengalaman_standar" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pengalaman_standar }}"></td>
                            <td><input type="text" name="pengalaman_hasil" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pengalaman_hasil }}"></td>
                        </tr>
                        <tr>
                            <td>Pelatihan</td>
                            <td><input type="text" name="pelatihan_standar" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pelatihan_standar }}"></td>
                            <td><input type="text" name="pelatihan_hasil" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->pelatihan_hasil }}"></td>
                        </tr>
                        <tr>
                            <td>Keterampilan</td>
                            <td><input type="text" name="keterampilan_standar" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->keterampilan_standar }}"></td>
                            <td><input type="text" name="keterampilan_hasil" class="form-control"
                                    value="{{ $pegawai->penilaianKaryawan->keterampilan_hasil }}"></td>
                        </tr>
                        <tr>
                            <td>Kompetensi Inti</td>
                            <td>
                                <textarea name="kompetensi_inti_standar" class="form-control" id="" cols="30" rows="4"
                                    style="text-align: left">{{ $pegawai->penilaianKaryawan->kompetensi_inti_standar }}</textarea>
                            </td>
                            <td>
                                <textarea name="kompetensi_inti_hasil" class="form-control" id="" cols="30" rows="4"
                                    style="text-align: left">{{ $pegawai->penilaianKaryawan->kompetensi_inti_hasil }}</textarea>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select22').select2();
                }, 100); // Delay to ensure DOM is fully ready
            });
        </script>
    @endsection
</x-app-layout>
