<x-app-layout :title="$title">

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Mesin</th>
                        <th>Merek</th>
                        <th>No identifikasi</th>
                        <th>Bulan & Tahun Jadwal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checklist as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->perawatan->item->nama_mesin }}</td>
                            <td>{{ $d->perawatan->item->merek }}</td>
                            <td>{{ $d->perawatan->item->no_identifikasi }}</td>
                            <td>{{ date('m', strtotime($d->tgl)) }}&{{ date('Y', strtotime($d->tgl)) }} </td>
                            <td>
                                @php
                                    $bulan = date('m', strtotime($d->tgl));
                                    $tahun = date('Y', strtotime($d->tgl));
                                @endphp
                                <a href="{{ route('hrga8.2.print', ['id' => $d->perawatan_mesin_id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                    target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print"></i> print</a>
                                <a href="{{ route('hrga8.2.add', ['id' => $d->perawatan_mesin_id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> edit</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
