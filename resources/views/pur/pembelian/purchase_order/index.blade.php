<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('pur.pembelian.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Purchase Order</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>No PO</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Alamat Pengiriman</th>
                <th>PIC</th>
                <th>Telp</th>
                <th>Estimasi</th>
                <td class="text-center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->no_po }}</td>
                    <td>{{ tanggal($d->tgl) }}</td>
                    <td>{{ $d->supplier }}</td>
                    <td>{{ $d->alamat_pengiriman }}</td>
                    <td>{{ $d->pic }}</td>
                    <td>{{ $d->telp }}</td>
                    <td>{{ tanggal($d->estimasi_kedatangan) }}</td>
                        <td>
                            <a class="btn btn-xs float-end btn-primary" href="{{route("pur.pembelian.2.print", $d->id)}}"><i class="fas fa-print"></i></a>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>
