<x-hccp-print title="SELEKSI SUPPLIER MATERIAL SBW" :dok="$dok">
    <div class="row">
        <div class="col-12">
            <table style="font-size: 11px">
                <tr>
                    <th width="150">Nama Supplier</th>
                    <td>: {{ $supplier->nama }}</td>
                </tr>
                <tr>
                    <th width="150">Jenis Supply</th>
                    <td>: Material SBW Kotor</td>
                </tr>
                <tr>
                    <th width="150">Alamat</th>
                    <td>: {{ $supplier->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="text-center fw-bold bg-info" colspan="2">Informasi Produk</th>
        </tr>
        <tr>
            <th>Material yang ditawarkan</th>
            <td>{!! nl2br(e($supplier->seleksi->material_ditawarkan ?? 'SBW Kotor')) !!}</td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td>{!! nl2br(e($supplier->seleksi->spesifikasi ?? "1. Tidak ada jamur pink\n2. Tidak boleh ada batu")) !!}</td>
        </tr>
        <tr>
            <th>Nomor Reg RWB</th>
            <td>
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->reg_rwb == 'Ada (lampirkan)' ? 'checked' : '' }}> Ada
                (lampirkan)
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->reg_rwb == 'Tidak Ada' ? 'checked' : '' }}> Tidak Ada
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->reg_rwb == 'Tidak relevan' ? 'checked' : '' }}> Tidak
                relevan
            </td>
        </tr>
        <tr>
            <th>Estimasi Delivery (sejak PO diterima)</th>
            <td>: {{ $supplier->seleksi->estimasi_delivery ?? '1 minggu' }}</td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="text-center fw-bold bg-info" colspan="2">Informasi Manajemen</th>
        </tr>
        <tr>
            <th>Sistem Manajemen yang telah diterapkan di perusahaan anda:</th>
            <td>
                <p><input type="checkbox"
                        {{ ($supplier->seleksi && $supplier->seleksi->sistem_manajemen == 'HACCP (Sedang menunggu sertifikat HACCP dari pabrik)') || !$supplier->seleksi ? 'checked' : '' }}>
                    HACCP (Sedang menunggu sertifikat HACCP dari pabrik)</p>
                <p><input type="checkbox"
                        {{ $supplier->seleksi && $supplier->seleksi->sistem_manajemen == 'GMP' ? 'checked' : '' }}> GMP
                </p>
                <p><input type="checkbox"
                        {{ $supplier->seleksi && $supplier->seleksi->sistem_manajemen == 'Lainnya' ? 'checked' : '' }}>
                    Lainnya (sebutkan)
                    @if ($supplier->seleksi && $supplier->seleksi->sistem_manajemen == 'Lainnya')
                        : {{ $supplier->seleksi->manajemen_lainnya ?: '...' }}
                    @else
                        ………
                    @endif
                </p>
                <p><input type="checkbox"
                        {{ $supplier->seleksi && $supplier->seleksi->sistem_manajemen == 'Belum ada' ? 'checked' : '' }}>
                    Belum ada</p>
                <p>(bila ada harap melampirkan sertifikat)</p>
            </td>
        </tr>
        <tr>
            <th>Profil Perusahaan</th>
            <td class="d-flex gap-2">
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->profil_perusahaan == 'Ada' ? 'checked' : '' }}> Ada
                (Lampirkan)
                <input class="ms-2" type="checkbox"
                    {{ ($supplier->seleksi && $supplier->seleksi->profil_perusahaan == 'Tidak ada') || !$supplier->seleksi ? 'checked' : '' }}>
                Tidak Ada
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">Sistem Pembayaran</th>
        </tr>
        <tr>
            <td colspan="2">
                Lama jatuh tempo yang di izinkan: {{ $supplier->seleksi->jatuh_tempo ?? '3 Bulan / 90 Hari' }}
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">Sample</th>
        </tr>
        <tr>
            <td colspan="2">{!! nl2br(e($supplier->seleksi->sample ?? "Jenis sample yang diberikan (jumlah) : tidak tersedia sample\na.")) !!}</td>
        </tr>
        <tr>
            <td>
                Sample diserahkan oleh,
                <br>
                <br>
                <br>
                <br>
                ________________________
            </td>
            <td>
                Sample diterima oleh,
                <br>
                <br>
                <br>
                <br>
                ________________________
            </td>
        </tr>
    </table>
</x-hccp-print>
<br>
<br>
<br>
<br>
<br>
<x-hccp-print title="SELEKSI SUPPLIER MATERIAL SBW" :dok="$dok">
    <p style="font-size: 10px">Lembar pemeriksaan (bila ada sample yang disertakan)</p>
    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info">Departemen Lab</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(
                    e(
                        $supplier->seleksi->hasil_pemeriksaan_lab ??
                            "1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu\n2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm)",
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($supplier->seleksi && $supplier->seleksi->lab_kesimpulan == 'Lulus Pengujian') || !$supplier->seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->lab_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
                Tidak Lulus Pengujian
            </td>
        </tr>
        <tr>
            <td>
                Diperiksa Oleh: Rizwina <span class="ms-5"> Ttd:</span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info">Departemen Penerimaan</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(
                    e(
                        $supplier->seleksi->hasil_pemeriksaan_penerimaan ??
                            '1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu',
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($supplier->seleksi && $supplier->seleksi->penerimaan_kesimpulan == 'Lulus Pengujian') || !$supplier->seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->penerimaan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
                Tidak Lulus Pengujian
            </td>
        </tr>
        <tr>
            <td>
                Diperiksa Oleh: Sinta <span class="ms-5"> Ttd:</span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info">Dokter Hewan</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(
                    e(
                        $supplier->seleksi->hasil_pemeriksaan_hewan ??
                            "1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu\n2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm) sesuai yang dilaporkan bagian lab",
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($supplier->seleksi && $supplier->seleksi->hewan_kesimpulan == 'Lulus Pengujian') || !$supplier->seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->hewan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
                Tidak Lulus Pengujian
            </td>
        </tr>
    </table>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="25%">Diperiksa Oleh:</th>
                        <th class="text-center" width="25%">Dilaporkan Oleh:</th>
                        <th class="text-center" width="25%">Ditinjau Oleh:</th>
                        <th class="text-center" width="25%">Disetujui Oleh:</th>
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
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            (DOKTER HEWAN)
                        </td>
                        <td class="text-center align-middle">
                            (KEPALA GUDANG BAHAN BAKU)
                        </td>
                        <td class="text-center align-middle">
                            (KEPALA LAB)
                        </td>
                        <td class="text-center align-middle">
                            (DIREKTUR UTAMA)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
