<x-hccp-print :title="$title" :kategori="$kategori" :dok="$dok">
    <center class="container-sm">
        <style>
            table {
                font-family: 'arial'
            }
        </style>

        <div class="d-flex justify-content-between" style="font-size: 12px">
            <div>
                <strong>To:</strong> {{ $datas->item[0]->barang->supplier->nama_supplier }}<br>
            </div>
            <div>
                <table style="width: 100%">
                    <tr>
                        <td><strong>*No PO</strong></td>
                        <td>:</td>
                        <td>{{ $datas->no_po }}</td>
                    </tr>
                    <tr>
                        <td style="width: 100px"><strong>Tanggal</strong></td>
                        <td style="width: 10px">:</td>
                        <td>{{ tanggal($datas->tgl) }}</td>
                    </tr>
                    <tr>
                        <td class="text-start" colspan="3" style="width: 100px"><span style="font-size: 11px;"
                                class="ms-2">* :
                                Diisi oleh
                                bagian purchasing</span></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div>
            <span class="float-start" style="font-size: 9px;"">Format nomor PO : PO/Urutan/Bulan/Tahun
                (ex :
                PO/1/VI/2025)

            </span>
            <table class="table table-xs table-bordered border-dark">
                <tr>
                    <th class="head text-center">Jumlah</th>
                    <th class="head text-center">Item</th>
                    <th class="head text-center">Spesifikasi</th>
                    <th class="head text-center">Harga</th>
                </tr>
                @foreach ($datas->item as $d)
                    <tr>
                        <td class="text-end">{{ number_format($d->jumlah, 0) }} {{ $d->barang->satuan }}</td>
                        <td align="center">{{ ucfirst($d->item_spesifikasi) }}</td>
                        <td align="center">{{ ucfirst($d->barang->spek) }}</td>
                        <td class="text-end d-flex justify-content-between">
                            <div>Rp. </div>
                            <div>{{ number_format($d->harga_po, 0) }}</div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="head text-end">Total Harga</td>
                    <td class="text-end d-flex justify-content-between">
                        <div>Rp. </div>
                        <div>{{ number_format($datas->item->sum('harga_po'), 0) }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="text-start" style="font-size: 12px;">
            <strong>Barang di atas harap dikirimkan ke alamat sebagai berikut :</strong>
            <br>
            Jl. Teluk Tiram Darat No.5B Kel Telawang, Kec. Banjarmasin Barat, Kota Banjarmasin, Kalimantan Selatan
            <div class="mt-2" />
            PIC: {{ $kepalaPurchasing }}
            <br>
            Telp: {{ $telp }}
            <br>
            Estimasi kedatangan barang: {{ tanggal($datas->estimasi_kedatangan) }}
        </div>
    </center>
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
                            <div>Sertakan cap perusahaan</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
