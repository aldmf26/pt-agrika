<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->barang->nama_barang }}</td>
        </tr>
        <tr>
            <td>Kode Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->barang->kode_barang }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td>{{ tanggal($penerimaan->tanggal_penerimaan) }}</td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>{{ $penerimaan->supplier->nama_supplier }}</td>
        </tr>
        <tr>
            <td>No Kendaraan</td>
            <td>:</td>
            <td>{{ $penerimaan->no_kendaraan }}</td>
        </tr>
        <tr>
            <td>Pengemudi</td>
            <td>:</td>
            <td>{{ $penerimaan->pengemudi }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->jumlah_barang }}</td>
        </tr>
        <tr>
            <td>Jumlah Sampel</td>
            <td>:</td>
            <td>{{ $penerimaan->jumlah_sampel }}</td>
        </tr>
    </table>

    <table class="mt-4 table table-xs table-bordered">
        <thead>
            <tr>
                <th></th>
                <th colspan="10">KODE LOT : {{ $penerimaan->kode_lot }}</th>
            </tr>
            <tr>
                <th>Kriteria Penerimaan </th>
                @for ($i = 1; $i < 3; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan->kriteria as $kriteria)
                <tr>
                    <th>{{ ucfirst($kriteria->kriteria) }}
                    </th>
                    <td class="text-center">{!! $kriteria->check_1 ? '√' : '' !!}</td>
                    <td class="text-center">{!! $kriteria->check_2 ? '√' : '' !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Keputusan: <br>
    <div class="ms-5">
        <input disabled @checked($penerimaan->keputusan == 'Diterima') type="checkbox" name="keputusan" value="Diterima" required> Diterima
        <br>
        <input disabled @checked($penerimaan->keputusan == 'Ditolak') type="checkbox" name="keputusan" value="Ditolak" required> Ditolak
        <br>
    </div>
    </p>
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
                            <td class="text-center">[ADM. GUDANG]</td>
                            <td class="text-center">[KA. GUDANG]</td>
                            <td class="text-center">[DIREKTUR]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
