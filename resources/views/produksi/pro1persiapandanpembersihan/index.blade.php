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
                            <td>{{ tanggal($b->tgl) }}</td>
                            <td>{{ ucfirst(strtolower($b->nama_petugas)) }}</td>
                            <td>{{ number_format($b->pcs, 0) }}</td>
                            <td>{{ number_format($b->gr, 0) }}</td>
                            <td class="text-center">
                                @php

                                    $pengawas = $b->nama_petugas;
                                    $tgl = $b->tgl;
                                @endphp
                                <a href="{{ route('produksi.1.print', ['pengawas' => $pengawas, 'tgl' => $tgl]) }}"
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
