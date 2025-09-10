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
                        <th width="150" class="head">Dimintai oleh</td>
                        <td>{{ Auth::user()->name }}</td>
                        <th width="150" class="head">*No PR</td>
                        <td>{{ $no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Posisi</td>
                        <td>BK</td>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal(date('Y-m-d', strtotime('-7 days', strtotime($datas->tgl)))) }}
                        </td>
                    </tr>
                </table>
                <span class="float-start" style="position: relative;font-size: 9px; top: -16px !important">Format
                    nomor PR :
                    PR/Urutan/
                    Bulan
                    / tahun
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
                <span class="float-start" for="">Detail Permintaan</span>
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
                            <td align="center">{{ ucfirst($d->nama) }}</td>
                            <td align="center">-</td>
                            <td class="text-end">{{ tanggal($datas->tgl) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-12 mb-5">
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
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <span>
                        Dibuat oleh :
                        <br>
                        <span style="left: -80px !important; position: relative;">
                            <x-ttd jabatan="bk" />
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
