<x-app-layout :title="$title">

    <div class="row" x-data="{ checked: [] }">
        <div class="col-lg-12">
            <a href="#" class="float-end btn btn-sm btn-primary"
                @click.prevent="window.location.href = `/hrga/1/3-hasil-evaluasi-karyawan-baru/print?checked=${$data.checked.join(',')}`"><i
                    class="fas fa-print"></i> Print
                <span x-transition x-text="checked.length ? `(${checked.length})` : 'Semua'"></span>
            </a>
        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th class="dhead">No</th>
                        <th class="dhead">Nama karyawan</th>
                        <th class="dhead">No KTP</th>
                        <th class="dhead text-center">Usia</th>
                        <th class="dhead">Jenis <br> kelamin</th>
                        <th class="dhead">Posisi</th>
                        <th class="dhead">Periode <br> Percobaan</th>
                        <th class="dhead">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama ?? '' }}</td>
                            <td>{{ $d->nik ?? '' }}</td>
                            <td class="text-center">
                                @if (isset($d->tgl_lahir))
                                    {{ umur($d->tgl_lahir) }} Tahun
                                @endif
                            </td>
                            <td>{{ $d->jenis_kelamin ?? '' }}</td>
                            <td>{{ $d->posisi ?? '' }}</td>
                            <td>{{ $d->penilaianKaryawan->periode ?? '' }} Bulan</td>
                            <td>
                                <a target="_blank" href="{{ route('hrga1.3.print', $d) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
