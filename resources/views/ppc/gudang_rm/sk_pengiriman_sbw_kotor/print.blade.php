<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Nama/ No. Registrasi Rumah Walet </td>
            <td>:</td>
            <td>{{ $sk[0]->rumahWalet->no_reg }}</td>
        </tr>
        <tr>
            <td>Alamat Rumah Walet</td>
            <td>:</td>
            <td>{{ $sk[0]->rumahWalet->alamat }}</td>
        </tr>

        <tr>
            <td>Tujuan IKH</td>
            <td>:</td>
            <td>{{ $sk[0]->tujuan_ikph }}</td>
        </tr>
        <tr>
            <td>No. Registrasi IKPH</td>
            <td>:</td>
            <td>{{ $sk[0]->ikph->no_registrasi_ikph }}</td>
        </tr>
        <tr>
            <td>Alamat IKPH</td>
            <td>:</td>
            <td>{{ $sk[0]->ikph->alamat_ikph }}</td>
        </tr>
        <tr>
            <td>Tanggal, Bulan, Tahun</td>
            <td>:</td>
            <td>{{ $sk[0]->tanggal_sk_pengiriman }}</td>
        </tr>

    </table>

    <div class="row mt-4">
        <table class="table table-bordered table-xs border-dark">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Tanggal Panen</th>
                    <th class="text-center align-middle" rowspan="2">Berat Panen (gr)</th>
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
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ tanggal($d->tanggal_panen) }}</td>
                        <td align="right">{{ number_format($d->berat_panen,0) }}</td>
                        <td>{{ tanggal($d->tanggal_kirim) }}</td>
                        <td align="right">{{ number_format($d->berat_kirim,0) }}</td>
                        <td>{{ $d->keterangan }}</td>
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
