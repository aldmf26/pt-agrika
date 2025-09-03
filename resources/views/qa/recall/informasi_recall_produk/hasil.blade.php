<x-app-layout :title="$title">
    <form action="{{ route('qa.5.1.store_hasil', $datas) }}" method="post">
        @csrf
        <div class="row" x-data="{
            jumlahBerhasilDitarik: [],
            produkPerIndex: [],
            init() {
                @foreach ($datas->products as $index => $produk)
                        this.jumlahBerhasilDitarik.push({{ old('jumlah_berhasil_ditarik.' . $index, $produk->jumlah_ditarik) }});
                        this.produkPerIndex.push({{ $produk->jumlah_distribusi }}); @endforeach
            },
            get totalBerhasil() {
                return this.jumlahBerhasilDitarik.reduce((sum, val) => sum + (parseFloat(val) || 0), 0);
            },
            get totalTidakBerhasil() {
                return this.produkPerIndex.reduce((sum, val, idx) => sum + (val - (parseFloat(this.jumlahBerhasilDitarik[idx]) || 0)), 0);
            },
            get persenBerhasil() {
                const total = this.produkPerIndex.reduce((sum, val) => sum + val, 0);
                if (total === 0) return 0;
                return (this.totalBerhasil / total * 100).toFixed(0);
            },
            get persenTidakBerhasil() {
                const total = this.produkPerIndex.reduce((sum, val) => sum + val, 0);
                if (total === 0) return 0;
                return (this.totalTidakBerhasil / total * 100).toFixed(0);
            }
        }">
            <div class="col-12">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center">Informasi Pelanggan</th>
                            <th rowspan="2" class="text-end">Jumlah yang Berhasil Ditarik</th>
                            <th rowspan="2" class="text-start">Produk Benar-benar <br> Kembali Tanggal</th>
                            <th rowspan="2" class="text-start">Keterangan</th>
                        </tr>
                        <tr>
                            <th class="align-middle" width="100">Nama Pelanggan / <br> Titik Produk Terakhir</th>
                            <th class="align-middle" width="170">Jenis Produk</th>
                            <th class="align-middle" width="190">Kode Produk</th>
                            <th class="text-end align-middle">Jumlah Didistribusikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas->products as $index => $produk)
                            <tr>
                                <td>{{ $produk->nama_pelanggan }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->no_lot }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_recall, 0) }} Gr</td>
                                <td>
                                    <input x-model="jumlahBerhasilDitarik[{{ $index }}]" type="number"
                                        step="any" min="0" max="{{ $produk->jumlah_recall }}"
                                        class="form-control text-end"
                                        name="jumlah_berhasil_ditarik[{{ $index }}]" required>
                                </td>
                                <td>
                                    <input type="date" class="form-control"
                                        name="produk_kembali_tanggal[{{ $index }}]"
                                        value="{{ $produk->tgl_kembali ?? date('Y-m-d') }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="keterangan[{{ $index }}]"
                                        value="{{ $produk->ket_hasil ?? '' }}">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" class="text-center">Total</th>
                            <th class="text-end">{{ number_format($datas->products->sum('jumlah_recall'), 0) }} Gr</th>
                            <th class="text-end">
                                <span x-text="totalBerhasil.toLocaleString()"></span> Gr
                            </th>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <span class="ms-2 text-dark">Analisa dari hasil penarikan produk telah dirangkum sebagai berikut:</span>
            </div>

            <div class="col-12 mt-2">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class="align-middle" width="150">Nama Produk</th>
                            <th class="align-middle" width="210">Kode Produk</th>
                            <th class="text-end align-middle" width="180">Jumlah yang Seharusnya Ditarik</th>
                            <th class="text-end align-middle" width="180">Jumlah yang Berhasil Ditarik</th>
                            <th class="text-end align-middle" width="180">Jumlah yang Tidak Berhasil Ditarik</th>
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
                                    <span
                                        x-text="jumlahBerhasilDitarik[{{ $index }}] ? parseFloat(jumlahBerhasilDitarik[{{ $index }}]).toLocaleString() : '0'"></span>
                                    Gr
                                </td>
                                <td class="text-end">
                                    <span
                                        x-text="(isNaN(produkPerIndex[{{ $index }}] - (parseFloat(jumlahBerhasilDitarik[{{ $index }}]) || 0)) ? 0 : (produkPerIndex[{{ $index }}] - (parseFloat(jumlahBerhasilDitarik[{{ $index }}]) || 0)).toLocaleString())"></span>
                                    Gr
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th class="text-end">{{ number_format($datas->products->sum('jumlah_recall'), 0) }} Gr</th>
                            <th class="text-end">
                                <span x-text="totalBerhasil.toLocaleString()"></span> Gr
                            </th>
                            <th class="text-end">
                                <span x-text="totalTidakBerhasil.toLocaleString()"></span> Gr
                            </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">% Total</th>
                            <th class="text-end"></th>
                            <th class="text-end">
                                <span x-text="persenBerhasil + '%'"></span>
                            </th>
                            <th class="text-end">
                                <span x-text="persenTidakBerhasil + '%'"></span>
                            </th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
            </div>
        </div>
    </form>

</x-app-layout>
