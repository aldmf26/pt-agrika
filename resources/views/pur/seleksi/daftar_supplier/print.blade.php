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
                        <td>{{ $d->contact_person }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td>
                            ini produk nya
                        </td>
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
    <div class="row">
        <div class="col-6"></div>
        <div class="col-2"></div>
        <div class="col-4">
            <table class="table table-bordered border-white" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                        </td>
                        <td class="text-center">
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-hccp-print>
