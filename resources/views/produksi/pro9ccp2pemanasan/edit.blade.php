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
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-nowrap" rowspan="2" class="align-middle">Urutan</th>
            <th class="text-nowrap" rowspan="2" class="align-middle">Grade</th>
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
        @php

            $startTime = \Carbon\Carbon::createFromTime(9, 0);

        @endphp
        @foreach ($detailTray as $tray)
            @php

                if ($tray['kelompok'] == '1') {
                    $nama = 'Mangkok/Segitiga/Oval/Sudut';
                    $suhu = '80.4';
                    $menit = 0;
                    $detik = 30;
                } elseif ($tray['kelompok'] == '2') {
                    $nama = 'Patahan';
                    $suhu = '92.6';
                    $menit = 1;
                    $detik = 27;
                } elseif ($tray['kelompok'] == '3') {
                    $nama = 'Kaki';
                    $suhu = '85.1';
                    $menit = 1;
                    $detik = 48;
                } else {
                    $nama = 'Hancuran';
                    $suhu = '92.9';
                    $menit = 0;
                    $detik = 50;
                }

                $trayKe = $tray['urutan'];
                $time = $startTime
                    ->copy()
                    ->addMinutes(15 * ($trayKe - 1))
                    ->format('H:i');

                $isi = DB::table('isi_ccp2')->where('tgl', $tgl)->where('urutan', $trayKe)->first();
            @endphp
            <tr>
                <td>
                    {{ $tray['urutan'] }}
                    <input type="hidden" name="urutan[]" value="{{ $tray['urutan'] }}">
                </td>

                <td>{{ $nama }}</td>
                {{-- <td>Ke-{{ $tray['tray_ke'] }} dari {{ $tray['total_tray_kelompok'] }}</td> --}}
                <td><input type="time" name="waktu_mulai[]"
                        value="{{ empty($isi->waktu_mulai) ? $time : $isi->waktu_mulai }}" class="form-control"></td>
                <td><input type="text" class="form-control" name="tventing_c[]"
                        value="{{ empty($isi->tventing_c) ? 57.1 : $isi->tventing_c }}">
                </td>
                <td><input type="number" class="form-control" name="tventing_menit[]"
                        value="{{ empty($isi->tventing_menit) ? 1 : $isi->tventing_menit }}"></td>
                <td><input type="number" class="form-control" name="tventing_detik[]"
                        value="{{ empty($isi->tventing_detik) ? 3 : $isi->tventing_detik }}"></td>
                <td><input type="text" class="form-control" name="ttot_c[]"
                        value="{{ empty($isi->ttot_c) ? $suhu : $isi->ttot_c }}">


                </td>
                <td><input type="number" class="form-control" name="ttot_menit[]"
                        value="{{ empty($isi->ttot_menit) ? $menit : $isi->ttot_menit }}"></td>
                <td><input type="number" class="form-control" name="ttot_detik[]"
                        value="{{ empty($isi->ttot_detik) ? $detik : $isi->ttot_detik }}"></td>
            </tr>
        @endforeach
    </tbody>
</table>
