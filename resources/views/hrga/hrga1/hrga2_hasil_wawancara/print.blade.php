<x-hccp-print :title="$title" :dok="$dok">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-11">
            <table>
                <tr>
                    <td>Nama Calon Karyawan</td>
                    <td>:</td>
                    <td>{{ $pegawai->nama }}</td>
                </tr>
                <tr>
                    <td>No KTP</td>
                    <td>:</td>
                    <td>{{ $pegawai->nik }}</td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($pegawai->tgl_lahir)->age }} Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Posisi</td>
                    <td>:</td>
                    <td>{{ $pegawai->posisi ?? 'Staff cabut' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-11">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <thead>
                    <tr class="head">
                        <th class="" width="33.33%">Tanggal Wawancara Tahap I:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px">
                            Kesimpulan:
                            <br>
                            @if ($pegawai->hasilWawancara)
                                {{ $pegawai->hasilWawancara->kesimpulan ?? '' }}
                            @else
                                {{-- - Ybs memahami cara kerja {{ $pegawai->posisi }}
                                <br> --}}
                                @if ($pegawai->posisi == 'Staf Cabut')
                                    {{ $cth_wawancara->wawancara }}
                                    <br>
                                @endif
                                {{-- - Ybs Tidak neko-neko, Terlihat teliti dan tidak mudah bosan --}}
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>

            <table>
                <tr>
                    <td>Keputusan: </td>
                    <td width="20%">&nbsp;</td>
                    <td>⬛Dilanjutkan</td>
                    <td width="30%">&nbsp;</td>
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
            </table>
        </div>
    </div>

</x-hccp-print>
