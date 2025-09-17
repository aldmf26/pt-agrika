<x-hccp-print :title="$title" :dok="$dok">
    <table class="table table-bordered border-dark table-xs">
        <thead>
            <tr>
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tanggal</th>
                <th class="text-center align-middle">Urutan finding</th>
                <th class="text-center align-middle">Divisi</th>
                <th class="text-center align-middle">Auditee</th>
                <th class="text-center align-middle">Finding</th>
                <th class="text-center align-middle">Tindakan perbaikan <br> dan pencegahan</th>
                <th class="text-center align-middle">PIC</th>
                <th class="text-center align-middle">Completion date</th>
                <th class="text-center align-middle">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $r)
                <tr>
                    <td class="text-end">{{ $loop->iteration }}</td>
                    <td>{{ tanggal($r->tgl_audit) }}</td>
                    <td class="text-center">{{ $r->urutan }}</td>
                    <td>{{ $r->divisi }}</td>
                    <td>{{ $r->audite }}</td>
                    <td>{{ $r->finding }}</td>
                    <td>{{ $r->tindakan }}</td>
                    <td>{{ $r->pic }}</td>
                    <td>{{ tanggal($r->completion_date) }}</td>
                    <td>{{ $r->status }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>

    <br>
    <br>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-bordered border-dark float-right" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center">Received & Approved by</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">(Auditor / Operational Director)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- <ul style="list-style-type: none;">
        <li>Departemen : {{ $datas[0]->departemen }}</li>
        <li>Tanggal Audit : {{ tanggal($datas[0]->tgl_audit) }}</li>
        <li>Auditee : {{ $datas[0]->audite }}</li>
        <li>Auditor : {{ $datas[0]->auditor }}</li>
    </ul>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Laporan Audit</th>
                <th class="text-center">No FTPP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td>{!! nl2br(e($d->laporan_audit)) !!}</td>
                    <td class="text-center align-middle">{{ $d->no_ftp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[AUDITOR]</td>
                        <td class="text-center">[LEAD AUDITOR]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
</x-hccp-print>
