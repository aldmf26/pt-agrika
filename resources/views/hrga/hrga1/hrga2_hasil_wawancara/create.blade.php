<x-app-layout :title="$title">
    <form action="#" method="post">
        @csrf
        <div class="row">
            <input type="hidden" name="status" value="kontrak">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input required type="text" name="nama_lengkap" placeholder="Contoh: Rizky Ramadhan"
                        class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">No KTP</label>
                    <input required type="text" name="nik" placeholder="Contoh: NIK jika tidak ada No KK"
                        class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required class="select22" id="">
                        <option value="">Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Tgl Lahir</label>
                    <input required type="date" name="tgl_lahir" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Tgl Masuk</label>
                    <input required type="date" id="tgl_masuk" value="{{ date('Y-m-d') }}" name="tgl_masuk"
                        class="form-control">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Pendidikan</label>
                    <input placeholder="Contoh: SMA" required type="text" name="pendidikan" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Divisi</label>
                    <select name="id_divisi" id="" class="select22">
                        <option value="">Posisi</option>
                        @foreach ($divisi as $d)
                            <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Posisi</label>
                    <input required type="text" name="posisi" class="form-control">
                </div>
            </div>


            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Kesimpulan Hasil Wawancara : </label>
                    <textarea name="kesimpulan" class="form-control text_akhir" id="" cols="15" rows="3"
                        style="text-align: left;">{{ $cth_wawancara->wawancara }}</textarea>

                    <input type="hidden"class="text_awal" name="cth_wawancara" value="{{ $cth_wawancara->wawancara }}">

                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <label for="">Periode Masa Percobaan :</label>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="1bulan" checked value="1">
                    <label class="form-check-label" for="1bulan">1 bulan</label>
                </div>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="3bulan" value="3">
                    <label class="form-check-label" for="3bulan">3 bulan</label>
                </div>
                <div class="form-check ms-2">
                    <input class="form-check-input" type="radio" name="periode" id="6bulan" value="6">
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
                                    value="{{ $cth2->pendidikan_standar }}">
                            </td>
                            <td><input type="text" name="pendidikan_hasil" class="form-control"
                                    value="{{ $cth2->pendidikan_hasil }}">
                            </td>

                        </tr>
                        <tr>
                            <td>Pengalaman</td>
                            <td><input type="text" name="pengalaman_standar" class="form-control"
                                    value="{{ $cth2->pengalaman_standar }}">
                            </td>
                            <td><input type="text" name="pengalaman_hasil" class="form-control"
                                    value="{{ $cth2->pengalaman_hasil }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Pelatihan</td>
                            <td><input type="text" name="pelatihan_standar" class="form-control"
                                    value="{{ $cth2->pelatihan_standar }}">
                            </td>
                            <td><input type="text" name="pelatihan_hasil" class="form-control"
                                    value="{{ $cth2->pelatihan_hasil }}">
                            </td>
                        </tr>
                        <tr>
                            <td>Keterampilan</td>
                            <td><input type="text" name="keterampilan_standar" class="form-control"
                                    value="{{ $cth2->keterampilan_standar }}"></td>
                            <td><input type="text" name="keterampilan_hasil" class="form-control"
                                    value="{{ $cth2->keterampilan_hasil }}"></td>
                        </tr>
                        <tr>
                            <td>Kompetensi Inti</td>
                            <td>
                                <textarea name="kompetensi_inti_standar" class="form-control" id="" cols="30" rows="4"
                                    style="text-align: left">{{ $cth2->kompetensi_inti_standar }}</textarea>
                            </td>
                            <td>
                                <textarea name="kompetensi_inti_hasil" class="form-control" id="" cols="30" rows="4"
                                    style="text-align: left">{{ $cth2->kompetensi_inti_hasil }}</textarea>
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
