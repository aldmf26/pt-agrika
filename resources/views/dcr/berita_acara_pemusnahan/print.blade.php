<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">No Dokumen</th>
                        <th class="text-center align-middle">Nama Dokumen/Catatan</th>
                        <th class="text-center align-middle">Cakupan <br> Pemusnahan</th>
                        <th class="text-center align-middle">Divisi</th>
                        <th class="text-center align-middle">Inisial</th>
                        <th class="text-center align-middle">Alasan Pemusnahan</th>
                        <th class="text-center align-middle">Tgl <br> Pemusnahan</th>
                        <th class="text-center align-middle" width="10%">Paraf <br> Pelaksana</th>
                        <th class="text-center align-middle" width="10%">Paraf <br> Saksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokumen as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $d->no_dokumen }}</td>
                            <td class="text-nowrap">{{ $d->judul }}</td>
                            <td class="text-nowrap">{{ $d->cakupan_pemusnahan }}</td>
                            <td class="text-nowrap">{{ $d->nama_divisi }}</td>
                            <td class="text-nowrap">{{ $d->inisial }}</td>
                            <td class="text-nowrap">{{ $d->alasan_pemusnahan }}</td>
                            <td class="text-end text-nowrap">{{ tanggal($d->tgl_pemusnahan) }}</td>
                            <td class="text-nowrap"></td>
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>
        <div class="col-6" style="font-size: 10px">


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
