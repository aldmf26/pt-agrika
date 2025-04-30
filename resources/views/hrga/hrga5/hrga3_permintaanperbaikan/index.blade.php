<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-end" href="{{ route('hrga5.3.formPermintaanperbaikan') }}" target="_blank"><i
                    class="fas fa-plus"></i>
                add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-nowrap">Nama sarana & prasarana</th>
                            <th class="text-nowrap">lokasi</th>
                            <th class="text-nowrap">No identifikasi</th>
                            <th class="text-nowrap">Diajukan</th>
                            <th class="text-nowrap">Deskripsi masalah</th>
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
                                <td>{{ ucfirst(strtolower($p->diajukan_oleh)) }}</td>
                                <td>{{ ucfirst(strtolower($p->deskripsi_masalah)) }}</td>
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
