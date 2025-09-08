<x-hccp-print :title="$title" :dok="$dok">
    <table class="">
        <tr>
            <th width="230">Nama Supplier/Outsource</th>
            <th>:</th>
            <td>{{ $supplier->nama_supplier }}</td>
        </tr>
        <tr>
            <th width="230">Produk/Jasa</th>
            <th>:</th>
            <td>{{ $supplier->produsen ?? '' }}</td>
        </tr>
        <tr>
            <th width="230">Periode Evaluasi</th>
            <th>:</th>
            <td>Bulan {{ $evaluasi->periode_evaluasi ?? '' }}</td>
        </tr>
    </table>
    @php
        $kuantitas = $evaluasi->detail->where('jenis_kriteria', 'kuantitas')->whereNotNull('alasan');
        $waktu = $evaluasi->detail->where('jenis_kriteria', 'waktu')->whereNotNull('alasan');
        $kualitas = $evaluasi->detail->where('jenis_kriteria', 'kualitas')->whereNotNull('alasan');

        $harga = $evaluasi->detail->where('jenis_kriteria', 'harga')->whereNotNull('alasan')->first();
        $komunikasi = $evaluasi->detail->where('jenis_kriteria', 'komunikasi')->whereNotNull('alasan')->first();

        $totalPenilaian =
            ($kuantitas->avg('penilaian') ?? 100) +
            ($waktu->avg('penilaian') ?? 100) +
            ($kualitas->avg('penilaian') ?? 100) +
            ($harga ? $harga->penilaian : 100) +
            ($komunikasi ? $komunikasi->penilaian : 100);

        $rataRata = $totalPenilaian / 5;
    @endphp
    <div class="row mt-4">
        <div class="col-12">

            <table class="table border-dark table-bordered">
                <tr>
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Keterangan</th>
                    <th class="text-end">Hasil Penilaian</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ketepatan Kuantitas Pengiriman</td>
                    <td>
                        Jumlah pengiriman dengan kuantitas yang tidak sesuai: <br>
                        <x-evaluasi-detail :datas="$kuantitas" />
                    </td>
                    <td class="text-end">{{ number_format($kuantitas->avg('penilaian') ?? 100, 0) }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ketepatan Waktu Pengiriman</td>
                    <td>
                        Jumlah pengiriman dengan waktu pengiriman yang tidak sesuai: <br>
                        <x-evaluasi-detail :datas="$waktu" />

                    </td>
                    <td class="text-end">{{ number_format($waktu->avg('penilaian') ?? 100, 0) }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ketepatan Kualitas Pengiriman</td>
                    <td>
                        Jumlah pengiriman dengan kualitas yang tidak sesuai: <br>
                        <x-evaluasi-detail :datas="$kualitas" />

                    </td>
                    <td class="text-end">{{ number_format($kualitas->avg('penilaian') ?? 100, 0) }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Harga Produk/Jasa</td>
                    <td>{{ $harga->alasan }}</td>
                    <td class="text-end">{{ number_format($harga->penilaian ?? 100, 0) }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Kemudahan Komunikasi</td>
                    <td>{{ $komunikasi->alasan }}</td>
                    <td class="text-end">{{ number_format($komunikasi->penilaian ?? 100, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td class="text-end">{{ number_format($totalPenilaian, 0) }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Rata-rata</td>
                    <td class="text-end">{{ number_format($rataRata, 0) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h6>Note:</h6>
            <p>Untuk kriteria penilaian ketidasesuaian (No 1 sampai dengan 3) sebagai berikut:</p>
            <ul>
                <li>90 satu kali ketidaksesuaian</li>
                <li>80 dua sampai tiga kali ketidaksesuaian</li>
                <li>70 empat sampai lima kali ketidaksesuaian</li>
                <li>60 lebih dari lima kali ketidaksesuaian</li>
            </ul>
            <p>Untuk kriteria penilaian harga (No 4) sebagai berikut:</p>
            <ul>
                <li>90 Sangat Kompetitif</li>
                <li>80 Kompetitif</li>
                <li>70 Cukup Kompetitif</li>
                <li>60 Tidak Kompetitif</li>
            </ul>
            <p>Untuk kriteria penilaian kemudahan komunikasi (No 5) sebagai berikut:</p>
            <ul>
                <li>90 Sangat Mudah</li>
                <li>80 Mudah</li>
                <li>70 Cukup Mudah</li>
                <li>60 Tidak Mudah</li>
            </ul>
            <p>Bila nilai rata-rata lebih kecil dari 75, maka Purchasing harus menghubungi Supplier/Outsource untuk
                melakukan tindakan perbaikan.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-6"></div>
        <div class="col-2"></div>
        <div class="col-4">
            <table class="table table-bordered border-white" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                        </td>
                        <td class="text-center">Purchasing
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
