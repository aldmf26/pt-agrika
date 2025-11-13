<x-hccp-print :title="$title" :dok="$dok">
    <div style="font-size: 12px">
        <span>Berikut ini kami informasikan mengenai perincian produk MOCK Recall</span>
        <br>
        <div class="row">
            <div class="col-10">
                <span><b>Skenario Recall :</b> <br> {!! $datas->skenario_recall !!}</span>
                <br>
                <span class="mt-3"><b>Tim Recall :</b> </span>
                <table class="table table-sm border-dark table-bordered">
                    <thead>
                        <tr>
                            <th width="300" class="text-center">Nama</th>
                            <th class="text-center">Tugas & Tanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas->teamMembers as $team)
                            <tr>
                                <td>{{ strtoupper($team->nama) }}</td>
                                <td>{{ $team->tugas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-bordered border-dark">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Informasi Produk</th>
                            <th colspan="3" class="text-center">Informasi Pelanggan / Titik Produk Terakhir</th>
                        </tr>
                        <tr>
                            <th class="align-middle text-center" width="100">Nama Produk</th>
                            <th class="align-middle text-center" width="170">Kode Lot</th>
                            <th class="text-center align-middle">Jumlah Recall</th>
                            <th width="200" class="align-middle text-center">Nama</th>
                            <th width="350" class="align-middle text-center">Alamat</th>
                            <th class="text-center align-middle">Jumlah Didistribusikan</th>
                        </tr>
                        {{-- <tr style="font-size: 8px">
                            <th></th>
                            <th>Batch Produk</th>
                            <th>Pack / GR / Gram</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($datas->products as $produk)
                            <tr>
                                <td>{{ strtoupper($produk->nama) }}</td>
                                <td class="text-end">{{ $produk->no_lot }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_recall, 0) }} GR</td>
                                <td>{{ $produk->nama_pelanggan }}</td>
                                <td>{{ $produk->alamat_pelanggan }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_distribusi, 0) }} GR</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <td class="text-end">{{ number_format($datas->products->sum('jumlah_recall'), 0) }}
                                GR</td>
                            <td colspan="2"></td>
                            <td class="text-end">
                                {{ number_format($datas->products->sum('jumlah_distribusi'), 0) }} GR</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="25%">Dibuat Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('Kepala Lab & FSTL')" />
                            </td>
                        </tr>
                        <tr>

                            <td class="text-center align-middle">
                                (KEPALA LAB & FSTL)
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-hccp-print>
