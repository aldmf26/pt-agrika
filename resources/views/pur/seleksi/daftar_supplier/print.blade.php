<x-hccp-print :title="$title" :dok="$dok">
    <table class="table-xs">
        <tr>
            <th>Tanggal Update</th>
            <th>:
                {{ tanggal(date('Y-m-d')) }}
            </th>
        </tr>
        <tr>
            <th>Jenis Supplier</th>
            <th>: {{ $jenis_supplier }}</th>
        </tr>
    </table>

    @if ($k == 'satu')
        <table class="table table-xs border-dark table-bordered">
            <thead>
                <tr>
                    <th class="head text-center align-middle">No</th>
                    <th class="head text-center align-middle">Nama Supplier</th>
                    <th class="head text-center align-middle">Alamat Supplier</th>
                    <th class="head text-center align-middle">Contact Person</th>
                    <th class="head text-center align-middle">Nomor Telpon</th>
                    <th class="head text-center align-middle">Jenis Produk / Layanan</th>
                    <th class="head text-center align-middle">Hasil Evaluasi Rutin</th>
                    <th class="head text-center align-middle">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_supplier }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->contact_person }}</td>
                        <td>{{ $d->no_telp }}</td>
                        <td>
                            <ul style="list-style-type: none; padding: 0; margin: 0">
                                @foreach ($d->barang as $index => $b)
                                    <li>{{ $index + 1 }}. {{ $b->nama_barang }}</li>
                                @endforeach
                            </ul>
                        </td>


                        <td class="text-end">{{ $d->hasil_evaluasi ?? 0 }}</td>
                        <td>{{ $d->ket }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class="table table-xs border-dark table-bordered mt-2">
            <thead>
                <tr>
                    <th class="head text-center align-middle">No</th>
                    <th class="head text-center align-middle">Nama Supplier</th>
                    <th class="head text-center align-middle">Alamat Supplier</th>
                    <th class="head text-center align-middle">Contact Person</th>
                    <th class="head text-center align-middle">Nomor Telpon</th>
                    <th class="head text-center align-middle">Jenis Produk / Layanan</th>
                    <th class="head text-center align-middle">Hasil Evaluasi Rutin</th>
                    <th class="head text-center align-middle">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rumah_walet as $d)
                    <tr>
                        <td class="text-end">{{ $loop->iteration }}</td>
                        <td>{{ ucwords($d->nama) }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td></td>
                        <td></td>
                        <td>SBW Kotor</td>
                        <td class="text-end">100</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            (STAFF PURCHASING)
                        </td>
                        <td class="text-center align-middle">
                            (KA. PURCHASING)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-hccp-print>
