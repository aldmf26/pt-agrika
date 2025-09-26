<x-hccp-print :title="$title" :dok="$dok">
    <table class="table table-bordered border-dark table-xs">
        <thead>
            <tr>
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tanggal</th>
                <th class="text-center align-middle">Urutan Finding</th>
                <th class="text-center align-middle">Divisi</th>
                <th class="text-center align-middle">Auditee</th>
                <th class="text-center align-middle">Finding</th>
                <th class="text-center align-middle" style="text-transform: none">Tindakan Perbaikan <br> dan Pencegahan
                </th>
                <th class="text-center align-middle">PIC</th>
                <th class="text-center align-middle">Completion Date</th>
                <th class="text-center align-middle">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $r)
                <tr>
                    <td class="text-end">{{ $loop->iteration }}</td>
                    <td class="text-end">{{ tanggal($r->tgl_audit) }}</td>
                    <td class="text-end">{{ $r->urutan }}</td>
                    <td>{{ ucwords(strtolower($r->divisi)) }}</td>
                    <td>{{ $r->audite }}</td>
                    <td>{{ $r->finding }}</td>
                    <td>{{ $r->tindakan }}</td>
                    <td>{{ $r->pic }}</td>
                    <td class="text-end">{{ tanggal($r->completion_date) }}</td>
                    <td>{{ $r->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row mt-2">
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-xs table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="33.33%" style="text-transform: none">Diterima dan
                            Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">( .......................... ) <br> <span style="font-size: 8px">
                                Diisi Oleh User</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
