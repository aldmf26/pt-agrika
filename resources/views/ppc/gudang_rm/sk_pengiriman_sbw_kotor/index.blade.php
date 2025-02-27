<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('ppc.gudang-rm.4.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Sk Pengiriman Sbw Kotor</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama/ No. Registrasi Rumah Walet</th>
                <th>Alamat Rumah Walet</th>
                <th>Tujuan IKH</th>
                <th>No. Registrasi IKPH</th>
                <th>Alamat IKPH</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sk as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->rumahWalet->no_reg }}</td>
                    <td>{{ $d->rumahWalet->alamat }}</td>
                    <td>{{ $d->tujuan_ikph }}</td>
                    <td>{{ $d->ikph->no_registrasi_ikph }}</td>
                    <td>{{ $d->ikph->alamat_ikph }}</td>
                    <td>{{ tanggal($d->tanggal_sk_pengiriman) }}</td>
                    <td>
                        <a class="btn btn-xs float-end btn-primary" href="{{ route('ppc.gudang-rm.4.print', $d->id_penerimaan) }}"><i
                                class="fas fa-print"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
