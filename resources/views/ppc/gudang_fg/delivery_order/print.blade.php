<x-hccp-print :title="$title" :dok="$dok">
    <span>PT. Agrika Gatya Arum</span>
    <p>MHMR+733, Antasan Besar, Kec Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan</p>


    <div class="row">
        <div class="col-6">
            <strong>To:</strong> Hingke Java edible birdnest <br>
            Alamat = Unit B5/F HkyeBn <br>
            group center 13 -15 <br>
            Shing wan road <br>
            Tai wai new territories <br>
            Hongkong
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
                    <td>:{{ $no_nota }}|{{ $bulanRomawi[$bulan] }}|{{ $tahun }}</td>
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
                    <td><strong>ETD</strong></td>
                    <td>: </td>
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
                <th class=" align-middle" rowspan="2">Nama Produk</th>
                <th class=" align-middle" rowspan="2">Kode</th>
                <th class=" align-middle" rowspan="2">Batch Produk</th>
                <th class=" align-middle" rowspan="2">Jenis Kemasan</th>
                <th class="text-center align-middle" colspan="2">Jumlah</th>
                <th class=" align-middle" rowspan="2">CoA*</th>
            </tr>
            <tr>
                <th class="text-end align-middle">Pcs</th>
                <th class="text-end align-middle">Gram</th>
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
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td class=" align-middle">{!! $sbwList->pluck('nama')->unique()->implode(', <br>') ?: '-' !!}</td>
                    <td class=" align-middle">{{ $d['grade'] }}</td>
                    <td class=" align-middle text-nowrap">{!! $sbwList->pluck('no_invoice')->unique()->implode(', <br>') ?: '-' !!}</td>
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



    <div class="row mb-4 mt-5">
        <div class="col-md-4">
            Dibuat oleh,
            <br>
            <br>
            <br>
            {{ auth()->user()->name }}
        </div>

    </div>



</x-hccp-print>
