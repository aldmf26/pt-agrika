<x-hccp-print title="SELEKSI SUPPLIER MATERIAL" :kategori="$kategori" :dok="$dok">
    <div class="row">
        <div class="col-7">
            <table style="font-size: 11px">
                <tr>
                    <th width="150">Nama Supplier</th>
                    <td>: {{ $supplier->nama_supplier }}</td>
                </tr>
                <tr>
                    <th width="150">Jenis Supply</th>
                    <td>: {{ $supplier->kategori }}</td>
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
            <th>Barang yang ditawarkan</th>
            <td>
                @if ($supplier->kategori == 'Jasa')
                    {!! nl2br(e($supplier->seleksi->material_ditawarkan)) !!}
                @else
                    @if ($supplier->seleksi && $supplier->seleksi->barang_ditawarkan)
                        {!! nl2br(e($supplier->seleksi->barang_ditawarkan)) !!}
                    @else
                        @foreach ($supplier->barang as $item)
                            {{ $loop->iteration }}. {{ ucfirst($item->nama_barang) }}<br>
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td>
                @if ($supplier->seleksi && $supplier->seleksi->spesifikasi)
                    {!! nl2br(e($supplier->seleksi->spesifikasi)) !!}
                @else
                    <ol style="list-style-type: none; padding-left: 0; margin: 0">
                        @foreach ($supplier->barang as $item)
                            <li>{{ $loop->iteration }}. {{ $item->spek ?? '-' }}</li>
                        @endforeach
                    </ol>
                @endif
            </td>
        </tr>
        <tr>
            <th>Nomor Reg RWB</th>
            <td>
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->reg_rwb == 'Ada (lampirkan)' ? 'checked' : '' }}> Ada
                (lampirkan)
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->reg_rwb == 'Tidak ada' ? 'checked' : '' }}> Tidak ada
                <input type="checkbox"
                    {{ ($supplier->seleksi && $supplier->seleksi->reg_rwb == 'Tidak relevan') || !$supplier->seleksi ? 'checked' : '' }}>
                Tidak relevan
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
            <th>Sistem manajemen yang telah diterapkan di perusahaan anda:</th>
            <td>
                @php
                    $defaultSistem =
                        $kategori == 'Jasa' ? 'Lainnya' : 'HACCP (Sedang menunggu sertifikat HACCP dari pabrik)';
                    $sistemManajemen = $supplier->seleksi->sistem_manajemen ?? $defaultSistem;
                @endphp
                <p><input type="checkbox"
                        {{ $sistemManajemen == 'HACCP (Sedang menunggu sertifikat HACCP dari pabrik)' ? 'checked' : '' }}>
                    HACCP (Sedang menunggu sertifikat HACCP dari pabrik)</p>
                <p><input type="checkbox" {{ $sistemManajemen == 'GMP' ? 'checked' : '' }}> GMP</p>
                <p><input type="checkbox" {{ $sistemManajemen == 'Lainnya' ? 'checked' : '' }}> Lainnya (sebutkan)
                    @if ($supplier->seleksi && $supplier->seleksi->manajemen_lainnya)
                        : {{ $supplier->seleksi->manajemen_lainnya }}
                    @elseif($kategori == 'Jasa')
                        : ISO 9001
                    @else
                        ………
                    @endif
                </p>
                <p><input type="checkbox" {{ $sistemManajemen == 'Belum ada' ? 'checked' : '' }}> Belum ada</p>
                <p>(Bila ada harap melampirkan sertifikat)</p>
            </td>
        </tr>
        <tr>
            <th>Profil Perusahaan</th>
            <td class="d-flex gap-2">
                <input type="checkbox"
                    {{ $supplier->seleksi && $supplier->seleksi->profil_perusahaan == 'Ada' ? 'checked' : '' }}> Ada
                (lampirkan)
                <input class="ms-2" type="checkbox"
                    {{ ($supplier->seleksi && $supplier->seleksi->profil_perusahaan == 'Tidak Ada') || !$supplier->seleksi ? 'checked' : '' }}>
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
                Lama jatuh tempo yang diijinkan: {{ $supplier->seleksi->jatuh_tempo ?? 'langsung' }}
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

<x-hccp-print title="SELEKSI SUPPLIER " :kategori="$kategori" :dok="$dok">
    <p style="font-size: 10px">Lembar Pemeriksaan (Bila ada sample yang disertakan)</p>
    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info text-center">Departemen Lab</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(e($supplier->seleksi->hasil_pemeriksaan_lab ?? '1.')) !!}
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
                Diperiksa Oleh: Rizwina Aprilita <span class="ms-5"> Ttd: <x-ttd-barcode size="30"
                        :id_pegawai="whereTtd('Kepala Lab & FSTL')" /></span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info text-center">Departemen Penerimaan</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(e($supplier->seleksi->hasil_pemeriksaan_penerimaan ?? '1.')) !!}
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
                Diperiksa Oleh: Gusti Andriy Wijaya <span class="ms-4"> Ttd: <x-ttd-barcode size="30"
                        :id_pegawai="whereTtd('Kepala Purchasing')" /></span>
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info text-center">Dokter Hewan</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                {!! nl2br(e($supplier->seleksi->hasil_pemeriksaan_hewan ?? '1.')) !!}
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
                        @php
                            if ($kategori == 'Jasa') {
                                $ka = 'Lab & FSTL';
                            } elseif ($kategori == 'Kemasan') {
                                $ka = 'PACKING & GUDANG FG';
                            } elseif ($kategori == 'Barang') {
                                $ka = 'GUDANG BARANG KEMASAN';
                            } else {
                                $ka = 'GUDANG BAHAN BAKU';
                            }
                        @endphp

                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('DOKTER HEWAN')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA PURCHASING')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('KEPALA ' . $ka)" />
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
                            (KEPALA PURCHASING)
                        </td>
                        <td class="text-center align-middle">

                            (KEPALA {{ $ka }})
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
