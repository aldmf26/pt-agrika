<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-12">
            <table class="table border-dark" style="font-size: 12px">
                <tr>
                    <th colspan="4">Dokumen Yang Diusulkan :</th>
                </tr>
                <tr>
                    <td width="25%">Nama Dokumen</td>
                    <td width="40%" colspan="4">: {{ $dokumen->judul }}</td>

                </tr>
                <tr>
                    <td width="25%">No Dokumen</td>
                    <td width="40%">: {{ $dokumen->no_dokumen }}</td>
                    <td>Tanggal Terbit</td>
                    <td>: {{ tanggal($dokumen->tgl_terbit) }}</td>
                </tr>
                <tr>
                    <td width="25%">No Revisi</td>
                    <td width="40%">: {{ $dokumen->detail == 'perubahan' ? '00' : '01' }}</td>
                    <td>Divisi</td>
                    <td>: {{ $dokumen->nama_divisi }}</td>
                </tr>
                <tr>
                    <th colspan="4">Dokumen Sebelumnya (Bila Ada) :</th>
                </tr>
                @if ($dokumen->detail == 'perubahan')
                    <tr>
                        <td width="25%">Nama Dokumen</td>
                        <td width="40%">: {{ $dokumen->judul }}</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td width="25%">No Dokumen</td>
                        <td width="40%">: {{ $dokumen->no_dokumen }}</td>
                        <td>Tanggal Terbit</td>
                        <td>: {{ tanggal($dokumen->tgl_terbit) }}</td>
                    </tr>
                    <tr>
                        <td width="25%">No Revisi</td>
                        <td width="40%">: {{ $dokumen->detail == 'perubahan' ? '00' : '01' }}</td>
                        <td>Divisi</td>
                        <td>: {{ $dokumen->nama_divisi }}</td>
                    </tr>
                @else
                    <tr>
                        <td width="25%">Nama Dokumen</td>
                        <td width="40%">: </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td width="25%">No Dokumen</td>
                        <td width="40%">: </td>
                        <td>Tanggal Terbit</td>
                        <td>: </td>
                    </tr>
                    <tr>
                        <td width="25%">No Revisi</td>
                        <td width="40%">: </td>
                        <td>Divisi</td>
                        <td>: </td>
                    </tr>
                @endif




            </table>

        </div>
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <tr>

                    <th class="text-center" width="33.33%">Diusulkan Oleh:</th>

                </tr>
                <tr>

                    <td style="height: 70px" class="align-middle text-center">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>
                </tr>
                <td class="text-center">( .......................... ) <br> <span style="font-size: 8px">
                        Diisi Oleh User</span>
                </td>
            </table>
        </div>
        <div class="col-12">
            <table class="table border-dark" style="font-size: 12px">
                <tr>
                    <th colspan="4">

                        @if ($dokumen->detail == 'perubahan')
                            Detail <span style="text-decoration: line-through;">Pembuatan</span>/Perubahan (Coret Salah
                            Satu):
                        @else
                            Detail Pembuatan/ <span style="text-decoration: line-through;">Perubahan</span> (Coret Salah
                            Satu):
                        @endif
                    </th>

                </tr>

                <tr>
                    <td colspan="4" style="height: 80px">{{ $dokumen->ket_detail }}</td>
                </tr>
                <tr>
                    <th colspan="4">

                        @if ($dokumen->detail == 'perubahan')
                            Alasan <span style="text-decoration: line-through;">Pembuatan</span>/Perubahan (Coret Salah
                            Satu):
                        @else
                            Alasan Pembuatan/ <span style="text-decoration: line-through;">Perubahan</span> (Coret Salah
                            Satu):
                        @endif
                    </th>

                </tr>
                <tr>
                    <td colspan="4" style="height: 80px">{{ $dokumen->alasan }}</td>
                </tr>





            </table>


        </div>
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <tr>

                    <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                    <th class="text-center" width="33.33%">Disetujui Oleh:</th>

                </tr>
                <tr>

                    <td style="height: 70px" class="align-middle text-center">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>
                    <td style="height: 70px" class="align-middle text-center">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>
                </tr>
                <td class="text-center">( .......................... ) <br> <span style="font-size: 8px">
                        Diisi Oleh User</span>
                </td>
                <td class="text-center">( KA. LAB & FSTL )</td>

            </table>
        </div>
    </div>
</x-hccp-print>
