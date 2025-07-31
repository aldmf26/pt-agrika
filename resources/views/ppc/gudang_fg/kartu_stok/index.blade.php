<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th class="text-end">Pcs</th>
                                <th class="text-end">Gr</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kartu as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d['grade'] }}</td>
                                    <td>{{ number_format($d['pcs'] - $d['pcs_akhir'], 0) }}</td>
                                    <td>{{ number_format($d['gr'] - $d['gr_akhir'], 0) }}</td>
                                    <td>
                                        <a class="btn btn-xs  btn-primary" target="_blank"
                                            href="{{ route('ppc.gudang-fg.4.print', ['grade' => $d['grade']]) }}"><i
                                                class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
