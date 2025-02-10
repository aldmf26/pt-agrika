<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Mesin</th>
                        <th>Lokasi</th>
                        <th>No Mesin</th>
                        <th>Deadline</th>
                        <th>Diajukan oleh</th>
                        <th>Deskripsi Masalah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->item_mesin->nama_mesin }}</td>
                            <td>{{ $p->item_mesin->lokasi->lokasi }}</td>
                            <td>{{ $p->item_mesin->no_identifikasi }}</td>
                            <td>{{ $p->deadline }}</td>
                            <td>{{ $p->diajukan_oleh }}</td>
                            <td>{{ $p->deskripsi_masalah }}</td>
                            <td><a target="_blank"
                                    href="{{ route('hrga8.3.print', ['invoice_pengajuan' => $p->invoice_pengajuan]) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
