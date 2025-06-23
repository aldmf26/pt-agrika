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
            <td>{{ $penerimaan->kode_lot }}</td>
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
    <div class="row">
        <div class="col-4">
            <p>Keputusan: <br>
            <div class="ms-2" style="font-size: 11px">
                <input @checked($penerimaan->keputusan == 'Diterima') type="checkbox" name="keputusan" value="Diterima" required>
                Diterima
                <br>
                <input @checked($penerimaan->keputusan == 'Ditolak') type="checkbox" name="keputusan" value="Ditolak" required>
                Ditolak
                <br>
                <input @checked(str_contains($penerimaan->keputusan, 'Catatan')) type="checkbox" name="keputusan" value="Diterima dengan Catatan"
                    required> {{ $penerimaan->keputusan }}
            </div>
            </p>
        </div>
        <div class="col-8">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50%;">Dibuat Oleh:</th>
                        <th class="text-center" style="width: 50%;">Diperiksa Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <x-ttd />
                        </td>
                        <td>
                            {{-- jika ada ttd kepala gudang bisa tambahkan x-ttd2 --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">[ADM. GUDANG]</td>
                        <td class="text-center">[KA. GUDANG]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-hccp-print>
