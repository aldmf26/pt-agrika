<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Hari</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($tgl)->locale('id')->translatedFormat('l') }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ tanggal($tgl) }}</td>
        </tr>
    </table>

    <table class="mt-3 table table-sm border-dark table-bordered">
        <thead style="background-color: #C0C0C0; text-align: center">
            <tr>
                <th>Waktu</th>
                <th>Bagian</th>
                <th>Proses yang Diaudit</th>
                <th>Auditor</th>
                <th>Auditee</th>
            </tr>
        </thead>

        <tbody style="text-align: center">


            @foreach ($datas as $d)
                <tr>
                    <td scope="row" class="text-nowrap">
                        {{ $d->waktu }}
                    </td>
                    <td>{{ $d->bagian ?? '' }}</td>
                    <td>{{ $d->proses ?? '' }}</td>
                    <td>{{ $d->auditor ?? '' }}</td>
                    <td>{{ $d->audite ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-3">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[LEAD AUDITOR]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
