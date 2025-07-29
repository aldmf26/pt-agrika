<x-hccp-print title="Daftar Hadir Pelatihan" dok="FRM.HRGA.03.05" rev="00">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" with="100%">
                <tr>
                    <td width="20%" class="dhead p-2">Tema Pelatihan</td>
                    <td colspan="4">{{ $jadwal->tema_pelatihan }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2">Hari/Tanggal</td>
                    <td>{{ tanggal($jadwal->tanggal) }}
                    </td>
                    <td width="20%" class="dhead p-2">Waktu</td>
                    <td>{{ $jadwal->waktu }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2">Tempat</td>
                    <td colspan="4">{{ $jadwal->tempat }}</td>
                </tr>
                <tr>
                    <td width="20%" class="dhead p-2">Narasumber</td>
                    <td colspan="4">{{ $jadwal->narasumber }}</td>
                </tr>

            </table>
        </div>
        <div class="col-12 mt-4">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center dhead align-middle">No</th>
                    <th class="text-start dhead align-middle">
                        Nama Peserta Training
                    </th>
                    <th class="text-center dhead align-middle">
                        Div / Dept
                    </th>
                    <th class="text-center dhead align-middle">
                        Jabatan
                    </th>
                    <th class="text-center dhead align-middle">
                        Tanda Tangan
                    </th>
                </tr>
                @foreach ($jadwal_detail as $j)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $j->data_pegawai->nama }}</td>
                        <td class="text-center">{{ $j->data_pegawai->divisi->divisi }}</td>
                        <td class="text-center">{{ $j->data_pegawai->posisi }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-6">
            <p class="ms-3">Penyelenggara : </p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'internal' ? 'checked' : '' }}> Internal</p>
            <p class="ms-3"><input type="checkbox" name="" id=""
                    {{ $jadwal->penyelenggara == 'eksternal' ? 'checked' : '' }}> Eksternal</p>

        </div>
        <div class="col-6">
            <p>Banjarmasin , {{ date('d-m-Y') }}</p>
            <br>
            (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
        </div>
    </div>
</x-hccp-print>
