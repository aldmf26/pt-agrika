<x-hccp-print :title="$title" :dok="$dok" :kategori="$kategori">
    <div class="container-sm">
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="row">
            <div class="col-12">

                <table class="table-xs table table-bordered border-dark">
                    <tr>
                        <th width="150" class="head">Diajukan oleh</td>
                        <td>Sinta</td>
                        <th width="150" class="head">*No PR</td>
                        <td>{{ $no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Posisi</td>
                        <td>KA. Gudang Bahan Baku</td>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal(date('Y-m-d', strtotime('-7 days', strtotime($datas->tgl)))) }}
                        </td>
                    </tr>
                </table>
                <span class="float-start" style="position: relative;font-size: 9px; top: -16px !important">Format
                    nomor PR :
                    PR/Urutan/Bulan/Tahun
                    (ex :
                    PR/1/VI/2025)
                    <span class="ms-2">* :
                        Diisi oleh
                        bagian purchasing</span>
                </span>
            </div>

            <div class="col-12">
                <table class="table-xs table table-bordered border-dark">
                    <tr>
                        <th width="150" class="head">Alasan Permintaan</td>
                    </tr>
                    <tr>
                        <td>
                            Untuk memenuhi kebutuhan proses produksi cabut.
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-12">
                <span class="float-start" for="" style="font-size: 12px;">Detail Permintaan</span>
                <table class="table table-xs table-bordered border-dark">
                    <tr>
                        <th class="head text-center">Jumlah</th>
                        <th class="head text-center">Item</th>
                        <th class="head text-center">Spesifikasi</th>
                        <th class="head text-center">Tanggal Dibutuhkan</th>
                    </tr>
                    @foreach ($items as $d)
                        <tr>
                            <td class="text-end">{{ number_format($d->jumlah_pcs) }} PCS /
                                {{ number_format($d->jumlah_kg) }} KG</td>
                            <td align="center">{{ strtoupper($d->nama) }}</td>
                            <td align="center">-</td>
                            <td class="text-end">{{ tanggal($datas->tgl) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{-- <div class="col-12 mb-5" style="font-size: 12px;">
                Diterima oleh Purchasing: <br>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>Tasya Salsabila</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td> {{ tanggal(date('Y-m-d', strtotime('-7 days', strtotime($datas->tgl)))) }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tanda Tangan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </div> --}}
            <div class="col-3"></div>
            <div class="col-9">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Diajukan Oleh:</th>
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
                            <td style="height: 80px" class="text-center align-middle">
                                <span style="opacity: 0.5;">(Ttd & Nama)</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                (KA. GUDANG BAHAN BAKU)
                            </td>
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

        </center>
</x-hccp-print>
