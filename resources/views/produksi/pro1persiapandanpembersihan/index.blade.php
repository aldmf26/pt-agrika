<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">No Invoice</th>
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
                            <td class="text-center">{{ $b['no_invoice'] }}</td>
                            <td>{{ tanggal($b['tanggal']) }}</td>
                            <td>{{ $b['name'] }}</td>
                            <td>{{ number_format($b['pcs'], 0) }}</td>
                            <td>{{ number_format($b['gr_awal'], 0) }}</td>
                            <td class="text-center">
                                @php
                                    $no_invoice = $b['no_invoice'];
                                    $pengawas = $b['name'];
                                    $tgl = $b['tanggal'];
                                @endphp
                                <a href="{{ route('produksi.1.print', ['no_invoice' => $no_invoice, 'pengawas' => $pengawas, 'tgl' => $tgl]) }}"
                                    target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
