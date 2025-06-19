<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Nama/ No. Registrasi Rumah Walet </td>
            <td>&nbsp; : &nbsp;</td>
            <td>{{ $rumah_walet->nama }} / {{ $rumah_walet->no_reg }}</td>
        </tr>
        <tr>
            <td>Alamat Rumah Walet</td>
            <td>&nbsp; : &nbsp;</td>
            <td>{{ $rumah_walet->alamat }}</td>
        </tr>

        <tr>
            <td>Tujuan IKH</td>
            <td>&nbsp; : &nbsp;</td>
            <td>PT.Agrika Gatya Arum</td>
        </tr>
        <tr>
            <td>No. Registrasi IKPH</td>
            <td>&nbsp; : &nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat IKPH</td>
            <td>&nbsp; : &nbsp;</td>
            <td></td>
        </tr>


    </table>

    <div class="row mt-4">
        <table class="table table-bordered table-xs border-dark">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Tanggal Panen</th>
                    <th class="text-center align-middle" rowspan="2">Berat Panen (kg)</th>
                    <th class="text-center align-middle" colspan="2">Pengiriman ke IKPH</th>
                    <th class="text-center align-middle" rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th class="text-center">Tanggal Kirim</th>
                    <th class="text-center">Berat Kirim (IKPH)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sk as $d)
                    @php
                        $tgl_plus1hari = date('Y-m-d', strtotime('+1 day', strtotime($d->tgl)));
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ tanggal($d->tgl) }}</td>
                        <td class="text-center" align="right">{{ number_format($d->kg, 1) }} kg</td>
                        <td class="text-center">{{ tanggal($tgl_plus1hari) }}</td>
                        <td class="text-center" align="right">{{ number_format($d->kg, 1) }} kg</td>
                        <td class="text-center"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="row">
        <div class="col-8">

        </div>
        <div class="col-4">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Pemilik/Penanggungjawab</th>
                    </tr>
                    <tr>
                        <th class="text-center" width="33.33%">Rumah Walet</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[Tandatatangan dan nama]</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</x-hccp-print>
