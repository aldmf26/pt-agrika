<x-hccp-print :title="$title" :dok="$dok">
    <div class="container-sm">
        <style>
            table {
                font-family: 'arial'
            }
        </style>
        <div class="row">
            <div class="col-12">

                <table class="table-xs table table-bordered border-dark">
                    @php
                        $jabatan = $datas->posisi;
                    @endphp
                    <tr>
                        <th width="150" class="head">Diajukan oleh</td>
                        <td>{{ $datas->diminta_oleh }}</td>
                        <th width="150" class="head">*No PR</td>
                        <td>{{ $datas->no_pr }}</td>
                    </tr>
                    <tr>
                        <th width="150" class="head">Posisi</td>
                        <td>{{ $jabatan }}</td>
                        <th width="150" class="head">Tanggal</td>
                        <td>
                            {{ tanggal($datas->tgl) }}
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
                            {{ $datas->alasan_permintaan }}
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
                    @foreach ($datas->item as $d)
                        <tr>
                            <td class="text-end">{{ number_format($d->jumlah, 0) }} {{ $d->barang->satuan }}</td>
                            <td align="start">{{ ucfirst($d->item_spesifikasi) }}</td>
                            <td align="start">{{ ucfirst($d->barang->spek) }}</td>
                            <td class="text-end">{{ tanggal($d->tgl_dibutuhkan) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{-- 
            <div class="col-12 mb-5" style="font-size: 12px;">
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
                        <td> {{ tanggal($datas->tgl) }}
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
                                <x-ttd-barcode :id_pegawai="pengawasTtd($datas->diminta_oleh)->karyawan_id_dari_api" />
                            </td>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('STAFF PURCHASING')" />
                            </td>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('KEPALA PURCHASING')" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                ({{ $jabatan }})
                            </td>
                            <td class="text-center align-middle">
                                (STAFF PURCHASING)
                            </td>
                            <td class="text-center align-middle">
                                (KEPALA PURCHASING)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        </center>
</x-hccp-print>
