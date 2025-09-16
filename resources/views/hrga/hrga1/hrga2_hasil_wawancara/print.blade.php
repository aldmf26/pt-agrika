<x-hccp-print :title="$title" :dok="$dok">

    <div class="row">
        {{-- <div class="col-1"></div> --}}
        <div class="col-12">
            <table>
                <tr>
                    <td>Nama Calon Karyawan &nbsp;</td>
                    <td>:</td>
                    <td>&nbsp; {{ ucwords($pegawai->nama) }}</td>
                </tr>
                <tr>
                    <td>No KTP &nbsp;</td>
                    <td>:</td>
                    <td>&nbsp; {{ $pegawai->nik }}</td>
                </tr>
                <tr>
                    <td>Usia &nbsp;</td>
                    <td>:</td>
                    <td>&nbsp; {{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin &nbsp;</td>
                    <td>:</td>
                    <td>&nbsp; {{ ucwords($pegawai->jenis_kelamin) }}</td>
                </tr>
                <tr>
                    <td>Posisi &nbsp;</td>
                    <td>:</td>
                    <td>&nbsp; {{ ucfirst(strtolower($pegawai->posisi)) ?? 'Staff cabut' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        {{-- <div class="col-1"></div> --}}
        <div class="col-12">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <thead>
                    <tr class="head">
                        <th class="" width="33.33%">Tanggal Wawancara: {{ tanggal($pegawai->tgl_masuk) }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px">
                            Kesimpulan:
                            <br>
                            @if ($pegawai->hasilWawancara)
                                {{-- {{ ucwords($pegawai->hasilWawancara->kesimpulan) ?? '' }} --}}
                                {!! nl2br(e($pegawai->hasilWawancara->kesimpulan ?? '-')) !!}
                            @else
                                {{-- - Ybs memahami cara kerja {{ $pegawai->posisi }}
                                <br> --}}
                                @if ($pegawai->posisi == 'Staf Cabut')
                                    {!! nl2br(e($cth_wawancara->wawancara ?? '-')) !!}
                                @endif
                                {{-- - Ybs Tidak neko-neko, Terlihat teliti dan tidak mudah bosan --}}
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>



        </div>
        <div class="col-4">
            <span>Keputusan : </span>

        </div>
        <div class="col-4">
            <span><input type="checkbox" name="" id="" checked> Dilanjutkan </span>

        </div>
        <div class="col-4"><input type="checkbox" name="" id=""> Ditolak</div>
        <div class="col-12">
            &nbsp;
        </div>
        <div class="col-4"><span>Pewawancara : </span></div>
        <div class="col-8">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Pewawancara 1 :</th>
                        <th class="text-center" width="33.33%">Pewawancara 2 :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)
                        </td>
                        <td class="text-center">( KA. HRGA )</td>

                    </tr>
                </tbody>
            </table>
        </div>

        {{-- <table>
            <tr>
                <td>Keputusan: </td>
                <td width="10%">&nbsp;</td>
                <td>⬛Dilanjutkan</td>
                <td width="10%">&nbsp;</td>
                <td>⬜Ditolak</td>
            </tr>
            <tr colspan="5">
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td>Pewawancara: </td>
                <td width="20%">&nbsp;</td>
                <td class="text-center">Nama</td>
                <td width="40%">&nbsp;</td>
                <td class="text-center">Paraf</td>
            </tr>
            <tr colspan="5">
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp; </td>
                <td width="20%">&nbsp;</td>
                <td class="text-center">Widani</td>
                <td width="40%">&nbsp;</td>
                <td class="text-center">................</td>
            </tr>
        </table> --}}
    </div>

</x-hccp-print>
