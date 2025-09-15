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
            <td>
                1. SBW Kotor
            </td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td>
                1. Tidak Ada Jamur Pink <br>
                2. Tidak Boleh Ada Batu

            </td>
        </tr>
        <tr>
            <th>Nomor Reg RW</th>
            <td>
                <input type="checkbox" checked> Ada (lampirkan)
                <input type="checkbox"> Tidak Ada
                <input type="checkbox"> Tidak relevan
            </td>
        </tr>
        <tr>
            <th>Estimasi Delivery (sejak PO diterima)</th>
            <td>: 1 minggu</td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="text-center fw-bold bg-info" colspan="2">Informasi Manajemen</th>
        </tr>
        <tr>
            <th>Sistem Manajemen yang telah diterapkan di Perusahaan Anda:</th>
            <td>
                <p><input type="checkbox" checked> HACCP (Sedang menunggu sertifikat HACCP dari pabrik)</p>
                <p><input type="checkbox"> GMP</p>
                <p><input type="checkbox"> Lainnya (sebutkan)………</p>
                <p><input type="checkbox"> Belum ada</p>
                <p>(bila ada harap melampirkan sertifikat)</p>
            </td>
        </tr>
        <tr>
            <th>Profil Perusahaan</th>
            <td class="d-flex gap-2">
                <input type="checkbox"> Ada (Lampirkan)
                <input class="ms-2" type="checkbox" checked> Tidak Ada
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">Sistem Pembayaran</th>
        </tr>
        <tr>
            <td colspan="2">
                Lama jatuh tempo yang di izinkan: 3 Bulan / 90 Hari
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">Sample</th>
        </tr>
        <tr>
            <td colspan="2">Jenis Sample yang diberikan (jumlah) : Tidak Tersedia Sample<br>
                a.
            </td>
        </tr>
        <tr>
            <td>

                Sample diserahkan oleh,




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
    <p style="font-size: 10px">Lembar Pemeriksaan (Bila ada Sample yang disertakan)</p>
    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info">Departemen Lab</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu
                2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm)
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5" checked> Lulus Pengujian <input type="checkbox"> Tidak Lulus
                Pengujian
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
                1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5" checked> Lulus Pengujian <input type="checkbox"> Tidak Lulus
                Pengujian
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
                1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu
                2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm) sesuaiyang dilaporkan bagian lab
            </td>
        </tr>
        <tr>
            <td>Kesimpulan
                : <input type="checkbox" class="ms-5" checked> Lulus Pengujian <input type="checkbox"> Tidak Lulus
                Pengujian
            </td>
        </tr>
        {{-- <tr>
            <td>
                Diperiksa Oleh: Drh. Edy <span class="ms-5"> Ttd:</span>
            </td>
        </tr> --}}
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
                            (KA. GUDANG BAHAN BAKU)
                        </td>
                        <td class="text-center align-middle">
                            (KA. LAB)
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
