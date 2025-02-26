<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
            
        </div>
        <div>
            <a href="{{ route('ppc.gudang-rm.3.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Penerimaan Sbw Kotor</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis</th>
                <th>No Lot</th>
                <th>Tanggal Penerimaan</th>
                <th>Alamat Rumah Walet</th>
                <th>No Kendaraan</th>
                <th>Pengemudi</th>
                <th>Jumlah Pcs</th>
                <th>Jumlah Gr</th>
                <th>No Reg Rumah Walet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->jenis }}</td>
                    <td>{{ $d->no_lot }}</td>
                    <td>{{ tanggal($d->tgl_penerimaan) }}</td>
                    <td>{{ $d->alamat_rumah_walet }}</td>
                    <td>{{ $d->no_kendaraan }}</td>
                    <td>{{ $d->pengemudi }}</td>
                    <td>{{ $d->jumlah_pcs }}</td>
                    <td>{{ $d->jumlah_gr }}</td>
                    <td>{{ $d->noreg_rumah_walet }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary"
                        href="{{ route('ppc.gudang-rm.3.print', $d->id) }}"><i class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
