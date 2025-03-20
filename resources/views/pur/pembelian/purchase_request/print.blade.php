<x-hccp-print :title="$title" :dok="$dok">
    <center class="container-sm">
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="table-xs table table-bordered border-dark">
                    <tr>
                        <th width="150" class="head">No Pr</td>
                        <td>{{ $datas->no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal($datas->tgl) }}
                        </td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Dimintai oleh</td>
                        <td>{{ $datas->diminta_oleh }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Posisi</td>
                        <td>{{ $datas->posisi }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Departemen</td>
                        <td>{{ $datas->departemen }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Manager Departemen</td>
                        <td>{{ $datas->manager_departemen }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-1"></div>

            <div class="col-1"></div>
            <div class="col-10">
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
            <div class="col-1"></div>

            <div class="col-1"></div>
            <div class="col-10">
                <span class="float-start" for="">Detail Permintaan</span>
                <table class="table table-xs table-bordered border-dark">
                    <tr>
                        <th class="head text-center">Jumlah</th>
                        <th class="head text-center">Item dan Spesifikasi</th>
                        <th class="head text-center">Tanggal Dibutuhkan</th>
                    </tr>
                    @foreach ($datas->item as $d)
                        <tr>
                            <td align="center">{{ $d->jumlah }}</td>
                            <td align="center">{{ $d->item_spesifikasi }}</td>
                            <td align="center">{{ tanggal($d->tgl_dibutuhkan) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-1"></div>
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="d-flex justify-content-between">
                    <span>
                        Dibuat oleh :
                    </span>
                    <span>Di setujui oleh :
                        <br><br><br>
                        Manager ....
                    </span>
                </div>
                <span class="d-flex justify-content-start text-start">
                    Diterima oleh Purchasing: <br>
                    Nama : <br>
                    Tanggal : <br>
                    Tanda Tangan :
                </span>

            </div>
            <div class="col-1"></div>
        </div>
    </center>
</x-hccp-print>
