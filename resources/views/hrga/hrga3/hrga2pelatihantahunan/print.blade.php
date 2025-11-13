<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <p><span class="fw-bold">Tahun: </span> <span class="text-decoration-underline">{{ $tahun }}</span></p>
        </div>
        <div class="col-lg-12">

            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="dhead align-middle text-center" rowspan="2">No</th>
                        <th class="dhead align-middle text-center" rowspan="2">Materi Pelatihan</th>
                        <th class="dhead align-middle text-center" rowspan="2">I/E <br> *</th>
                        <th class="dhead align-middle text-center" rowspan="2">Narasumber</th>
                        <th class="dhead align-middle text-center" rowspan="2">Sasaran Peserta</th>
                        <th class="dhead align-middle text-center" rowspan="2">Pelaksanaan</th>
                        <th class="dhead  text-center" colspan="12">Bulan</th>

                    </tr>
                    <tr>
                        @foreach ($bulan as $b)
                            <th class="dhead text-center">{{ $b->bulan }}</th>
                        @endforeach

                    </tr>

                </thead>
                <tbody>
                    @foreach ($program as $t)
                        <tr>
                            <td rowspan="2" class="align-middle text-end">{{ $loop->iteration }}</td>
                            <td rowspan="2" class="align-middle">{{ ucwords($t->materi_pelatihan) }}
                            </td>
                            <td rowspan="2" class="align-middle">{{ $t->sumber == 'internal' ? 'I' : 'E' }}</td>
                            <td rowspan="2" class="align-middle">{{ ucwords($t->narasumber) }}</td>
                            <td rowspan="2" class="align-middle">{{ ucwords($t->sasaran_peserta) }}
                            </td>
                            <td class="dhead">Rencana</td>
                            @foreach ($bulan as $b)
                                <td
                                    class=" text-center {{ $b->bulan == date('m', strtotime($t->tgl_rencana)) ? 'bg-black' : '' }} ">
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="text-end">
                                Realisasi
                            </td>
                            @foreach ($bulan as $b)
                                <td class=" text-center ">
                                    {{ $b->bulan == date('m', strtotime($t->tgl_realisasi)) ? date('d', strtotime($t->tgl_realisasi)) : '' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="col-6">
            <table width="100%" style="font-size: 8px; text-transform: capitalize">
                <tr>
                    <td>Catatan:</td>
                </tr>
                <tr>
                    <td style="padding-left: 12px; text-indent: -10px;">1. Materi Pelatihan yang diprogramkan sebagai
                        pelatihan tahunan adalah yang
                        lebih terkait kepada peningkatan kompetensi pegawai</td>
                </tr>
                <tr>
                    <td style="padding-left: 12px; text-indent: -10px;">2. Pelatihan dapat dilakukan oleh pihak Internal
                        PT. AGRIKA GATYA ARUM atau
                        berasal dari luar yang telah diseleksi.
                        ( I = Internal, E = Eksternal )</td>
                </tr>
                <tr>
                    <td style="padding-left: 12px; text-indent: -10px;">3. Narasumber Internal, dipilih berdasarkan
                        kompetensinya dalam membawakan
                        materi pelatihan tersebut atau kesesuaian terkait dengan pekerjaannya dengan nilai kompetensi
                        yang
                        relevan dengan nilai 4 (Skala 0 - 4).</td>
                </tr>

            </table>

        </div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 70px" class="align-middle text-center">
                            <x-ttd-barcode :id_pegawai="whereTtd('STAFF HRGA')" />
                        </td>
                        <td style="height: 70px" class="align-middle text-center">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA HRGA')" />
                        </td>
                        <td style="height: 70px" class="align-middle text-center">
                            <x-ttd-barcode :id_pegawai="whereTtd('OPERATIONAL MANAGER')" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KEPALA HRGA)</td>
                        <td class="text-center">(OPERATIONAL MANAGER)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
