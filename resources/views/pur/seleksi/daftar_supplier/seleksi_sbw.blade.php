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
                <tr>
                    <th width="150">Tanggal</th>
                    <td>: {{ tanggal(date('Y-m-d', strtotime($supplier->created_at))) }}
                    </td>
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
            <td>{!! nl2br(e($seleksi->material_ditawarkan ?? 'SBW Kotor')) !!}</td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td>{!! nl2br(e($seleksi->spesifikasi ?? "1. Tidak ada jamur pink\n2. Tidak boleh ada batu")) !!}</td>
        </tr>
        <tr>
            <th>Nomor Reg RWB</th>
            <td>
                <input type="checkbox"
                    {{ $seleksi && $seleksi->reg_rwb == 'Ada (lampirkan)' ? 'checked' : '' }}> Ada
                (lampirkan)
                <input type="checkbox"
                    {{ $seleksi && $seleksi->reg_rwb == 'Tidak Ada' ? 'checked' : '' }}> Tidak Ada
                <input type="checkbox"
                    {{ $seleksi && $seleksi->reg_rwb == 'Tidak relevan' ? 'checked' : '' }}> Tidak
                relevan
            </td>
        </tr>
        <tr>
            <th>Estimasi Delivery (sejak PO diterima)</th>
            <td>: {{ $seleksi->estimasi_delivery ?? '1 minggu' }}</td>
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
                        {{ ($seleksi && $seleksi->sistem_manajemen == 'HACCP (Sedang menunggu sertifikat HACCP dari pabrik)') || !$seleksi ? 'checked' : '' }}>
                    HACCP (Sedang menunggu sertifikat HACCP dari pabrik)</p>
                <p><input type="checkbox"
                        {{ $seleksi && $seleksi->sistem_manajemen == 'GMP' ? 'checked' : '' }}> GMP
                </p>
                <p><input type="checkbox"
                        {{ $seleksi && $seleksi->sistem_manajemen == 'Lainnya' ? 'checked' : '' }}>
                    Lainnya (sebutkan)
                    @if ($seleksi && $seleksi->sistem_manajemen == 'Lainnya')
                        : {{ $seleksi->manajemen_lainnya ?: '...' }}
                    @else
                        ………
                    @endif
                </p>
                <p><input type="checkbox"
                        {{ $seleksi && $seleksi->sistem_manajemen == 'Belum ada' ? 'checked' : '' }}>
                    Belum ada</p>
                <p>(bila ada harap melampirkan sertifikat)</p>
            </td>
        </tr>
        <tr>
            <th>Profil Perusahaan</th>
            <td class="d-flex gap-2">
                <input type="checkbox"
                    {{ $seleksi && $seleksi->profil_perusahaan == 'Ada' ? 'checked' : '' }}> Ada
                (Lampirkan)
                <input class="ms-2" type="checkbox"
                    {{ ($seleksi && $seleksi->profil_perusahaan == 'Tidak ada') || !$seleksi ? 'checked' : '' }}>
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
                Lama jatuh tempo yang di izinkan: {{ $seleksi->jatuh_tempo ?? '3 Bulan / 90 Hari' }}
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">Sample</th>
        </tr>
        <tr>
            <td colspan="2">{!! nl2br(e($seleksi->sample ?? "Jenis sample yang diberikan (jumlah) : tidak tersedia sample\na.")) !!}</td>
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
                        $seleksi->hasil_pemeriksaan_lab ??
                            "1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu\n2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm)",
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($seleksi && $seleksi->lab_kesimpulan == 'Lulus Pengujian') || !$seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $seleksi && $seleksi->lab_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
                Tidak Lulus Pengujian
            </td>
        </tr>
        <tr>
            <td>
                Diperiksa Oleh: Rizwina Aprilita <span class="ms-5"> Ttd: <x-ttd-barcode size="30"
                        :id_pegawai="whereTtd('Kepala Lab & FSTL')" /></span>
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
                        $seleksi->hasil_pemeriksaan_penerimaan ??
                            '1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu',
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($seleksi && $seleksi->penerimaan_kesimpulan == 'Lulus Pengujian') || !$seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $seleksi && $seleksi->penerimaan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
                Tidak Lulus Pengujian
            </td>
        </tr>
        <tr>
            <td>
                Diperiksa Oleh: Sinta <span style="margin-left: 100px"> Ttd: <x-ttd-barcode size="30"
                        :id_pegawai="whereTtd('KEPALA GUDANG BAHAN BAKU')" /></span>
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
                        $seleksi->hasil_pemeriksaan_hewan ??
                            "1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu\n2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm) sesuai yang dilaporkan bagian lab",
                    ),
                ) !!}
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5"
                    {{ ($seleksi && $seleksi->hewan_kesimpulan == 'Lulus Pengujian') || !$seleksi ? 'checked' : '' }}>
                Lulus Pengujian
                <input type="checkbox"
                    {{ $seleksi && $seleksi->hewan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}>
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
                            <x-ttd-barcode :id_pegawai="whereTtd('DOKTER HEWAN')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA GUDANG BAHAN BAKU')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('Kepala Lab & FSTL')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA DIREKTUR')" />
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
                            (KEPALA DIREKTUR)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
