<x-hccp-print :title="$title" :dok="$dok">
    <center>
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="text-start">
            <strong>To:</strong> {{ $datas->supplier }}<br>
            <strong>Tanggal:</strong> {{ tanggal($datas->tgl) }}
        </div>
        <div class="text-start">
            <strong>No PO:</strong> {{ $datas->no_po }}
        </div>
        <br>

        <div>
            <table class="table table-xs table-bordered border-dark">
                <tr>
                    <th class="head text-center">Jumlah</th>
                    <th class="head text-center">Item dan Spesifikasi</th>
                    <th class="head text-center">Harga</th>
                </tr>
                @foreach ($datas->item as $d)
                    <tr>
                        <td align="center">{{ $d->jumlah }}</td>
                        <td align="center">{{ $d->item_spesifikasi }}</td>
                        <td align="center">{{ number_format($d->harga_po, 0) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="head text-end">Total harga</td>
                    <td align="center">{{ number_format($datas->item->sum('harga_po'), 0) }}</td>
                </tr>
            </table>
        </div>

        <div class="text-start">
            <strong>Barang/Jasa di atas harap dikirimkan ke Alamat sebagai berikut :</strong>
            <br>
            {{ $datas->alamat_pengiriman }}
            <br>
            PIC: {{ $datas->pic }}
            <br>
            Telp: {{ $datas->telp }}
            <br>
            Estimasi Kedatangan Barang: {{ tanggal($datas->estimasi_kedatangan) }}
        </div>

        <br>

        <div class="d-flex justify-content-between">
            <span>
                Dibuat oleh :
            </span>
            <span>Di setujui oleh :
                <br>
                <x-ttd/>
                <br>
                <span style="font-size:10px">Sertakan cap perusahaan</span>
            </span>
            <span>
                Diterima oleh :
                <br><br><br>
                <span style="font-size:10px">Sertakan cap perusahaan</span>
            </span>
        </div>
    </center>
</x-hccp-print>
