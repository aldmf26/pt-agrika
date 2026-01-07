<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Label Bahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Settingan Halaman Cetak */
        @media print {
            @page {
                size: A4 landscape;
                /* Kertas A4 Landscape */
                margin: 5mm;
                /* Margin kertas kecil */
            }

            body,
            html {
                margin: 0;
                padding: 0;
                background: white;
            }

            /* Sembunyikan elemen input saat print */
            .no-print {
                display: none !important;
            }

            .container-print {
                width: 100%;
                display: block;
            }

            /* BOX LABEL UTAMA */
            .label-box {
                border: 1px solid #000;
                padding: 4px;
                /* Layout 3 kolom */
                float: left;
                width: 32.5%;
                /* 32.5% x 3 mendekati 100% */
                /* Tinggi Pas 3 Baris: A4 (210mm) / 3 = 70mm. Kita pakai 64mm biar aman */
                height: 64mm;
                margin-right: 0.5%;
                margin-bottom: 3mm;
                /* Jarak antar baris */
                box-sizing: border-box;
                page-break-inside: avoid;
                /* Jangan potong label di tengah */
                overflow: hidden;
                /* Sembunyikan jika konten terlalu panjang */
                position: relative;
            }

            /* Paksa baris baru setiap item ke-4, 7, dst (Opsional, tapi membantu kerapian) */
            /* .label-box:nth-child(3n+1) { clear: left; } */
        }

        /* Tampilan Layar Biasa */
        body {
            background-color: #f0f0f0;
        }

        /* Styling Konten Label */
        .header-content {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 2px;
        }

        .logo {
            width: 40px;
            height: auto;
            margin-right: 10px;
        }

        .header-text {
            flex-grow: 1;
            text-align: center;
            line-height: 1.1;
        }

        .company-name {
            font-size: 8px;
            font-weight: bold;
        }

        .label-title {
            font-size: 10px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Tabel Data */
        .info-table {
            width: 100%;
            font-size: 9px;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
            padding: 0 1px;
            line-height: 1.2;
        }

        /* Tabel Tanda Tangan */
        .signature-table {
            width: 100%;
            margin-top: 2px;
            border-collapse: collapse;
            position: absolute;
            bottom: 4px;
            /* Tempel di bawah box */
            left: 4px;
            right: 4px;
            width: calc(100% - 8px);
        }

        .signature-table td {
            border: 1px solid black;
            text-align: center;
            font-size: 7px;
            height: 25px;
            /* Tinggi kotak TTD */
        }

        .signature-header {
            background-color: #fff;
            font-weight: bold;
            font-size: 7px;
        }
    </style>
</head>

@php
    $k = request()->get('k');
@endphp

<body x-data="{ jumlah: 1 }">

    <div class="no-print container mt-3">
        <div class="card">
            <div class="card-body bg-white shadow-sm d-flex align-items-center justify-content-between">
                <div>
                    <label class="fw-bold">Jumlah Label per Item:</label>
                    <input type="number" class="form-control d-inline-block w-auto ms-2" min="1"
                        x-model.number="jumlah" placeholder="Contoh: 73">
                </div>
                <div>
                    <button onclick="window.print()" class="btn btn-primary">
                        🖨️ Cetak Sekarang
                    </button>
                </div>
            </div>
            <div class="card-footer text-muted small">
                Tips: Pastikan Paper Size diatur ke <b>A4</b> dan Margins ke <b>None</b> atau <b>Default</b> pada dialog
                print.
            </div>
        </div>
    </div>

    <div class="container-print p-1">

        @foreach ($labels as $d)
            <template x-for="i in jumlah" :key="i">

                <div class="label-box">
                    <div class="header-content">
                        <img src="{{ asset('img/logo.jpeg') }}" class="logo" alt="Logo">
                        <div class="header-text">
                            <div class="company-name">PT. AGRIKA GATYA ARUM</div>
                            <div class="label-title">Identitas Bahan {{ ucwords($d->kategori) }}</div>
                        </div>
                    </div>

                    <table class="info-table">
                        <tr>
                            <td width="35%">Nama
                                {{ in_array($d->kategori, ['barang', 'kemasan']) ? 'Barang' : 'Bahan Baku' }}</td>
                            <td width="2%">:</td>
                            <td>
                                <b>
                                    {{ $d->kategori == 'Baku' ? ucwords(strtolower($d->grade)) : ucwords($d->barang->nama_barang) }}
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Produsen</td>
                            <td>:</td>
                            <td>{{ $d->kategori == 'Baku' ? ucwords($d->rumah_walet) : $d->supplier }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Kedatangan</td>
                            <td>:</td>
                            <td>
                                @php
                                    // Helper tanggal sederhana jika function tanggal() tidak terbaca di blade ini
                                    $tgl_raw =
                                        $d->kategori == 'Baku'
                                            ? $d->tgl
                                            : ($d->kategori == 'barang'
                                                ? $d->tanggal_terima
                                                : $d->tanggal_penerimaan);
                                    echo date('d M Y', strtotime($tgl_raw));
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td>Kode Lot</td>
                            <td>:</td>
                            <td>{{ $d->kategori == 'Baku' ? $d->no_invoice : $d->kode_lot }}</td>
                        </tr>

                        @if ($d->kategori == 'Baku')
                            <tr>
                                <td>Kode Grading</td>
                                <td>:</td>
                                <td>{{ $d->kode }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $d->keterangan ?? '-' }}</td>
                        </tr>
                    </table>

                    <table class="signature-table">
                        <tr class="signature-header">
                            <td width="33%">
                                {{ $k == 'sbw' ? 'KEPALA GUDANG BAHAN BAKU' : 'KEPALA PURCHASING' }}
                            </td>
                            <td width="33%">
                                {{ $k != 'sbw' ? 'KEPALA GUDANG KEMASAN' : 'KEPALA QC' }}
                            </td>
                            <td width="33%">STATUS</td>
                        </tr>
                        <tr>
                            <td style="padding-top:2px;">
                                <x-ttd-barcode size="35" :id_pegawai="whereTtd($k == 'sbw' ? 'KEPALA GUDANG BAHAN BAKU' : 'KEPALA PURCHASING')" />
                            </td>
                            <td style="padding-top:2px;">
                                <x-ttd-barcode size="35" :id_pegawai="whereTtd($k != 'sbw' ? 'KEPALA GUDANG BARANG KEMASAN' : 'Kepala Lab & FSTL')" />
                            </td>
                            <td style="font-weight:bold; font-size: 8px;">
                                PASS / REJECT
                                <br>
                                <span style="font-size: 6px; font-weight:normal;">(Coret yang tidak perlu)</span>
                            </td>
                        </tr>
                    </table>
                </div>

            </template>
        @endforeach

        <div style="clear: both;"></div>
    </div>

</body>

</html>
