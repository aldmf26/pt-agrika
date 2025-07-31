<x-hccp-print :title="$title" :dok="$dok">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-11">
                Bersama ini kami mohon bantuannya untuk menyediakan tenaga kerja dengan kualifikasi sebagai berikut:
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-11">
                <table>
                    <tr>
                        <td>Status Posisi</td>
                        <td>:</td>
                        <td>⬜</td>
                        <td width="90%">Karyawan Tetap ⬛ Karyawan Kontrak</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td></td>
                        <td>{{ $datas->divisi->divisi ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td></td>
                        <td>{{ $datas->jumlah ?? '' }} Orang</td>
                    </tr>
                    <tr>
                        <td width="25%">Alasan Penambahan</td>
                        <td>:</td>
                        <td></td>
                        <td>Adanya penambahan kapasitas aktivitas {{ $datas->divisi->divisi ?? '' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-11">
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
                        <td>{{ $datas->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>3. Pendidikan</td>
                        <td>:</td>
                        <td>{{ $datas->pendidikan }}</td>
                    </tr>
                    <tr>
                        <td>4. Pengalaman</td>
                        <td>:</td>
                        <td>{{ $datas->pengalaman }}</td>
                    </tr>
                    <tr>
                        <td>5. Pelatihan</td>
                        <td>:</td>
                        <td>{{ $datas->pelatihan }}</td>
                    </tr>
                    <tr>
                        <td>6. Mental/Sikap</td>
                        <td>:</td>
                        <td>{{ $datas->mental }}</td>
                    </tr>
                    <tr>
                        <td width="25%">7. Uraian Kerja</td>
                        <td>:</td>
                        <td>{{ $datas->uraian_kerja }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Tanggal Dibutuhkan</td>
                        <td>:</td>
                        <td>{{ tanggal($datas->tgl_dibutuhkan) }} <span style="margin-left: 20%">Diajukan Oleh:
                                {{ $datas->admin }}</span></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp; <span style="margin-left: 40%">Tanggal :{{ tanggal($datas->tgl_input) }}</span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-11">
                <span style="font-size: 12px; font-weight: bold; font-style: italic;">Diisi oleh HRD</span>

                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr class="head">
                            <th class="" width="33.33%">Disetujui/ Ditangguhkan/ Ditolak*</th>
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
                </table>
            </div>
        </div>
    </div>
</x-hccp-print>
