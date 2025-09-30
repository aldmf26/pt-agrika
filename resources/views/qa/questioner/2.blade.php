<div>
    <table class="table table-bordered border-dark table-xs" style="font-size: 12px;">
        <tr>
            <th colspan="2"></th>
            <th colspan="6" class="text-center align-middle" style="background-color: #ffd700;">Keamanan</th>
            <th colspan="6" class="text-center align-middle" style="background-color: #ffd700;">Tanggung Jawab</th>
            <th colspan="6" class="text-center align-middle" style="background-color: #ffd700;">Kebersamaan</th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th colspan="2" class="text-center align-middle">Komitmen Management</th>
            <th colspan="2" class="text-center align-middle">Teamwork</th>
            <th colspan="2" class="text-center align-middle">Pemberdayaan</th>
            <th colspan="2" class="text-center align-middle">Kontrol</th>
            <th colspan="2" class="text-center align-middle">Koordinasi</th>
            <th colspan="2" class="text-center align-middle">Konsistensi</th>
            <th colspan="2" class="text-center align-middle">Kepedulian</th>
            <th colspan="2" class="text-center align-middle">Komunikasi</th>
            <th colspan="2" class="text-center align-middle">Target</th>
        </tr>
        <tr>
            <th class="text-center align-middle">No</th>
            <th class="text-center align-middle">Bagian Pekerjaan</th>
            @foreach ($pertanyaan as $p)
                <th class="text-end align-middle">{{ $p->no_pertanyaan }}</th>
            @endforeach
        </tr>
        @foreach ($responden as $r)
            <tr>
                <td class="text-end">{{ $loop->iteration }}</td>
                <td>{{ $r->bagian_pekerjaan }}</td>
                @foreach ($pertanyaan as $p)
                    <td class="text-end">
                        {{ $r->jawaban->where('pertanyaan_id', $p->id)->first()->nilai ?? '' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-center">Total</td>
            @foreach ($pertanyaan as $p)
                <td class="text-end">{{ $jawaban->where('pertanyaan_id', $p->id)->sum('nilai') }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="2" class="text-center">Max Value</td>
            @foreach ($pertanyaan as $p)
                <td class="text-end">{{ $responden->count() * 5 }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="2" class="text-center">% ach / item</td>
            @foreach ($pertanyaan as $p)
                @php
                    $ttl = ($jawaban->where('pertanyaan_id', $p->id)->sum('nilai') / ($responden->count() * 5)) * 100;
                @endphp
                <td class="text-end">{{ number_format($ttl, 1) }}%</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="2" class="text-center">% sub judul</td>
            @php
                $subTotals = [];
                $subCategories = [
                    'komitmen management',
                    'teamwork',
                    'pemberdayaan',
                    'kontrol',
                    'koordinasi',
                    'konsistensi',
                    'kepedulian',
                    'komunikasi',
                    'target',
                ];
                foreach ($subCategories as $sub) {
                    $qIds = $pertanyaan->where('sub_kategori', strtoupper($sub))->pluck('id')->values();
                    $totalSum = 0;
                    $maxSum = 0;
                    for ($i = 0; $i < $qIds->count(); $i += 2) {
                        $pairQIds = [$qIds[$i], $qIds[$i + 1] ?? $qIds[$i]]; // Ambil pasangan atau satu jika ganjil
                        $pairTotal = $jawaban->whereIn('pertanyaan_id', $pairQIds)->sum('nilai');
                        $pairMax = $responden->count() > 0 ? $responden->count() * 5 * count($pairQIds) : 1; // Hindari division by zero
                        $totalSum += $pairTotal;
                        $maxSum += $pairMax;
                    }
                    $subTotals[$sub] = $maxSum > 0 ? ($totalSum / $maxSum) * 100 : 0;
                }
            @endphp
            @foreach (array_chunk($subCategories, 1) as $subGroup)
                @foreach ($subGroup as $sub)
                    <td colspan="2" class="text-center">{{ number_format($subTotals[$sub] ?? 0, 1) }}%</td>
                @endforeach
            @endforeach
        </tr>
        <tr>
            <td colspan="2" class="text-center">% judul</td>
            @php
                $categoryTotals = [];
                $categories = ['keamanan', 'tanggung jawab', 'kebersamaan'];
                foreach ($categories as $cat) {
                    $subCats = $pertanyaan->where('kategori', strtoupper($cat))->pluck('sub_kategori')->unique();
                    $catTotal = 0;
                    foreach ($subCats as $sub) {
                        $qIds = $pertanyaan->where('sub_kategori', $sub)->pluck('id')->values();
                        $totalSum = 0;
                        $maxSum = 0;
                        for ($i = 0; $i < $qIds->count(); $i += 2) {
                            $pairQIds = [$qIds[$i], $qIds[$i + 1] ?? $qIds[$i]];
                            $pairTotal = $jawaban->whereIn('pertanyaan_id', $pairQIds)->sum('nilai');
                            $pairMax = $responden->count() * 5 * count($pairQIds);
                            if ($pairMax != 0) {
                                $totalSum += $pairTotal;
                                $maxSum += $pairMax;
                            }
                        }
                        $catTotal += $maxSum != 0 ? ($totalSum / $maxSum) * 100 : 0;
                    }
                    $categoryTotals[$cat] = $catTotal / $subCats->count();
                }
            @endphp
            @for ($i = 0; $i < 3; $i++)
                <td colspan="6" class="text-center">{{ number_format($categoryTotals[$categories[$i]] ?? 0, 1) }}%
                </td>
            @endfor
        </tr>
    </table>
</div>
