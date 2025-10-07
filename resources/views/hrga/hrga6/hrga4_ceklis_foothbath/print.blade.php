<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-4">
            <table width="100%" style="font-size: 11px">
                <tr>
                    <td>Bulan</td>
                    <td>: {{ $nm_bulan }} {{ $tahun }}</td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>: {{ ucwords($lokasi->lokasi) }}</td>
                </tr>

            </table>
        </div>
        <div class="col-12">
            <table style="font-size: 11px" width="100%" class="table table-bordered text-center border-dark">
                <thead>

                    <tr>
                        <th class="dhead text-center">Item Pembersihan</th>
                        <th class="dhead text-center">Frekuensi</th>
                        @foreach ($hari as $h)
                            <th class="dhead text-center">{{ $h['tanggal'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sanitasi as $s)
                        <tr>
                            <td rowspan="4" class="align-middle">{{ ucfirst($s->item) }}</td>
                            <td>Awal Shift 1</td>
                            @foreach ($hari as $h)
                                <td class="text-center">
                                    @php
                                        $tgl =
                                            $tahun .
                                            '-' .
                                            str_pad($bulan, 2, '0', STR_PAD_LEFT) .
                                            '-' .
                                            str_pad($h['tanggal'], 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    @if ($tgl <= date('Y-m-d'))
                                        ✓
                                    @else
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Istirahat Shift 1</td>
                            @foreach ($hari as $h)
                                <td class="text-center">
                                    @php
                                        $tgl =
                                            $tahun .
                                            '-' .
                                            str_pad($bulan, 2, '0', STR_PAD_LEFT) .
                                            '-' .
                                            str_pad($h['tanggal'], 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    @if ($tgl <= date('Y-m-d'))
                                        ✓
                                    @else
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Awal Shift 2</td>
                            @foreach ($hari as $h)
                                <td class="text-center">
                                    @php
                                        $tgl =
                                            $tahun .
                                            '-' .
                                            str_pad($bulan, 2, '0', STR_PAD_LEFT) .
                                            '-' .
                                            str_pad($h['tanggal'], 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    @if ($tgl <= date('Y-m-d'))
                                        ✓
                                    @else
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="text-nowrap">Istirahat Shift 2</td>
                            @foreach ($hari as $h)
                                <td class="text-center">
                                    @php
                                        $tgl =
                                            $tahun .
                                            '-' .
                                            str_pad($bulan, 2, '0', STR_PAD_LEFT) .
                                            '-' .
                                            str_pad($h['tanggal'], 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    @if ($tgl <= date('Y-m-d'))
                                        ✓
                                    @else
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="100" style="height: 5px"></td>
                    </tr>
                    <tr>
                        <td>Paraf Petugas</td>
                        <td>Ttd</td>
                        @foreach ($hari as $h)
                            <td></td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Verifikator</td>
                        <td>Ttd</td>
                        @foreach ($hari as $h)
                            <td></td>
                        @endforeach
                    </tr>


                </tbody>
            </table>

        </div>
        <div class="col-6">
            <table width="100%" style="font-size: 11px">
                <tr>
                    <td>Keterangan</td>
                    <td>✓</td>
                    <td>: Standar Minimal 200 PPM</td>
                </tr>
                <tr>
                    <td></td>
                    <td>x</td>
                    <td>: < 200 PPM</td>
                </tr>

            </table>
        </div>
        <div class="col-6">

            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>

                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        <th class="text-center" width="33.33%">Diverifikasi Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 60px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>

                        <td style="height: 60px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>
                        <td style="height: 60px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KA. HRGA)</td>
                        <td class="text-center">(Dokter Hewan)</td>

                    </tr>
                </tbody>
            </table>

        </div>
    </div>



</x-hccp-print>
