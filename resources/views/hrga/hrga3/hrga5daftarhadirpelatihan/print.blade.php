<x-hccp-print title="DAFTAR HADIR PELATIHAN" dok="Dok.No.: FRM.HRGA.03.05, Rev.00" rev="00">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered border-dark" with="100%" style="font-size: 10px">
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
                    <td colspan="4">{{ $jadwal->tempat }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2 fw-bold">Narasumber</td>
                    <td colspan="4">{{ $jadwal->narasumber }}</td>
                </tr>

            </table>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <tr sty>
                    <th class="text-center dhead align-middle">No</th>
                    <th class="text-center dhead align-middle">
                        Nama Peserta Training
                    </th>
                    <th class="text-center dhead align-middle">
                        NIK
                    </th>
                    {{-- <th class="text-center dhead align-middle">
                        Div / Dept
                    </th> --}}
                    <th class="text-center dhead align-middle">
                        Jabatan
                    </th>
                    <th class="text-center dhead align-middle">
                        Tanda Tangan
                    </th>
                </tr>
                @foreach ($jadwal_detail as $j)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $j->data_pegawai->nama }}</td>
                        <td class="text-start">{{ $j->data_pegawai->nik }}</td>
                        {{-- <td class="text-start">{{ $j->data_pegawai->divisi->divisi }}</td> --}}
                        <td class="text-start">{{ $j->data_pegawai->posisi }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-6" style="font-size: 11px">
            <p class="ms-3">Penyelenggara : </p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'internal' ? 'checked' : '' }}> Internal</p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'eksternal' ? 'checked' : '' }}> Eksternal</p>

        </div>
        <div class="col-6">
            <p>Banjarmasin , {{ tanggal(date('Y-m-d')) }}</p>
            <br>
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd &
                                Nama)</span></td>

                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
