<x-hccp-print :title="$title" :dok="$dok">
    <style>
        table {
            border-color: black;
        }
    </style>
    <p style="font-size: 12px">Area Concern : Produksi</p>
    <table style="font-size: 13px" id="table1" class="table table-bordered border-dark">
        <thead>
            <tr>
                <th class="align-middle dhead text-nowrap text-center">Nama alat/area</th>
                <th class="align-middle dhead text-nowrap text-center">Identifikasi alat/area</th>
                <th class="align-middle dhead text-nowrap text-center">Metode sanitasi</th>
                <th class="align-middle dhead text-nowrap text-center">Penanggung jawab</th>
                <th class="align-middle dhead text-nowrap text-center">Frekuensi</th>
                <th class="align-middle dhead text-nowrap text-center">Sarana cleaning</th>
                <th class="align-middle dhead text-nowrap text-center">Sanitizer & pengenceran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td class="align-top">{{ ucfirst(strtolower($d->nm_alat)) }}</td>
                    <td class="align-top">{{ ucfirst(strtolower($d->identifikasi_alat)) }}</td>
                    <td class="align-top">{{ ucfirst(strtolower($d->metode)) }}</td>
                    <td class="align-top">{{ ucwords($d->penanggung_jawab) }}</td>
                    <td class="align-top">{{ ucfirst(strtolower($d->frekuensi)) }}</td>
                    <td class="align-top">{{ ucfirst(strtolower($d->sarana_cleaning)) }}</td>
                    <td class="align-top">{{ ucfirst(strtolower($d->sanitizer)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="align-middle text-center">
                            <x-ttd-barcode :id_pegawai="whereTtd('STAFF HRGA')" />
                        </td>

                        <td style="height: 80px" class="align-middle text-center">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA HRGA')" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KEPALA HRGA)</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-hccp-print>
