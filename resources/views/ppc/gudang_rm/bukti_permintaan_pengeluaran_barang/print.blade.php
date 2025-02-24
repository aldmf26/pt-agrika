<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Tanggal Pemohon</td>
            <td>:</td>
            <td>{{ tanggal($buktis[0]->tgl) }}</td>
        </tr>
        <tr>
            <td>Nama Pemohon</td>
            <td>:</td>
            <td>{{ $buktis[0]->nama }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $buktis[0]->departemen }}</td>
        </tr>




    </table>

    <div class="row mt-4">
        <table class="table table-bordered table-xs border-dark">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Nama Barang | Satuan</th>
                    <th class="text-center align-middle" colspan="2">Jumlah</th>
                    <th class="text-center align-middle" rowspan="2">Kode Lot SBW</th>
                    <th class="text-center align-middle" rowspan="2">Status Ok/Tidak Ok</th>
                </tr>
                <tr>
                    <th class="text-center">Diminta Pcs/Gr</th>
                    <th class="text-center">Diterima Pcs/Gr</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buktis as $d)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $d->barang->nama_barang ?? '' }} | {{ $d->barang->satuan ?? '' }}</td>
                        <td align="right">
                                {{ $d->pcs }} pcs
                                {{ $d->gr }} gr
                        </td>
                        <td align="right">
                                {{ $d->pcs }} pcs
                                {{ $d->gr }} gr
                        </td>
                        <td>{{ $d->no_lot }}</td>
                        <td align="center">{{ $d->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="row">

        <div class="col-6">
            <span class="text-xs">Permintaan diterima Warehouse Material:</span>
            <div class="mb-3">
                <table class="table table-xs table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td x-text="tgl">{{  tanggal($buktis[0]->tgl)  }}</td>
                            <td>
                                {{$buktis[0]->penerima_wm}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <span class="text-xs">Penyerahan Barang kepada Produksi:</span>
            <div class="mb-3">
                <table class="table table-xs table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td x-text="tgl">{{  tanggal($buktis[0]->tgl)  }}</td>
                            <td>
                                {{$buktis[0]->penerima_pr}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-4">
            <span class="text-xs">Disetujui Oleh</span>
            <div class="mb-3">
                <div style="height: 80px"></div>
                <div class="">Tanda tangan</div>
            </div>
        </div>
        <div class="col-4">
            <span class="text-xs">Diterima Warehouse Material</span>
            <div class="mb-3">
                <div style="height: 80px"></div>
                <div class="">Tanda tangan</div>
            </div>
        </div>
        <div class="col-4">
            <span class="text-xs">Diterima Produksi</span>
            <div class="mb-3">
                <div style="height: 80px"></div>
                <div class="">Tanda tangan</div>
            </div>
        </div>
    </div>


</x-hccp-print>
