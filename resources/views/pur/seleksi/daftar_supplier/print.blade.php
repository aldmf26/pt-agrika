<x-hccp-print :title="$title" :dok="$dok">
    <span class="text-sm">Tanggal Update :  {{ $datas->last()->updated_at->format('j F Y') }}</span>
    
    <table class="table table-xs border-dark table-bordered">
        <thead>
            <tr>
                <th class="head">No</th>
                <th class="head">Nama Supplier</th>
                <th class="head">Alamat Supplier</th>
                <th class="head">Produsen</th>
                <th class="head">Contact Person</th>
                <th class="head">No Telp</th>
                <th class="head">Jenis Produk / Layanan</th>
                <th class="head">Hasil Evaluasi</th>
                <th class="head">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_supplier }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->produsen }}</td>
                    <td>{{ $d->contact_person }}</td>
                    <td>{{ $d->no_telp }}</td>
                    <td>{{ $d->kategori }}</td>
                    <td>{{ $d->hasil_evaluasi }}</td>
                    <td>{{ $d->ket }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-hccp-print>

