<x-hccp-print :title="$title" :kategori="$kategori == 'lainnya' ? 'SBW' : $kategori" :dok="$dok">
    <table class="table-xs">
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
            @php
                $ttdJabatan = $kategori == 'lainnya' ? 'KEPALA GUDANG BAHAN BAKU' : 'KEPALA PURCHASING';
                $pengawas = $kategori == 'kemasan' ? 'Packing' : 'Cabut Bulu';
            @endphp

            <td>Departemen</td>
            <td>:</td>
            <td>{{ $kategori != 'lainnya' ? ucwords(strtolower($departemen)) : 'Cabut Bulu' }}</td>
        </tr>
    </table>

    <div class="row mt-4">
        <table class="table table-bordered table-xs border-dark">
            <thead>
                <tr>
                    <th class="text-center align-middle" rowspan="2">No</th>
                    <th class="text-center align-middle" rowspan="2">Nama Jenis Produk</th>
                    <th class="text-center align-middle" colspan="2">Jumlah</th>
                    <th class="text-center align-middle" rowspan="2">Kode Lot</th>
                    <th class="text-center align-middle" rowspan="2">Status <br> Ok/Not Ok</th>
                </tr>
                <tr>
                    <th class="text-center">Diminta (Pcs/Gr)</th>
                    <th class="text-center">Diterima (Pcs/Gr)</th>
                </tr>
            </thead>
            <tbody>
                @if ($kategori != 'lainnya')
                    @foreach ($buktis as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($d->barang->nama_barang ?? '')) }}</td>
                            <td class="text-end">
                                {{ $d->pcs }} {{ $d->barang->satuan ?? '' }}
                            </td>
                            <td class="text-end">
                                {{ $d->pcs }} {{ $d->barang->satuan ?? '' }}
                            </td>
                            <td class="text-end">{{ $d->no_lot }}</td>
                            <td>{{ $d->status }}</td>
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
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($sbw->nama ?? $d['nm_partai'])) }}</td>
                            <td class="text-end">{{ number_format($d['pcs'], 0) }} PCS /
                                {{ number_format($d['gr'], 0) }} GR
                            </td>
                            <td class="text-end">{{ number_format($d['pcs'], 0) }} PCS /
                                {{ number_format($d['gr'], 0) }} GR
                            </td>
                            <td class="text-end">{{ $sbw->no_invoice }}</td>
                            <td>Ok</td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <div style="font-size: 10px; margin-top: -10px;">
            <table class="fw-bold">
                <tr>
                    <td>OK</td>
                    <td>:</td>
                    <td>Material / barang yang diminta dan diterima dalam kondisi baik dan layak pakai.</td>
                </tr>
                <tr>
                    <td>Not OK</td>
                    <td>:</td>
                    <td>Material / barang yang diminta dan diterima dalam kondisi tidak baik dan tidak layak
                        pakai.</td>
                </tr>
            </table>

        </div>
    </div>


    <div class="row mt-2">
        <div class="col-0"></div>
        <div class="col-12">
            <table class="table table-xs table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="text-center align-middle" width="33.33%">Pemohon Oleh:</th>
                        <th class="text-center align-middle" width="33.33%">Diterima Warehouse Material:</th>
                        <th class="text-center align-middle" width="33.33%">Diterima Pengguna:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            @php
                                $pegawai = App\Models\DataPegawai::where('nama', $nama)
                                    ->whereNotIn('posisi', ['staff cabut', 'staff cetak'])
                                    ->first();
                            @endphp
                            <x-ttd-barcode :id_pegawai="$pegawai->karyawan_id_dari_api" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA GUDANG BARANG KEMASAN')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="$pegawai->karyawan_id_dari_api" />
                        </td>
                    </tr>
                    <tr>

                        <td class="text-center">({{ strtoupper($pegawai->posisi) }})
                        </td>
                        <td class="text-center align-middle">
                            (KEPALA GUDANG BARANG KEMASAN)
                        </td>
                        <td class="text-center">({{ strtoupper($pegawai->posisi) }})
                        </td>
                    </tr>
                </tbody>
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
