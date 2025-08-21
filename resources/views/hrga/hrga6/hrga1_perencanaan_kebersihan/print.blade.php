<x-hccp-print :title="$title" :dok="$dok">
    <style>
        table {
            border-color: black;
        }
    </style>
    Area concern : Produksi
    <table style="font-size: 13px" id="table1" class="table table-bordered border-dark">
        <thead>
            <tr>
                <th class="align-middle" style="background-color: #D9D9D9">Nama alat/area</th>
                <th class="align-middle" style="background-color: #D9D9D9">Identifikasi alat/area</th>
                <th class="align-middle" style="background-color: #D9D9D9">Metode sanitasi</th>
                <th class="align-middle" style="background-color: #D9D9D9">Penanggung jawab</th>
                <th class="align-middle" style="background-color: #D9D9D9">Frekuensi</th>
                <th class="align-middle" style="background-color: #D9D9D9">Sarana cleaning</th>
                <th class="align-middle" style="background-color: #D9D9D9">Sanitizer & pengenceran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $d->nm_alat }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->identifikasi_alat)) }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->metode)) }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->penanggung_jawab)) }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->frekuensi)) }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->sarana_cleaning)) }}</td>
                    <td class="align-middle">{{ ucfirst(strtolower($d->sanitizer)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <table style="border: 1px solid black; border-collapse: collapse; width: 100%; margin-top: 10px;">
                <tr>
                    <td style="border: 1px solid black; text-align: center;">Dibuat Oleh:</td>
                    <td style="border: 1px solid black; text-align: center;">Diketahui Oleh:</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; text-align: center; height: 80px; vertical-align: bottom;">[SPV.
                        GA-IR]</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: bottom;">[KA.HRGA]</td>
                </tr>
            </table>
        </div>
    </div>

</x-hccp-print>
