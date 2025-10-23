<div class="row">

    <div class="col-lg-3">
        <label for="">Tanggal</label>
        <input type="date" class="form-control" name="tanggal" id="tgl" value="{{ $program->tgl_rencana }}">
        <input type="hidden" name="Getid" id="Getid">
    </div>
    <div class="col-lg-2">
        <label for="">Pengusul</label>
        <input type="text" class="form-control" name="pengusul" value="{{ $usulan->pengusul }}">
    </div>
    <div class="col-lg-4">
        <label for="">Usulan jenis pelatihan</label>
        <input type="text" class="form-control" name="usulan_jenis_pelatihan" id="usulan" readonly
            value="{{ $usulan->usulan_jenis_pelatihan }}">
    </div>
    <div class="col-lg-3">
        <label for="">Tempat</label>
        <input type="text" class="form-control" name="tempat" id="tempat">
    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Usulan waktu mulai</label>
        <input type="time" class="form-control" name="usulan_waktu">
    </div>
    <div class="col-lg-3 mt-2">
        <label for="">Usulan waktu selesai</label>
        <input type="time" class="form-control" name="usulan_waktu_selesai">
    </div>
    <div class="col-lg-6 m-2">
        <label for="">Alasan</label>
        <input type="text" class="form-control" name="alasan">
    </div>
    <div class="col-lg-4 m-2">
        <label for="">Tujuan Pelatihan</label>
        <input type="text" class="form-control" name="tujuan_pelatihan">
    </div>

    <div class="col-lg-12">
        <hr>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="mb-3">
                <input type="text" id="searchKaryawan" class="form-control"
                    placeholder="Cari nama, divisi, atau jabatan..." style="max-width: 300px;">
            </div>
            <table class="table table-bordered" id="tableKaryawan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $k)
                        @php
                            $pegawai = DB::table('usulan_dan_identifikasis')
                                ->where('nota_pelatihan', $nota_pelatihan)
                                ->where('data_pegawais_id', $k->karyawan_id_dari_api)
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }} </td>
                            <td>

                                {{ $k->nama }}
                            </td>
                            <td>{{ $k->divisi->divisi ?? '-' }}</td>
                            <td>{{ $k->posisi }}</td>
                            <td class="text-center">
                                <input type="checkbox" class="check_item" name="id_pegawai[]"
                                    value="{{ $k->karyawan_id_dari_api }}" id=""
                                    {{ $pegawai ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>



            </table>
        </div>



    </div>

</div>
