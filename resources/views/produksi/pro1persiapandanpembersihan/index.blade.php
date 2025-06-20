<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Pengawas</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bk as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($b['tgl']) }}</td>
                            <td>{{ ucfirst(strtolower($b['name'])) }}</td>
                            <td>{{ number_format($b['pcs'], 0) }}</td>
                            <td>{{ number_format($b['gr_awal'], 0) }}</td>
                            <td class="text-center">
                                @php

                                    $id = $b['id'];
                                    $pengawas = $b['name'];
                                    $tgl = $b['tgl'];
                                @endphp
                                <a href="{{ route('produksi.1.print', ['id_pengawas' => $id, 'pengawas' => $pengawas, 'tgl' => $tgl]) }}"
                                    target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i>
                                    print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
