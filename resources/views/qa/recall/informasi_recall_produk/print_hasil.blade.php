<x-hccp-print :title="$title" :dok="$dok">
    <div style="font-size: 12px">
        <span><b>Proses MOCK Recall telah dilakukan tanggal 16 Juli 2025 terhadap produk dengan perincian sebagai
                berikut
                :</b></span>
        <br>
        <div class="row">
            <div class="col-12">
                <table class="table table-sm border-dark table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">Informasi Pelanggan</th>
                            <th rowspan="2" class="text-end align-middle" width="110">Jumlah yang Berhasil Ditarik
                            </th>
                            <th rowspan="2" class="text-start align-middle">Produk Benar-benar Kembali Tanggal
                            </th>
                            <th rowspan="2" class="text-start align-middle">Keterangan</th>
                        </tr>
                        <tr>
                            <th class="align-middle" width="200">Nama Pelanggan / <br> Titik Produk Terakhir</th>
                            <th class="align-middle" width="170">Jenis Produk</th>
                            <th class="align-middle" width="165">Kode Produk</th>
                            <th class="text-end align-middle" width="130">Jumlah Didistribusikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas->products as $index => $produk)
                            <tr>
                                <td>{{ $produk->nama_pelanggan }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->no_lot }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_recall, 0) }} Gr</td>
                                <td class="text-end">
                                    {{ number_format($produk->jumlah_ditarik, 0) }} Gr
                                </td>
                                <td>
                                    {{ !empty($produk->tgl_kembali) ? tanggal($produk->tgl_kembali) : '' }}
                                </td>
                                <td>
                                    {{ $produk->ket_hasil }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" class="text-center">Total</th>
                            <th class="text-end">{{ number_format($datas->products->sum('jumlah_recall'), 0) }} Gr</th>
                            <th class="text-end">
                                {{ number_format($datas->products->sum('jumlah_ditarik'), 0) }} Gr
                            </th>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-1">
                <span class="ms-2 text-dark">Analisa dari hasil penarikan produk telah dirangkum sebagai berikut:</span>
            </div>

            <div class="col-12 mt-2">
                <table class="table table-sm border-dark table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle" width="150">Nama Produk</th>
                            <th class="align-middle" width="210">Kode Produk</th>
                            <th class="text-end align-middle" width="110">Jumlah yang Seharusnya Ditarik</th>
                            <th class="text-end align-middle" width="110">Jumlah yang Berhasil Ditarik</th>
                            <th class="text-end align-middle" width="110">Jumlah yang Tidak Berhasil Ditarik</th>
                            <th class="align-middle" width="350">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas->products as $index => $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->no_lot }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_recall, 0) }} Gr</td>
                                <td class="text-end">
                                    {{ number_format($produk->jumlah_ditarik, 0) }}
                                    Gr
                                </td>
                                <td class="text-end">
                                    {{ number_format($produk->jumlah_recall - $produk->jumlah_ditarik, 0) }}
                                    Gr
                                </td>
                                <td>{{ $produk->ket_hasil }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th class="text-end">{{ number_format($datas->products->sum('jumlah_recall'), 0) }} Gr</th>
                            <th class="text-end">
                                {{ number_format($datas->products->sum('jumlah_ditarik'), 0) }} Gr
                            </th>
                            <th class="text-end">
                                {{ number_format($datas->products->sum('jumlah_recall') - $datas->products->sum('jumlah_ditarik'), 0) }}
                                Gr
                            </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">% Total</th>
                            <th class="text-end"></th>
                            <th class="text-end">
                                @php
                                    $totalDistribusi = $datas->products->sum('jumlah_distribusi');
                                    $persenBerhasil =
                                        $totalDistribusi > 0
                                            ? round(
                                                ($datas->products->sum('jumlah_ditarik') / $totalDistribusi) * 100,
                                                2,
                                            )
                                            : 0;
                                @endphp
                                {{ $persenBerhasil }}%
                            </th>
                            <th class="text-end">
                                @php
                                    $totalDistribusi = $datas->products->sum('jumlah_distribusi');
                                    $persenTidakBerhasil =
                                        $totalDistribusi > 0
                                            ? round(
                                                (($totalDistribusi - $datas->products->sum('jumlah_ditarik')) /
                                                    $totalDistribusi) *
                                                    100,
                                            )
                                            : 0;
                                @endphp
                                {{ $persenTidakBerhasil }}%
                            </th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <span>
            Berdasarkan hasil analisa proses MOCK recall yang telah dilakukan, dari total produk sejumlah 10 kg yang
            berhasil ditarik adalah sejumlah {{ number_format($datas->products->sum('jumlah_ditarik'), 0) }} Gr
            ({{ $persenBerhasil }}%)
            <br>
            sedangkan yang tidak berhasil ditarik sejumlah
            {{ number_format($datas->products->sum('jumlah_recall') - $datas->products->sum('jumlah_ditarik'), 0) }} Gr
            ({{ $persenTidakBerhasil }}%).
            <br>
            Kesimpulan : Proses MOCK Recall telah berjalan Efektif / <s>Tidak Efektif</s>
            <br>
            Masalah yang timbul selama Proses MOCK Recall adalah : Tidak ada
            <br>
            No CAPA : {{ $datas->id }}
        </span>
    </div>

    <table width="100%">
        <tr>
            <td width="60%">

            </td>
            <td style="width: 40%">
                <table class="border-dark table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">[FSTL]</td>
                            <td class="text-center">[Direktur]</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</x-hccp-print>
