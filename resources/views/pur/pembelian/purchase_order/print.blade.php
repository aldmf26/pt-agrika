<x-hccp-print :title="$title" :dok="$dok">
    <center>
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="d-flex justify-content-between">
            <div>
                <strong>To:</strong> {{ $datas->supplier }}<br>
            </div>
            <div>
                <table style="width: 100%">
                    <tr>
                        <td style="width: 100px"><strong>Tanggal</strong></td>
                        <td style="width: 10px">:</td>
                        <td>{{ tanggal($datas->tgl) }}</td>
                    </tr>
                    <tr>
                        <td><strong>No PO</strong></td>
                        <td>:</td>
                        <td>{{ $datas->no_po }}</td>
                    </tr>
                </table>
            </div>
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
            Jl. Teluk Tiram Darat No.5B Kel Telawang, Kec. Banjarmasin Barat, Kota Banjarmasin, Kalimantan Selatan
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
                <span style="left: -80px !important; position: relative;">
                    Dibuat oleh :
                    <x-ttd />
                </span>
                <br>
            </span>
            <span>Di setujui oleh :
                <br>
                <br>
                <br>
                <span style="font-size:10px">Sertakan cap perusahaan</span>
                <br>
                Gt Andriy Wijaya
            </span>
        </div>
    </center>
</x-hccp-print>
