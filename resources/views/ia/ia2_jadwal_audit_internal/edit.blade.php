<x-app-layout :title="$title">
    <div class="container mt-4">
        @php
            $jam = collect([
                '08.30 AM - 09.00 AM',
                '09.00 AM - 09.30 AM',
                '09.30 AM - 10.00 AM',
                '10.00 AM - 10.30 AM',
                '10.30 AM - 11.00 AM',
                '11.00 AM - 11.30 AM',
                '11.30 AM - 12.00 PM',
                '12.00 PM - 13.00 PM',
                '13.00 PM - 13.30 PM',
                '13.30 PM - 14.00 PM',
                '14.00 PM - 14.30 PM',
                '14.30 PM - 15.00 PM',
                '15.00 PM - 15.30 PM',
                '15.30 PM - 16.00 PM',
                '16.00 PM - 16.30 PM',
            ]);
        @endphp

        <form action="{{ route('ia.2.update', $tgl) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" value="{{ $tgl }}" required name="tgl" class="form-control">
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
                                    <input type="text" class="form-control" value="{{ $value }}"
                                        name="waktu[{{ $key }}]">
                                </th>
                                <td>
                                    <select name="bagian[{{ $key }}]" class="select2audit" id="">
                                        <option value="">-- Pilih Bagian --</option>
                                        @foreach ($bagian as $b)
                                            <option value="{{ $b }}"
                                                {{ isset($getJadwal) && $getJadwal->bagian == $b ? 'selected' : '' }}>
                                                {{ $b }}</option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="bagian_{{ $key }}"
                                        name="bagian[{{ $key }}]" value="{{ $getJadwal->bagian ?? '' }}"> --}}
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="proses_{{ $key }}"
                                        name="proses[{{ $key }}]" value="{{ $getJadwal->proses ?? '' }}">
                                </td>
                                <td>
                                    <select name="auditor[{{ $key }}]" class="select2audit" id="">
                                        <option value="">-- Pilih Auditor --</option>
                                        @foreach ($pegawai as $a)
                                            <option value="{{ $a }}"
                                                {{ isset($getJadwal) && $getJadwal->auditor == $a ? 'selected' : '' }}>
                                                {{ $a }}</option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="auditor_{{ $key }}"
                                        name="auditor[{{ $key }}]" value="{{ $getJadwal->auditor ?? '' }}"> --}}
                                </td>
                                <td>

                                    <select name="auditee[{{ $key }}]" class="select2audit" id="">
                                        <option value="">-- Pilih Auditee --</option>
                                        @foreach ($pegawai as $at)
                                            <option value="{{ $at }}"
                                                {{ isset($getJadwal) && $getJadwal->audite == $at ? 'selected' : '' }}>
                                                {{ $at }}</option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="auditee_{{ $key }}"
                                        name="auditee[{{ $key }}]" value="{{ $getJadwal->audite ?? '' }}"> --}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary float-end">Save</button>
        </form>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $('.select2audit').select2({
                        width: '100%'
                    });
                }, 100);
            });
        </script>
    @endsection

</x-app-layout>
