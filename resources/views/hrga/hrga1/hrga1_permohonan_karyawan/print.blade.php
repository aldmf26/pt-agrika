<x-hccp-print :title="$title" :dok="$dok">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12" style="text-transform: capitalize;">
                Bersama ini kami mohon bantuannya untuk menyediakan tenaga kerja dengan kualifikasi sebagai berikut:
            </div>
        </div>
        <div class="row mt-4">

            <div class="col-12">
                <table>
                    <tr>
                        <td>Status Posisi</td>
                        <td>:</td>
                        <td><input type="checkbox" name="" id=""></td>
                        <td width="90%">Karyawan Tetap <input type="checkbox" name="" id="" checked>
                            Karyawan Kontrak</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>

                        <td colspan="2"> &nbsp;{{ $datas->divisi->divisi ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>

                        <td colspan="2"> &nbsp;{{ $datas->jumlah ?? '' }} Orang</td>
                    </tr>
                    <tr>
                        <td width="25%">Alasan Penambahan</td>
                        <td>:</td>

                        <td colspan="2">&nbsp;{{ ucwords($datas->alasan_penambahan) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-decoration: underline; font-weight: bold;">Kualifikasi:</th>
                    </tr>
                    <tr>
                        <td>1. Umur</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;Min {{ $datas->umur }} Tahun</td>
                    </tr>
                    <tr>
                        <td>2. Jenis Kelamin</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ ucwords($datas->jenis_kelamin) }}</td>
                    </tr>
                    <tr>
                        <td>3. Pendidikan</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ ucwords($datas->pendidikan) }}</td>
                    </tr>
                    <tr>
                        <td>4. Pengalaman</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ ucwords($datas->pengalaman) ?? 'Tidak Perlu' }}</td>
                    </tr>
                    <tr>
                        <td>5. Pelatihan</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ ucwords($datas->pelatihan) }}</td>
                    </tr>
                    <tr>
                        <td>6. Mental/Sikap</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ ucwords($datas->mental) }}</td>
                    </tr>
                    <tr>
                        <td width="25%">7. Uraian Kerja</td>
                        <td>:</td>
                        <td colspan="2">
                            &nbsp;{{ ucwords($datas->uraian_kerja) ?? ucwords($datas->divisi->uraian_kerja) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">Tanggal Dibutuhkan &nbsp;</td>
                        <td>:</td>
                        <td colspan="2">&nbsp;{{ tanggal($datas->tgl_dibutuhkan) }}
                            {{-- <span style="margin-left: 20%">Diajukan Oleh:
                                Kepala Divisi</span> --}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{-- <div class="row mt-4">

            <div class="col-12">
                <span style="text-decoration: underline; font-weight: bold;">Kualifikasi:</span>
                <table>
                    <tr>
                        <td>1. Umur</td>
                        <td>:</td>
                        <td>Min {{ $datas->umur }} Tahun</td>
                    </tr>
                    <tr>
                        <td>2. Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->jenis_kelamin) }}</td>
                    </tr>
                    <tr>
                        <td>3. Pendidikan</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->pendidikan) }}</td>
                    </tr>
                    <tr>
                        <td>4. Pengalaman</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->pengalaman) ?? 'Tidak Perlu' }}</td>
                    </tr>
                    <tr>
                        <td>5. Pelatihan</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->pelatihan) }}</td>
                    </tr>
                    <tr>
                        <td>6. Mental/Sikap</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->mental) }}</td>
                    </tr>
                    <tr>
                        <td width="25%">7. Uraian Kerja</td>
                        <td>:</td>
                        <td>{{ ucwords($datas->uraian_kerja) ?? ucwords($datas->divisi->uraian_kerja) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-nowrap">Tanggal Dibutuhkan</td>
                        <td>:</td>
                        <td>{{ tanggal($datas->tgl_dibutuhkan) }}
                            <span style="margin-left: 20%">Diajukan Oleh:
                                Kepala Divisi</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp; <span style="margin-left: 40%">
                                Tanggal :
                                @php

                                    $date = new DateTime($datas->tgl_dibutuhkan);
                                    $date->modify('-14 days');
                                    while ($date->format('w') == 0 || $date->format('w') == 6) {
                                        $date->modify('-1 days');
                                    }
                                    echo tanggal($date->format('Y-m-d'));
                                @endphp
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div> --}}
        <br>
        <br>
        <div class="row mt-4">
            <div class="col-5">
                <span style="font-size: 12px; font-weight: bold; font-style: italic;">Diisi Oleh (KA. HRGA)</span> <br>
                <span style="font-size: 12px;  font-style: italic;">Disetujui /
                    Ditolak*</span> <br>
                <span style="font-size: 12px;  font-style: italic;">* Coret Salah Satu</span>
            </div>
            <div class="col-7">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Diajukan Oleh:</th>
                            <th class="text-center" width="33.33%">Diterima Oleh:</th>
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
                            @php
                                $tgl_pembuatan = date('Y-m-d', strtotime($datas->tgl_dibutuhkan . ' -3 days'));
                                $tgl_diterima = date('Y-m-d', strtotime($datas->tgl_dibutuhkan . ' -2 days'));
                            @endphp

                            <td class="text-center">Tanggal : {{ tanggal($tgl_pembuatan) }}</td>
                            <td class="text-center">Tanggal : {{ tanggal($tgl_diterima) }}</td>

                        </tr>
                        <tr>
                            <td class="text-center">( .......................... ) <br> <span style="font-size: 8px">
                                    Diisi Oleh User</span>
                            </td>
                            <td class="text-center">( KA. HRGA )</td>

                        </tr>
                    </tbody>
                </table>

                {{-- <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr class="head">
                            <th class="" width="33.33%"></th>
                            <th class="" width="33.33%">Diterima Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: none;">
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr style="border-top: none;">
                            <td><em>* Coret salah satu</em></td>
                            <td class="">Tanggal</td>
                        </tr>
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</x-hccp-print>
