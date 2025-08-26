<x-app-layout :title="$title">

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr style="text-transform: capitalize">
                        <th>#</th>
                        <th>Lantai</th>
                        <th>Nama Mesin</th>
                        <th>Jumlah</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checklist as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($d->item->lokasi->lantai)) }}</td>
                            <td>{{ ucfirst(strtolower($d->item->nama_mesin)) }}</td>
                            <td>{{ $d->item->jumlah }}</td>
                            <td>{{ ucfirst(strtolower($d->item->lokasi->lokasi)) }}</td>
                            <td>
                                {{-- @php
                                    $bulan = date('m', strtotime($d->tgl));
                                    $tahun = date('Y', strtotime($d->tgl));
                                @endphp --}}
                                <a href="{{ route('hrga8.2.print', ['id' => $d->item_mesin_id]) }}" target="_blank"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</a>
                                {{-- <a href="{{ route('hrga8.2.add', ['id' => $d->item_mesin_id]) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> edit</a> --}}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
