<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-nowrap">Nama Sarana & Prasarana</th>
                            <th class="text-nowrap">Lokasi</th>
                            <th class="text-nowrap">No identifikasi</th>
                            <th class="text-nowrap">Diajukan</th>
                            <th class="text-nowrap">Deskripsi Masalah</th>
                            <th class="text-nowrap">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->item->nama_item }}</td>
                                <td>{{ $p->item->lokasi->lokasi }}</td>
                                <td>{{ $p->item->no_identifikasi }}</td>
                                <td>{{ $p->diajukan_oleh }}</td>
                                <td>{{ $p->deskripsi_masalah }}</td>
                                <td><a href="{{ route('hrga5.3.print', ['invoice_pengajuan' => $p->invoice_pengajuan]) }}"
                                        class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i>
                                        print</a></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
