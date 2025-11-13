<x-hccp-print :title="$title" :dok="$dok">
    <table class="table-sm table-xs">
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

    <table class="mt-3 table table-xs table-sm border-dark table-bordered">
        <thead style="background-color: #C0C0C0; text-align: center">
            <tr>
                <th class="text-center">Waktu</th>
                <th class="text-center">Bagian</th>
                <th class="text-center" style=" text-transform: none">Proses yang Diaudit</th>
                <th class="text-center">Auditor</th>
                <th class="text-center">Auditee</th>
            </tr>
        </thead>

        <tbody style="text-align: center">
            @foreach ($datas as $d)
                <tr>
                    <td scope="row" class="text-end">
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
    <div class="row mt-2">
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-xs table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="33.33%">Dibuat Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>


                        <td class="text-center">(LEAD AUDITOR)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
