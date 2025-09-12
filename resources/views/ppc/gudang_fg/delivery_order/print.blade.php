<x-hccp-print :title="$title" :dok="$dok">
    <span>PT. Agrika Gatya Arum</span>
    <p>Jl. Teluk Tiram Darat No.5b Rt.26 Rw.002, Desa/Kelurahan Telawang, Kec. Banjarmasin Barat, Kota Banjarmasin,
        Provinsi Kalimantan Selatan Kode Pos : 70112 </p>


    <div class="row">
        <div class="col-6">
            <strong>To:</strong> Hingkee Java Edible Birdnest Co LTD <br>
            Unit B5/F Hkjebn Group Center <br>
            13-15 Shing Wan Road
            <br>
            Tai Wai New Territories <br>
            Hong Kong
        </div>
        <div class="col-2"></div>
        <div class="col-4 ">
            <table>
                @php
                    $bulanRomawi = [
                        1 => 'I',
                        2 => 'II',
                        3 => 'III',
                        4 => 'IV',
                        5 => 'V',
                        6 => 'VI',
                        7 => 'VII',
                        8 => 'VIII',
                        9 => 'IX',
                        10 => 'X',
                        11 => 'XI',
                        12 => 'XII',
                    ];
                    $tanggal = date('d', strtotime($tgl));
                    $bulan = (int) date('m', strtotime($tgl));
                    $tahun = date('Y', strtotime($tgl));
                @endphp
                <tr>
                    <td><strong>Order No</strong></td>
                    <td>:{{ $no_nota }}/{{ $bulanRomawi[$bulan] }}/{{ $tahun }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: {{ tanggal($tgl) }}</td>
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    @php
                        $tgl_terima = date('Y-m-d', strtotime($tgl . ' +2 day'));
                    @endphp
                    <td><strong>ETD</strong></td>
                    <td>: {{ tanggal($tgl_terima) }}</td>
                </tr>
            </table>


        </div>
    </div>
    <div class="row">
        <div class="col-6">
            {{-- {{ $datas->pelanggan->alamat }} --}}
        </div>
        <div class="col-6 text-end">
            <br>
        </div>
    </div>


    <p>Bersama ini kami kirimkan</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center align-middle" rowspan="2">No</th>
                <th class="text-center align-middle" rowspan="2">Nama Produk</th>
                <th class="text-center align-middle" rowspan="2">Kode</th>
                <th class="text-center align-middle" rowspan="2">Batch Produk</th>
                <th class="text-center align-middle" rowspan="2">Jenis Kemasan</th>
                <th class="text-center align-middle" colspan="2">Jumlah</th>
                <th class="text-center align-middle" rowspan="2">CoA*</th>
            </tr>
            <tr>
                <th class="text-center align-middle">Pcs</th>
                <th class="text-center align-middle">Gr</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($delivery as $d)
                @php
                    $rawPartai = $d['nm_partai'];
                    $cleaned = str_replace("'", '', $rawPartai); // hilangkan tanda kutip
                    $partaiArray = array_map('trim', explode(',', $cleaned));
                    $sbwList = DB::table('sbw_kotor')
                        ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                        ->whereIn('nm_partai', $partaiArray)
                        ->get();

                @endphp
                <tr>
                    <td class="text-end align-middle">{{ $loop->iteration }}</td>
                    <td class="text-start align-middle">{!! $sbwList->pluck('nama')->map(fn($n) => strtoupper($n))->unique()->implode(', <br>') ?: '-' !!}
                    </td>
                    <td class=" align-middle">{{ strtoupper($d['grade']) }}</td>
                    <td class="text-end align-middle text-nowrap">{!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
                    <td class=" align-middle">
                        {{ $d['grade'] == 'sbt' ? 'Plastik Mika (21,8 x 16,8 x 10 cm)' : 'Plastik Mika (21,8 x 16,8 x 7,7 cm)' }}
                    </td>
                    <td class="text-end align-middle">
                        {{ number_format($d['pcs'], 0) }}
                    </td>
                    <td class="text-end align-middle">
                        {{ number_format($d['gr'], 0) }}
                    </td>
                    <td class="text-start align-middle">
                        Y
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


    <div class="row">
        <div class="col-8">
            <p style="font-size: 7px">*Disertai CoA Ya (Y) atau Tidak (T)</p>
        </div>
        <div class="col-4">
            <table class="table table-bordered" style="font-size: 11px">
                <tr>
                    <th class="text-center align-middle">Dibuat Oleh :</th>
                </tr>
                <tr>
                    <td style="height: 80px" class="text-center align-middle">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">
                        (STAFF PACKING & GUDANG FG)
                    </td>
                </tr>

            </table>
        </div>
    </div>




</x-hccp-print>
