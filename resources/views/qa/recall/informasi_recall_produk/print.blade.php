<x-hccp-print :title="$title" :dok="$dok">
    <div style="font-size: 12px">
        <span>Berikut ini kami informasikan mengenai perincian produk MOCK recall</span>
        <br>
        <div class="row">
            <div class="col-10">
                <span><b>Skenario Recall :</b> <br> {!! $datas->skenario_recall !!}</span>
                <br>
                <span class="mt-3"><b>Tim Recall :</b> </span>
                <table class="table border-dark table-bordered">
                    <thead>
                        <tr>
                            <th width="300">Nama</th>
                            <th>Tugas & Tanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas->teamMembers as $team)
                            <tr>
                                <td>{{ ucwords(strtolower($team->nama)) }}</td>
                                <td>{{ $team->tugas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Informasi Produk</th>
                            <th colspan="3" class="text-center">Informasi Pelanggan / Titik Produk Terakhir</th>
                        </tr>
                        <tr>
                            <th class="align-middle" width="100">Nama Produk</th>
                            <th class="align-middle" width="170">Kode Lot</th>
                            <th class="text-end align-middle">Jumlah Recall</th>
                            <th width="200" class="align-middle">Nama</th>
                            <th width="350" class="align-middle">Alamat</th>
                            <th class="text-end align-middle">Jumlah Didistribusikan</th>
                        </tr>
                        {{-- <tr style="font-size: 8px">
                            <th></th>
                            <th>Batch Produk</th>
                            <th>Pack / Kg / Gram</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($datas->products as $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->no_lot }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_recall / 1000, 0) }} Kg</td>
                                <td>{{ $produk->nama_pelanggan }}</td>
                                <td>{{ $produk->alamat_pelanggan }}</td>
                                <td class="text-end">{{ number_format($produk->jumlah_distribusi / 1000, 0) }} Kg</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <td class="text-end">{{ number_format($datas->products->sum('jumlah_recall') / 1000, 0) }}
                                Kg</td>
                            <td colspan="2"></td>
                            <td class="text-end">
                                {{ number_format($datas->products->sum('jumlah_distribusi') / 1000, 0) }} Kg</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <span>Dibuat Oleh : <b>{{ $datas->dibuat_oleh }}</b></span>
                <br>
                {{ tanggal(date('Y-m-d', strtotime($datas->created_at))) }}
                <br>
                FSTL
            </div>
        </div>
    </div>

</x-hccp-print>
