<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">

        </div>
        <div class="col-12">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th class="dhead">#</th>
                    <th class="dhead">Nama Karyawan</th>
                    <th class="dhead">Usia</th>
                    <th class="dhead">Jenis Kelamin</th>
                    <th class="dhead">Divisi</th>
                    <th class="dhead">Posisi</th>
                    <th class="dhead">Periode <br> Masa Percobaan</th>
                    <th class="dhead">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ umur($d->tgl_lahir) }}</td>
                        <td>{{ $d->jenis_kelamin }}</td>
                        <td>{{ $d->divisi }}</td>
                        <td>{{ $d->posisi ?? '' }}</td>
                            <td>{{ $d->status_karyawan ?? 'Dilanjutkan' }} Bulan</td>
                        </td>
                        <td class="d-flex gap-1">
                            {{-- <a target="_blank" href="{{ route('hrga2.2.penilaian', $d->id_karyawan) }}"
                                class="btn btn-sm btn-primary">Lihat Penilaian</a> --}}
                            <a target="_blank" href="{{ route('hrga2.2.print', $d->id_karyawan) }}"
                                class="btn btn-sm btn-info">Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</x-app-layout>