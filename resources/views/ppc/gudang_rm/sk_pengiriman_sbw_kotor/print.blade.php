<x-hccp-print :title="$title" :dok="$dok">
    <table width="100%" class="p-2">
        <tr>
            <td class="align-middle text-start">Nama/ No. Registrasi Rumah Walet </td>
            <td class="align-middle text-start"> : </td>
            <td class="align-middle text-start">&nbsp;{{ ucwords($rumah_walet->nama) }} / {{ $rumah_walet->no_reg }}</td>
        </tr>
        <tr>
            <td class="align-middle text-start">Alamat Rumah Walet</td>
            <td class="align-middle text-start"> : </td>
            <td class="align-middle text-start">&nbsp;{{ ucwords($rumah_walet->alamat) }}</td>
        </tr>

        <tr>
            <td class="align-middle text-start">Tujuan IKH</td>
            <td class="align-middle text-start"> : </td>
            <td class="align-middle text-start">&nbsp;PT.Agrika Gatya Arum</td>
        </tr>
        <tr>
            <td class="align-middle text-start">No. Registrasi IKPH</td>
            <td class="align-middle text-start"> : </td>
            <td class="align-middle text-start">&nbsp;339</td>
        </tr>
        <tr>
            <td class="align-middle text-start">Alamat IKPH</td>
            <td class="align-middle text-start"> : </td>
            <td class="align-middle text-start">&nbsp;Jl. Teluk Tiram Darat No 5B Rt 26 / RW 002 Telawang, Banjarmasin
                Barat, Kota
                Banjarmasin, Kalimantan Selatan</td>
        </tr>


    </table>

    <div class="row mt-4">
        <table class="table table-bordered table-xs border-dark">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Tanggal Panen</th>
                    <th class="text-center align-middle" rowspan="2">Berat Panen <br> (GR)</th>
                    <th class="text-center align-middle" colspan="2">Pengiriman ke IKPH</th>
                    <th class="text-center align-middle" rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th class="text-center align-top">Tanggal Kirim</th>
                    <th class="text-center align-middle">Berat Kirim (IKPH) <br> (GR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sk as $d)
                    @php
                        $tgl_plus1hari = date('Y-m-d', strtotime('+1 day', strtotime($d->tgl)));
                    @endphp
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td class="text-end">{{ tanggal($d->tgl) }}</td>
                        <td class="text-end" align="right">{{ number_format($d->kg, 0) }} GR</td>
                        <td class="text-end">{{ tanggal($tgl_plus1hari) }}</td>
                        <td class="text-end" align="right">{{ number_format($d->kg, 0) }} GR</td>
                        <td class="text-start"></td>
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
                        <th class="text-center" width="33.33%">
                            Pemilik/Penanggungjawab
                            <br>
                            Rumah Walet
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px; " class="align-middle text-center">

                        </td>
                    </tr>

                    <tr>
                        <th class="text-center" width="33.33%"><span style="opacity: 0.5;">(Ttd & Nama)</span></th>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</x-hccp-print>
