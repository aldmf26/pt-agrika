<x-hccp-print :title="$title" :kategori="$supplier->produsen" :dok="$dok">
    <table class="table-xs">
        <tr>
            <th>Tagngal</th>
            <th>:</th>
            <td>{{ tanggal(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <th width="130">Nama Supplier</th>
            <th>:</th>
            <td>{{ $supplier->nama_supplier }}</td>
        </tr>
        <tr>
            <th width="130">Jenis Supply</th>
            <th>:</th>
            <td>{{ $supplier->produsen ?? '' }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th width="130">Periode Evaluasi</th>
            <th>:</th>
            <td>Semester I / Semester II</td>
        </tr>
        <tr>
            <th width="130">&nbsp;</th>
            <th>&nbsp;</th>
            <td style="font-size: 9px">*Coret salah satu</td>
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
    <table class="table table-xs table-sm table-bordered border-dark mt-2">
        <thead>
            <tr>
                <th class="head text-center align-middle">Kriteria Evaluasi:</th>
                <th class="head text-center align-middle">Hasil Peniliaan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="head">1. Ketepatan Kuantitas Pengiriman</th>
                <td class="text-end align-middle" rowspan="2">
                    {{ number_format($kuantitas->avg('penilaian') ?? 100, 0) }}
                </td>
            </tr>
            <tr>
                <td>
                    Jumlah pengiriman dengan kuantitas yang tidak sesuai:
                    <x-evaluasi-detail :datas="$kuantitas" />
                </td>
            </tr>

            <tr>
                <th class="head">2. Ketepatan Waktu Pengiriman</th>
                <td class="text-end align-middle" rowspan="2">
                    {{ number_format($waktu->avg('penilaian') ?? 100, 0) }}
                </td>
            </tr>
            <tr>
                <td>
                    Jumlah pengiriman dengan waktu pengiriman yang tidak sesuai:
                    <x-evaluasi-detail :datas="$waktu" />
                </td>
            </tr>


            <tr>
                <th class="head">3. Ketepatan Kualitas Pengiriman</th>
                <td class="text-end align-middle" rowspan="2">
                    {{ number_format($kualitas->avg('penilaian') ?? 100, 0) }}
                </td>
            </tr>
            <tr>
                <td>
                    Jumlah pengiriman dengan kualitas yang tidak sesuai:
                    <x-evaluasi-detail :datas="$kualitas" />
                </td>
            </tr>

            <tr>
                <th class="head">4. Harga Produk/Jasa</th>
                <td class="text-end align-middle">
                    {{ number_format($harga->penilaian ?? 100, 0) }}
                </td>
            </tr>

            <tr>
                <th class="head">5. Kemudahan Komunikasi</th>
                <td class="text-end align-middle">
                    {{ number_format($komunikasi->penilaian ?? 100, 0) }}
                </td>
            </tr>

            <tr>
                <th class="head text-end">Total</th>
                <td class="text-end">{{ number_format($totalPenilaian, 0) }}</td>
            </tr>
            <tr>
            </tr>

            <tr>
                <th class="head text-end">Rata-rata</th>
                <th class="text-end">{{ number_format($rataRata, 0) }}</th>
            </tr>
        </tbody>
    </table>

    <div class="row mt-4">
        <div class="col-12" style="font-size: 10px">
            <b>Note:</b>
            <div style="font-style: italic;">
                <div>Untuk kriteria penilaian ketidasesuaian (No 1 sampai dengan 3) sebagai berikut:</div>
                <div>&nbsp; 90 satu kali ketidaksesuaian</div>
                <div>&nbsp; 80 dua sampai tiga kali ketidaksesuaian</div>
                <div>&nbsp; 70 empat sampai lima kali ketidaksesuaian</div>
                <div>&nbsp; 60 lebih dari lima kali ketidaksesuaian</div>

                <div>Untuk kriteria penilaian harga (No 4) sebagai berikut:</div>
                <div>&nbsp; 90 Sangat Kompetitif</div>
                <div>&nbsp; 80 Kompetitif</div>
                <div>&nbsp; 70 Cukup Kompetitif</div>
                <div>&nbsp; 60 Tidak Kompetitif</div>

                <div>Untuk kriteria penilaian kemudahan komunikasi (No 5) sebagai berikut:</div>
                <div>&nbsp; 90 Sangat Mudah</div>
                <div>&nbsp; 80 Mudah</div>
                <div>&nbsp; 70 Cukup Mudah</div>
                <div>&nbsp; 60 Tidak Mudah</div>

                <p class="mt-2">Bila nilai rata-rata lebih kecil dari 75, maka Purchasing harus menghubungi
                    Supplier/Outsource untuk
                    melakukan tindakan perbaikan.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            (STAFF PURCHASING)
                        </td>
                        <td class="text-center align-middle">
                            (KA. PURCHASING)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
