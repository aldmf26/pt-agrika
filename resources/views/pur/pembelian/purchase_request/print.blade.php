<x-hccp-print :title="$title" :dok="$dok">
    <div class="container-sm">
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="row">
            <div class="col-12">
                <span style="font-size: 9px; bottom: 36px !important">Format nomor PR : PR/Urutan/ Bulan / tahun
                    (ex :
                    PR/01/VI/2025)
                    <span class="ms-2">* :
                        Diisi oleh
                        bagian purchasing</span>
                </span>
                <table class="table-xs table table-bordered border-dark">
                    {{-- <tr>
                        <th width="150" class="head">No Pr</td>
                        <td>{{ $datas->no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal($datas->tgl) }}
                        </td>
                    </tr> --}}
                    <tr>
                        <th width="150" class="head">Dimintai oleh</td>
                        <td>{{ $datas->diminta_oleh }}</td>
                        <th width="150" class="head">No PR</td>
                        <td>{{ $datas->no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Posisi</td>
                        <td>{{ $datas->posisi }}</td>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal($datas->tgl) }}
                        </td>
                    </tr>
                </table>
            </div>


            <div class="col-12">
                <table class="table-xs table table-bordered border-dark">
                    <tr>
                        <th width="150" class="head">Alasan Permintaan</td>
                    </tr>
                    <tr>
                        <td>
                            {{ $datas->alasan_permintaan }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-12">
                <span class="float-start" for="">Detail Permintaan</span>
                <table class="table table-xs table-bordered border-dark">
                    <tr>
                        <th class="head text-end">Jumlah</th>
                        <th class="head text-start">Item dan Spesifikasi</th>
                        <th class="head text-end">Tanggal Dibutuhkan</th>
                    </tr>
                    @foreach ($datas->item as $d)
                        <tr>
                            <td class="text-end">{{ number_format($d->jumlah, 0) }} {{ $d->barang->satuan }}</td>
                            <td align="start">{{ ucfirst($d->item_spesifikasi) }}</td>
                            <td class="text-end">{{ tanggal($d->tgl_dibutuhkan) }}</td>
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
                            <x-ttd />
                        </span>
                        <br>
                    </span>

                    <span><span style="right: -80px !important; position: relative;">Di setujui oleh :</span>
                        <br>
                        <span>
                            <x-ttd-ketua userId="468" />
                        </span>
                        <br>
                    </span>
                </div>

            </div>
        </div>
        
        </center>
</x-hccp-print>
