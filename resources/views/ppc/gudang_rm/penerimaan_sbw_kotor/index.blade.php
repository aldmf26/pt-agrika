<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end gap-2">
                <div>

                </div>
                <div>
                    {{-- <a href="{{ route('ppc.gudang-rm.3.create') }}" class="btn btn-sm btn-primary"><i
                            class="fas fa-plus"></i>
                        Penerimaan Sbw Kotor</a> --}}
                </div>
            </div>

            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis</th>
                        <th>No Lot</th>
                        <th>Partai</th>
                        <th>Tanggal Penerimaan</th>
                        <th>No Kendaraan</th>
                        <th>Pengemudi</th>
                        <th>Jumlah Pcs</th>
                        <th>Jumlah Kg</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penerimaan as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->no_invoice }}</td>

                            <td>{{ substr($d->nm_partai, 3) }}</td>
                            <td>{{ tanggal($d->tgl) }}</td>
                            <td>{{ $d->no_kendaraan }}</td>
                            <td>{{ $d->pengemudi }}</td>
                            <td>{{ number_format($d->pcs, 0) }}</td>
                            <td>{{ number_format($d->kg, 1) }}</td>

                            <td>
                                <a class="btn btn-xs float-end btn-primary" target="_blank"
                                    href="{{ route('ppc.gudang-rm.3.print', ['id' => $d->id, 'nm_partai' => $d->nm_partai]) }}"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
