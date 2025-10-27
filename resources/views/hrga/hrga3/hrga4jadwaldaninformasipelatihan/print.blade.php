<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered border-dark" with="100%">
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Tema Pelatihan</td>
                    <td colspan="4">{{ $jadwal->tema_pelatihan }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Hari/Tanggal</td>
                    <td>{{ tanggal($jadwal->tanggal) }}
                    </td>
                    <td width="20%" class="dhead p-2 fw-bold">Waktu</td>
                    <td>{{ date('h:i A', strtotime($jadwal->waktu)) }} -
                        {{ date('h:i A', strtotime($jadwal->waktu_selesai)) }}
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Tempat</td>
                    <td colspan="4">{{ ucfirst($jadwal->tempat) }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Narasumber</td>
                    <td colspan="4">{{ ucfirst($jadwal->narasumber) }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Kisaran Materi</td>
                    <td colspan="4">{{ ucfirst(strtolower($jadwal->kisaran_materi)) }}</td>
                </tr>
            </table>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="text-center dhead align-middle">No</th>
                        <th class="text-center dhead align-middle">
                            Nama Peserta Pelatihan <br> yang Diusulkan
                        </th>
                        <th class="text-center dhead align-middle">
                            Div / Dept
                        </th>
                        <th class="text-center dhead align-middle">
                            Konfirmasi/ <br> Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal_detail as $j)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ ucwords(strtolower($j->data_pegawai->nama ?? '-')) }}</td>
                            <td class="text-start">
                                {{ $j->data_pegawai->divisi->divisi == 'Cabut' ? 'Cabut Bulu' : ucwords($j->data_pegawai->divisi->divisi) }}
                            </td>
                            <td class="text-start">{{ $j->konfirmasi_keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="col-3">
            <p class="ms-3">Penyelenggara : </p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'internal' ? 'checked' : '' }}> Internal</p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'eksternal' ? 'checked' : '' }}> Eksternal</p>

        </div>
        <div class="col-9">
            <p>Banjarmasin , {{ tanggal(date('Y-m-d')) }}</p>
            <br>
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
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KA. HRGA)</td>
                        <td class="text-center">(OPERATIONAL MANAGER)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
