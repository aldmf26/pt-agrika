<x-hccp-print :title="$title" :dok="$dok">
    <ul style="list-style-type: none;">
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
    </div>
</x-hccp-print>
