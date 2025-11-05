<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">No Dokumen</th>
                        <th class="text-center">Nama Pelapor</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Tanggal Lapor</th>
                        <th class="text-center">Penyebab Hilang</th>
                        <th class="text-center">Paraf Penerima</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokumen as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $d->no_dokumen }}</td>
                            <td class="text-nowrap">{{ $d->nm_pelapor }}</td>
                            <td class="text-nowrap">{{ $d->nama_divisi }}</td>
                            <td class="text-end text-nowrap">{{ tanggal($d->tgl_lapor) }}</td>
                            <td class="text-nowrap">{{ $d->penyebab_hilang }}</td>
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
                        <td class="text-center">( KEPALA HRGA )</td>
                        <td class="text-center">( OPERASIONAL MANAGER )</td>

                    </tr>
                </tbody>
            </table> --}}
        </div>
    </div>
</x-hccp-print>
