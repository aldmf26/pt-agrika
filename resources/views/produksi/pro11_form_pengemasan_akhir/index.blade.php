<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal</th>
                                <th>Pcs</th>
                                <th>Gr</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengiriman_akhir as $p)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ tanggal($p['tgl_input']) }}</td>
                                    <td>{{ number_format($p['pcs'], 0) }}</td>
                                    <td>{{ number_format($p['gr'], 0) }}</td>
                                    <td class="text-center"><a
                                            href="{{ route('produksi.11.print', ['tgl' => $p['tgl_input']]) }}"
                                            target="_blank" class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                            Print</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
