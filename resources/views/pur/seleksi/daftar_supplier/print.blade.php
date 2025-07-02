<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <th>Tanggal Update</th>
            <th>: {{ $datas->last()->updated_at->format('j F Y') }}</th>
        </tr>
        @if ($k == 'sbw')
            <tr>
                <th>Jenis Supplier</th>
                <th>: Supplier Material SBW</th>
            </tr>
        @endif

    </table>

    @if ($k == 'satu')
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
    @else
        <table class="table table-xs border-dark table-bordered">
            <thead>
                <tr>
                    <th class="head text-center">No</th>
                    <th class="head text-center">Nama Supplier</th>
                    <th class="head text-center">Alamat Supplier</th>
                    <th class="head text-center">Nama Contact Person</th>
                    <th class="head text-center">Nomor KTP</th>
                    <th class="head text-center">No Telp</th>
                    <th class="head text-center">Hasil Evaluasi Rutin</th>
                    <th class="head text-center">Keterangan</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rumah_walet as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


</x-hccp-print>
