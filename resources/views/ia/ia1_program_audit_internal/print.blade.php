{{-- berubah --}}
<div class="logo text-center">
    <a href="dashboard" style="display: inline-block; text-decoration: none;">
        <img src="{{ asset('img/logocash-tf.png') }}" alt="Logo" style="width: 100%; max-width: 280px; object-fit:cover;">
    </a>
</div>
<x-hccp-print :title="$title" :dok="$dok">
    <div class="mt-5 d-flex justify-content-between">
        <h6>Standar: GMP & HACCP</h6>
        <h6>Tahun: @for ($i = 0; $i < 5; $i++)
                &nbsp;
            @endfor {{ $tahun }}</h6>
    </div>

    <table class="mt-4 table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Departemen</th>
                <th>Auditee</th>
                <th>Auditor</th>
                <th colspan="13" class="text-center">Bulan</th>
            </tr>
            <tr>
                <th colspan="4"></th>
                @for ($i = 1; $i <= 12; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $key => $audit)
                <tr>
                    <td>{{ $key + 1 }}</td>
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
                        <td class="text-center td-hover @if ($cekSelesai) bg-success @elseif ($cek == 1) bg-warning @endif">
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-4">
            <span>Note : </span>
            <ol class="ms-5">
                <li>- Standar GMP dilakukan audit bulanan</li>
                <li>- Standar HACCP dilakukan audit tahunan</li>
            </ol>
        </div>
        <div class="col-3"></div>
        <div class="col-5">
            <table class="table table-bordered" style="font-size: 11px">
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
                        <td class="text-center">[LEAD AUDITOR]</td>
                        <td class="text-center">[FSTL]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
