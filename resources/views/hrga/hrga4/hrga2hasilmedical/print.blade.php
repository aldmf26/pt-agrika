<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <p style="font-size: 11px" class="fw-bold">Periode : 2024</p>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <thead>
                    <tr>
                        <th class="text-center dhead align-middle" rowspan="2">No</th>
                        <th class="text-center dhead align-middle" rowspan="2">Nama</th>
                        <th class="text-center dhead align-middle" rowspan="2">Tempat Tanggal Lahir</th>
                        <th class="text-center dhead align-middle" rowspan="2">Tanggal Pemeriksaan</th>
                        <th class="text-center dhead align-middle" rowspan="2">Jenis Kelamin</th>
                        <th class="text-center dhead align-middle" rowspan="2">Bagian/ <br>Posisi</th>
                        <th class="text-center dhead align-middle" colspan="9">Parameter Uji</th>

                        <th class="text-center dhead align-middle" rowspan="2">Status (Sehat / Tidak Sehat)</th>
                        <th class="text-center dhead align-middle" rowspan="2">Tindakan (Jika Tidak Sehat)</th>
                    </tr>
                    <tr>
                        <th class="text-center dhead align-middle">HBsAg</th>
                        <th class="text-center dhead align-middle">Anti-Hbs</th>
                        <th class="text-center dhead align-middle">Salmonella Typhi O</th>
                        <th class="text-center dhead align-middle">Salmonella Typhi H</th>
                        <th class="text-center dhead align-middle">Salmonella Paratyphi A</th>
                        <th class="text-center dhead align-middle">Salmonella Paratyphi B</th>
                        <th class="text-center dhead align-middle">Sputum (BTA)</th>
                        <th class="text-center dhead align-middle">MH (Kusta)</th>
                        <th class="text-center dhead align-middle">Swab Antigen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $r)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ $r->nama }}</td>
                            <td class="text-end">{{ $r->tempat_tgl_lahir }}</td>
                            <td class="text-end">{{ tanggal($r->tgl_pemeriksaan) }}</td>
                            <td>{{ $r->jenis_kelamin }}</td>
                            <td>{{ $r->bagian }}</td>
                            <td>{{ $r->hbsag }}</td>
                            <td>{{ $r->anti_hbs }}</td>
                            <td>{{ $r->salmonella_typhi_o }}</td>
                            <td>{{ $r->salmonella_typhi_h }}</td>
                            <td>{{ $r->salmonella_paratyphi_a }}</td>
                            <td>{{ $r->salmonella_paratyphi_b }}</td>
                            <td>{{ $r->sputum_bta }}</td>
                            <td>{{ $r->mh_kusta }}</td>
                            <td>{{ $r->swab_antigen }}</td>
                            <td>{{ $r->status }}</td>
                            <td>{{ $r->tindakan }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>


        </div>
        <div class="col-6" style="font-size: 10px">
            <p>Catatan :</p>
            <p>1. Medical check up dilakukan oleh vendor eksternal yang ditunjuk perusahaan.
            </p>
        </div>
        <div class="col-6">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 70px" class="align-middle text-center">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>

                    </tr>

                    <tr>
                        <td class="text-center">( KA. HRGA )</td>
                        <td class="text-center">( OPERASIONAL MANAGER )</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
