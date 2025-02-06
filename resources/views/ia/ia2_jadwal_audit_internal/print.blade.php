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
        @php
            $jam = collect([
                '08.30 - 09.00',
                '09.00 - 09.30',
                '09.30 - 10.00',
                '10.00 - 10.30',
                '10.30 - 11.00',
                '11.00 - 11.30',
                '11.30 - 12.00',
                '12.00 - 13.00',
                '13.00 - 13.30',
                '13.30 - 14.00',
                '14.00 - 14.30',
                '14.30 - 15.00',
                '15.00 - 15.30',
                '15.30 - 16.00',
                '16.00 - 16.30',
            ]);
        @endphp
        <tbody style="text-align: center">
            @foreach ($jam as $key => $value)
                @if ($key == 7)
                    <tr class="bg-warning ">
                        <th scope="row" class="text-nowrap text-black">{{ $value }}</th>
                        <td colspan="4" class="text-center text-black">LUNCH BREAK</td>
                    </tr>
                @else
                    @php
                        $getJadwal = DB::table('jadwal_audit_internals')
                            ->where([['tgl', $tgl], ['waktu', $value]])
                            ->first();
                    @endphp
                    <tr>
                        <td scope="row" class="text-nowrap">
                            {{ $value }}
                        </td>
                        <td>{{ $getJadwal->bagian ?? '' }}</td>
                        <td>{{ $getJadwal->proses ?? '' }}</td>
                        <td>{{ $getJadwal->auditor ?? '' }}</td>
                        <td>{{ $getJadwal->audite ?? '' }}</td>
                    </tr>
                @endif
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
