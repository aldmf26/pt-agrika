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
        <span>Tahun: @for ($i = 0; $i < 5; $i++)
                &nbsp;
            @endfor {{ $tahun }}</h6>
    </div>

    <table class="mt-2 table table-bordered table-xs border-dark table-striped">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Departemen</th>
                <th class="text-center">Auditee</th>
                <th class="text-center">Auditor</th>
                <th colspan="13" class="text-center">Tahun {{ $tahun }}</th>
            </tr>
            {{-- <tr>
            <th colspan="4"></th>
                @for ($i = 1; $i <= 12; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr> --}}
            <tr>
                <th colspan="4"></th>

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
        <div class="col-3"></div>
        <div class="col-2"></div>
        <div class="col-3">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        {{-- <th class="text-center" width="33.33%">Diketahui Oleh:</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">(LEAD AUDITOR)</td>
                        {{-- <td class="text-center">[FSTL]</td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
