<x-app-layout :title="$title">
    <div class="container mt-4">
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

        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" value="{{ date('Y-m-d') }}" required name="tgl" class="form-control">
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Bagian</th>
                        <th>Proses yang Diaudit</th>
                        <th>Auditor</th>
                        <th>Auditee</th>
                    </tr>
                </thead>
                <tbody>
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
                                <th scope="row" class="text-nowrap">
                                    {{ $value }}

                                    <input type="hidden" value="{{ $value }}" name="waktu[{{ $key }}]">
                                </th>
                                <td>
                                    <input type="text" class="form-control" id="bagian_{{ $key }}"
                                        name="bagian[{{ $key }}]" value="{{ $getJadwal->bagian ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="proses_{{ $key }}"
                                        name="proses[{{ $key }}]" value="{{ $getJadwal->proses ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="auditor_{{ $key }}"
                                        name="auditor[{{ $key }}]" value="{{ $getJadwal->auditor ?? '' }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="auditee_{{ $key }}"
                                        name="auditee[{{ $key }}]" value="{{ $getJadwal->audite ?? '' }}">
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </form>
    </div>

</x-app-layout>
