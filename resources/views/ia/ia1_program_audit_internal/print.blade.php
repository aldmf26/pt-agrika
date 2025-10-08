{{-- berubah --}}
{{-- <div class="logo text-center">
    <a href="dashboard" style="display: inline-block; text-decoration: none;">
        <img src="{{ asset('img/logocash-tf.png') }}" alt="Logo"
            style="width: 100%; max-width: 280px; object-fit:cover;">
    </a>
</div> --}}
<x-hccp-print :title="$title" :dok="$dok">
    <div class="table-xs mt-5 d-flex justify-content-between" style="font-weight: bold;">
        <span>Standar: GMP & HACCP</span>
    </div>

    <table class="mt-2 table table-bordered table-xs table-sm border-dark">
        <thead>
            <tr>
                <th rowspan="2" class="text-center align-middle">No</th>
                <th rowspan="2" class="text-center align-middle">Departemen</th>
                <th rowspan="2" class="text-center align-middle">Auditee</th>
                <th rowspan="2" class="text-center align-middle">Auditor</th>
                <th colspan="13" class="text-center">Tahun {{ $tahun }}</th>
            </tr>
            {{-- <tr>
            <th colspan="4"></th>
                @for ($i = 1; $i <= 12; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr> --}}
            <tr>

                @foreach ($bulan as $b)
                    @php
                        $tgl_bulan = $tahun . '-' . $b->bulan . '-01';

                    @endphp
                    <th class="text-center">{{ date('M', strtotime($tgl_bulan)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $key => $audit)
                <tr>
                    <td class="text-end">{{ $key + 1 }}</td>
                    <td>{{ $audit->departemen }}</td>
                    <td>{{ $audit->audite }}</td>
                    <td>{{ $audit->auditor }}</td>
                    @for ($i = 1; $i <= 12; $i++)
                        @php
                            $field = 'bulan_' . $i; // Nama kolom di database
                            $cek = DB::table('program_audit_internals')
                                ->where('id', $audit->id)
                                ->where('tahun', $tahun)
                                ->value($field);

                            $cekSelesai = App\Models\Notif::where([
                                ['nama', $audit->departemen],
                                ['month', $i],
                                ['year', $tahun],
                                ['user_id', auth()->user()->id],
                                ['is_read', 1],
                            ])->first();
                        @endphp
                        <td
                            class="text-center td-hover @if ($cekSelesai) bg-success @elseif ($cek == 1) bg-warning @endif">
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-4 table-xs">
            <span>Note : </span>
            <br>
            <span>- Standar HACCP dilakukan audit tahunan</span>
        </div>
        <div class="col-2"></div>
        <div class="col-3">
        </div>
        <div class="col-3">
            <table class="table table-bordered border-dark" style="font-size: 12px">
                <tr>

                    <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                </tr>
                <tr>
                    <td style="height: 70px" class="align-middle text-center">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>
                </tr>
                <td class="text-center">( .......................... ) <br> <span style="font-size: 8px">
                        Diisi Oleh User</span>
                </td>
            </table>
        </div>
</x-hccp-print>
