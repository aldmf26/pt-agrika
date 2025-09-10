<x-hccp-print :title="$title" :dok="$dok" :kategori="$kategori">
    <center class="container-sm">

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
                        <td><strong>*No PO</strong></td>
                        <td>:</td>
                        <td>{{ $no_po }}</td>
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
            <span class="float-start" style="font-size: 9px;">Format
                nomor PO :
                PO/Urutan/
                Bulan
                / tahun
                (ex :
                PO/01/VI/2025)

            </span>
            <table class="table table-xs table-bordered border-dark">
                <tr>
                    <th class="head text-center">Jumlah</th>
                    <th class="head text-center">Item dan Spesifikasi</th>
                    <th class="head text-center">Harga</th>
                </tr>
                @foreach ($items as $d)
                    <tr>
                        <td class="text-end">{{ number_format($d->jumlah_pcs) }} PCS /
                            {{ number_format($d->jumlah_kg) }} GR</td>
                        <td align="center">{{ ucfirst($d->nama) }}</td>
                        <td class="d-flex justify-content-between">
                            <div>Rp. </div>
                            <div>1</div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="head text-end">Total Harga</td>
                    <td class="d-flex justify-content-between">
                        <div>Rp. </div>
                        <div>1</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="text-start">
            <strong>Barang/Jasa di atas harap dikirimkan ke Alamat sebagai berikut :</strong>
            <br>
            Jl. Teluk Tiram Darat No.5B Kel Telawang, Kec. Banjarmasin Barat, Kota Banjarmasin, Kalimantan Selatan
            <div class="mt-2" />
            <span>PIC: Tasya Salsabila</span>
            <br>
            Telp: 08
            <br>
            Estimasi Kedatangan Barang:
            {{ tanggal(date('Y-m-d', strtotime('+2 days', strtotime($datas->tgl)))) }}
        </div>

        <br>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <span>
                        Dibuat oleh :
                        <br>
                        <span style="left: -80px !important; position: relative;">
                            <x-ttd jabatan="staff purchasing" />
                        </span>
                        <br>
                    </span>

                    <span><span style="right: -80px !important; position: relative;">Di setujui oleh :</span>
                        <br>
                        <span>
                            <x-ttd-ketua jabatan="purchasing" userId="468" />
                        </span>
                        <br>
                    </span>
                </div>

            </div>
        </div>
    </center>
</x-hccp-print>
