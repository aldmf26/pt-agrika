<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-6">
            <table>
                <tr>
                    <th>Departemen Penerima</th>
                    <td>: {{ $divisi->divisi }}</td>
                </tr>
            </table>

        </div>
        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <thead>
                    <tr>
                        <th class="text-center align-middle" rowspan="2">No</th>
                        <th class="text-center align-middle" rowspan="2">No. Dokumen</th>
                        <th class="text-center align-middle" rowspan="2">Nama Dokumen</th>
                        <th class="text-center align-middle" colspan="4">Revisi 0</th>
                        <th class="text-center align-middle" rowspan="2">Status</th>
                        <th class="text-center align-middle" colspan="4">Revisi 1</th>
                        <th class="text-center align-middle" rowspan="2">Status</th>
                        <th class="text-center align-middle" colspan="4">Revisi 2</th>
                        <th class="text-center align-middle" rowspan="2">Status</th>
                    </tr>
                    <tr>
                        <th class="text-center">A</th>
                        <th class="text-center">B</th>
                        <th class="text-center">C</th>
                        <th class="text-center">D</th>
                        <th class="text-center">A</th>
                        <th class="text-center">B</th>
                        <th class="text-center">C</th>
                        <th class="text-center">D</th>
                        <th class="text-center">A</th>
                        <th class="text-center">B</th>
                        <th class="text-center">C</th>
                        <th class="text-center">D</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftar as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ $d->no_dokumen }}</td>
                            <td>{{ $d->judul }}</td>
                            <td class="text-start">{{ $d->divisi }}</td>
                            @php
                                $tgl = date('Y-m-d', strtotime($d->updated_at));
                            @endphp
                            <td class="text-end">{{ tanggal($tgl) }}</td>
                            <td></td>
                            <td></td>
                            <td>Aktif</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>
        <div class="col-6" style="font-size: 10px">
            <p>Keterangan : </p>
            <table width="100%">
                <td>A: Nama Penerima</td>
                <td>B: Tanggal Terima</td>
                <td>C: Paraf Penerima</td>
                <td>D: Paraf DCR Saat Menerima Dokumen Lama</td>

            </table>

        </div>
        <div class="col-6">
            {{-- <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
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
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>

                    </tr>

                    <tr>
                        <td class="text-center">( STAFF HRGA )</td>
                        <td class="text-center">( KA. HRGA )</td>
                        <td class="text-center">( OPERASIONAL MANAGER )</td>

                    </tr>
                </tbody>
            </table> --}}
        </div>
    </div>
</x-hccp-print>
