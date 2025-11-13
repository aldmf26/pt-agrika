<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="dhead text-center align-middle" rowspan="2">No</th>
                        <th class="dhead text-center align-middle" rowspan="2">Tanggal Informasi</th>
                        <th class="dhead text-center align-middle" rowspan="2">Jenis Pelatihan</th>
                        <th class="dhead text-center align-middle" rowspan="2">Sasaran Pelatihan</th>
                        <th class="dhead text-center align-middle" rowspan="2">Tema Pelatihan <br> [Yang
                            Ditawarkan]</th>
                        <th class="dhead text-center align-middle" rowspan="2">Sumber Informasi</th>
                        <th class="dhead text-center align-middle" rowspan="2">Personil Penghubung</th>
                        <th class="dhead text-center align-middle">No.Telp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informasi as $i)
                        <tr>
                            <td class="text-end align-middle">{{ $loop->iteration }}</td>
                            <td class="text-end align-middle">{{ tanggal($i->tanggal) }}</td>
                            <td class="align-middle">{{ $i->jenis }}</td>
                            <td class="align-middle">{{ $i->sasaran }}</td>
                            <td class="align-middle">{{ $i->tema }}</td>
                            <td class="align-middle">{{ $i->sumber_informasi }}</td>
                            <td class="align-middle">{{ $i->personil_penghubung }}</td>
                            <td class="align-middle">{{ $i->no_telp }} <br> {{ $i->email }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        <div class="col-6">
            <table width="100%" style="text-transform: capitalize; font-size: 10px">
                <tr>
                    <td>Catatan :</td>
                </tr>
                <tr>
                    <td>1. Pelatihan dapat dilakukan oleh pihak internal ataupun pihak eksternal</td>
                </tr>
                <tr>
                    <td>2. Informasi ini digunakan sebagai gambaran awal, bilamana sesuai, dapat
                        menjadi bahan masukan dalam proses penetapan program pelatihan tahunan.</td>
                </tr>

            </table>
            {{-- <p style="font-size: 11px">Catatan:</p>
            <p style="font-size: 11px">1. Pelatihan dapat dilakukan oleh pihak internal ataupun pihak eksternal</p>
            <p style="font-size: 11px">2. Informasi ini digunakan sebagai gambaran awal, bilamana sesuai, dapat
                menjadi bahan masukan dalam proses penetapan program pelatihan tahunan.</p> --}}
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
