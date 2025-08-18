<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">


        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemanasan as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ tanggal($p['tgl']) }}</td>
                            <td>{{ number_format($p['pcs'], 0) }}</td>
                            <td>{{ number_format($p['gr'], 0) }}</td>
                            <td class="text-center"><a href="{{ route('produksi.9.print', ['tgl' => $p['tgl']]) }}"
                                    target="_blank" class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    Print</a></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    <!-- Modal -->


</x-app-layout>
