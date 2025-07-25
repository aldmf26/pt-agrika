<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">
        <div class="col-6">
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
            <th class="text-center fw-bold bg-info" colspan="2">INFORMASI PRODUK</th>
        </tr>
        <tr>
            <th>Material/Kemasan/Barang/Jasa yang ditawarkan</th>
            <td>
                @foreach ($supplier->barang as $item)
                    {{ $loop->iteration }}. {{ $item->nama_barang }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Spesifikasi</th>
            <td>
                @foreach ($supplier->barang as $item)
                    {{ $loop->iteration }}. {{ $item->nama_barang }} : {{ $item->spek ?? '-' }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Nomor Reg RW</th>
            <td>
                <input type="checkbox"> Ada (lampirkan)
                <input type="checkbox"> Tidak Ada
                <input type="checkbox" checked> Tidak relevan
            </td>
        </tr>
        <tr>
            <th>Estimasi Delivery (sejak PO diterima)</th>
            <td>: 1 minggu</td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="text-center fw-bold bg-info" colspan="2">INFORMASI MANAJEMEN</th>
        </tr>
        <tr>
            <th>Sistem Manajemen yang telah diterapkan di Perusahaan Anda:</th>
            <td>
                <p><input type="checkbox"> HACCP</p>
                <p><input type="checkbox"> GMP</p>
                <p><input type="checkbox"> Lainnya (sebutkan)………</p>
                <p><input type="checkbox" checked> Belum ada</p>
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
            <th colspan="2" class="text-center fw-bold bg-info">SISTEM PEMBAYARAN</th>
        </tr>
        <tr>
            <td colspan="2">
                Lama jatuh tempo yang diijinkan: Langsung
            </td>
        </tr>
    </table>

    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th colspan="2" class="text-center fw-bold bg-info">SAMPEL</th>
        </tr>
        <tr>
            <td colspan="2">Jenis Sampel yang diberikan (jumlah) : <br>
                a.
            </td>
        </tr>
        <tr>
            <td>

                Sampel diserahkan oleh,




                <br>
                <br>
                <br>
                ________________________
            </td>
            <td>
                Sampel diterima oleh,




                <br>
                <br>
                <br>
                ________________________
            </td>
        </tr>
    </table>
</x-hccp-print>

<x-hccp-print title="SELEKSI SUPPLIER/OUTSOURCE" :dok="$dok">
    <p>Lembar Pemeriksaan (Bila ada sampel yang disertakan)</p>
    <table class="table table-bordered border-dark" style="font-size: 11px">
        <tr>
            <th class="fw-bold bg-info">Departemen Lab</th>
        </tr>
        <tr>
            <td>Hasil Pemeriksaan : <br>
                1.
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
                1.
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
                1.
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
                Diperiksa Oleh: Drh Edy <span class="ms-5"> Ttd:</span>
            </td>
        </tr>
    </table>

    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dilaporkan Oleh:</th>
                        <th class="text-center" width="33.33%">Ditinjau Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            [ KA.purchasing]
                        </td>
                        <td class="text-center">
                            [ FSTL]
                        </td>
                        <td class="text-center">
                            [ DIREKTUR]
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
