<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Tanggal Pemohon</td>
            <td>:</td>
            <td>{{ tanggal($tgl) }}</td>
        </tr>
        <tr>
            <td>Nama Pemohon</td>
            <td>:</td>
            <td>{{ $nama }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $k == 'satu' ? $buktis[0]->departemen : 'Cabut' }}</td>
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
                @if ($k == 'satu')
                    @foreach ($buktis as $d)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ $d->barang->nama_barang ?? '' }}</td>
                            <td align="right">
                                {{ $d->pcs }} {{ $d->barang->satuan ?? '' }}
                            </td>
                            <td align="right">
                                {{ $d->pcs }} {{ $d->barang->satuan ?? '' }}
                            </td>
                            <td>{{ $d->no_lot }}</td>
                            <td align="center">{{ $d->status }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($buktis2 as $d)
                        @php
                            $sbw = DB::table('sbw_kotor')
                                ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                ->where('nm_partai', $d['nm_partai'])
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sbw->nama ?? $d['nm_partai'] }}</td>
                            <td class="text-center">{{ number_format($d['pcs'], 0) }} Pcs /
                                {{ number_format($d['gr'], 0) }} Gr
                            </td>
                            <td class="text-center">{{ number_format($d['pcs'], 0) }} Pcs /
                                {{ number_format($d['gr'], 0) }} Gr
                            </td>
                            <td class="text-center">{{ $sbw->no_invoice }}</td>
                            <td class="text-center">Ok</td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div style="font-size: 12px; margin-top: -10px;">
            <small class="fw-bold">OK : Material / Barang yang diminta dan diterima dalam kondisi baik dan layak
                pakai.</small>
            <br>
            <small class="fw-bold mb-3">TIDAK OK : Material / Barang yang diminta dan diterima dalam kondisi tidak baik
                dan
                tidak layak
                pakai.</small>
            <br><br>
            <small class="fw-bold ">Permintaan diterima Warehouse Material:</small>
            <table>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td class="fw-bold">{{ tanggal($tgl) }}</td>
                </tr>
                <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td class="fw-bold">{{ $k == 'satu' ? $buktis[0]->penerima_wr : 'Sinta' }}</td>
            </table>

            <br>
            <small class="fw-bold mt-2">Penyerahan Barang kepada Pengguna:</small>
            <table>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td class="fw-bold">{{ tanggal($tgl) }}</td>
                </tr>
                <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td class="fw-bold">{{ ucwords($nama) }}</td>
            </table>
        </div>
    </div>

    {{-- <div class="row">

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
                            <td x-text="tgl">{{ tanggal($buktis[0]->tgl) }}</td>
                            <td>
                                {{ $buktis[0]->penerima_wm }}
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
                            <td x-text="tgl">{{ tanggal($buktis[0]->tgl) }}</td>
                            <td>
                                {{ $buktis[0]->penerima_pr }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-3 d-flex justify-content-end flex-column align-items-end mb-3" style="margin-right: -15px">
            <span>Nama</span>
            <span>Tanggal</span>
        </div>
        <div class="col-9">
            <table class="table table-bordered table-xs">
                <tr>
                    <th class="text-center">Pemohon</th>
                    <th class="text-center">Diterima Warehouse Material</th>
                    <th class="text-center">Diterima Pengguna</th>
                </tr>
                <tr>
                    <td class="text-center">
                        <div style="height: 80px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                    <td class="text-center">
                        <div style="height: 10px"></div>
                        <div class=""></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{-- <div class="row">
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
    </div> --}}


</x-hccp-print>
