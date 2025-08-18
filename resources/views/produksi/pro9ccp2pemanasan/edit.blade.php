<div class="row">
    <div class="col-lg-12">
        <h6>Cpp2 Pemanasan Tanggal : {{ tanggal($tgl) }}</h6>
    </div>
    <div class="col-lg-4">
        <input type="hidden" name="tgl" value="{{ $tgl }}">
        <label for="">Suhu sarang walet awal °C</label>
        <input type="text" class="form-control" name="suhu_sbw_awal" value="{{ $header->suhu_sbw_awal ?? '23.6' }}">
    </div>
    <div class="col-lg-4">
        <label for="">Suhu ruang °C</label>
        <input type="text" class="form-control" name="suhu_ruang" value="{{ $header->suhu_ruang ?? '28.6' }}">
    </div>
    <div class="col-lg-12">
        <hr>
    </div>
    <div class="col-lg-12">
        <h5>Detail</h5>
    </div>

</div>
<table width="100%" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-nowrap" rowspan="2" class="align-middle">Urutan</th>
            <th class="text-nowrap" rowspan="2" class="align-middle">Waktu mulai steam</th>
            <th class="text-nowrap" rowspan="2" class="align-middle">T<sub>venting</sub> (°C)</th>
            <th class="text-nowrap" colspan="2">T<sub>venting</sub> (mnt)</th>
            <th class="text-nowrap" rowspan="2" class="align-middle">T<sub>tot</sub> (°C)</th>
            <th class="text-nowrap" colspan="2">T<sub>tot</sub> (mnt)</th>
        </tr>
        <tr>
            <th>Menit</th>
            <th>Detik</th>
            <th>Menit</th>
            <th>Detik</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < $totalUrutan; $i++)
            @php
                $isi = DB::table('isi_ccp2')
                    ->where('tgl', $tgl)
                    ->where('urutan', $i + 1)
                    ->first();
            @endphp
            <tr>
                <td>{{ $i + 1 }}
                    <input type="hidden" name="urutan[]" value="{{ $i + 1 }}">
                </td>
                <td><input type="time" class="form-control" name="waktu_mulai[]"
                        value="{{ empty($isi->waktu_mulai) ? '09:00' : $isi->waktu_mulai }}"></td>
                <td><input type="text" class="form-control" name="tventing_c[]"
                        value="{{ empty($isi->tventing) ? 60.5 : $isi->tventing }}">
                </td>
                <td><input type="number" class="form-control" name="tventing_menit[]"
                        value="{{ empty($isi->tventing_menit) ? 1 : $isi->tventing_menit }}"></td>
                <td><input type="number" class="form-control" name="tventing_detik[]"
                        value="{{ empty($isi->tventing_detik) ? 3 : $isi->tventing_detik }}"></td>
                <td><input type="text" class="form-control" name="ttot_c[]"
                        value="{{ empty($isi->ttot) ? 80.4 : $isi->ttot }}"></td>
                <td><input type="number" class="form-control" name="ttot_menit[]"
                        value="{{ empty($isi->ttot_menit) ? 0 : $isi->ttot_menit }}"></td>
                <td><input type="number" class="form-control" name="ttot_detik[]"
                        value="{{ empty($isi->ttot_detik) ? 35 : $isi->ttot_detik }}"></td>
            </tr>
        @endfor
    </tbody>

</table>
{{-- @for ($i = 0; $i < $totalUrutan; $i++)
    <div class="row">
        <div class="col-lg-2 mb-2">
            <label for="">Waktu mulai steam</label>
            <input type="hidden" name="urutan">
            <input type="time" class="form-control" name="waktu_mulai_steam">
        </div>
        <div class="col-lg-2 mb-2">
            <label for="">T<sub>venting</sub> (°C)</label>
            <input type="text" class="form-control" name="waktu_mulai_steam">
        </div>

        <div class="col-lg-3 mb-2">
            <label for="" class="text-center">T<sub>venting</sub> (mnt)</label>
            <table>
                <tr>
                    <td class="text-nowrap">Menit : </td>
                    <td><input type="number" class="form-control"></td>
                    <td class="text-nowrap">Detik : </td>
                    <td><input type="number" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-1 mb-2">
            <label for="">T<sub>tot</sub> (°C)</label>
            <input type="text" class="form-control" name="waktu_mulai_steam">
        </div>
        <div class="col-lg-3 mb-2">
            <label for="" class="text-center">T<sub>tot</sub> (mnt)</label>
            <table>
                <tr>
                    <td class="text-nowrap">Menit : </td>
                    <td><input type="number" class="form-control"></td>
                    <td class="text-nowrap">Detik : </td>
                    <td><input type="number" class="form-control"></td>
                </tr>
            </table>
        </div>
    </div>
@endfor --}}
