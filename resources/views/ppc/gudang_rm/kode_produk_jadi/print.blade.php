<x-hccp-print :title="$title" :dok="$dok">

    <table width="100%" class="border-dark table table-xs table-bordered">
        <tr>
            <th class="head text-center">Nama Barang</th>
            <th class="head text-center">Jenis Barang</th>
            <th class="head text-center">Kode Barang</th>
            <th class="head text-center">Satuan</th>
            <th class="head text-center">Ket</th>
        </tr>
        @foreach ($datas as $d)
            <tr>
                <td>{{ $d->nama }}</td>
                <td class="text-center">{{ $d->kategori }}</td>
                <td class="text-center">{{ $d->kode }}</td>
                <td class="text-center">{{ $d->satuan }}</td>
                <td class="text-center">{{ $d->ket }}</td>

            </tr>
        @endforeach
    </table>

    <table width="100%">
        <tr>
            <td width="40%">

            </td>
            <td style="width: 60%">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[Leader GDRM]</td>
                            <td class="text-center">[SPV. Logistik]</td>
                            <td class="text-center">[KA.PPIC]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
