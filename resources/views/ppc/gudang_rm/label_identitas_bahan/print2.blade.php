<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Label</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* --- STYLE ASLI ANDA (DIPERTAHANKAN) --- */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            /* Penting: Tambahkan width 100% ke row agar page break berfungsi di dalam flex */
            .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                /* Center agar rapi */
                width: 100%;
            }

            .tidak-cetak {
                display: none;
            }

            /* PERBAIKAN PAGE BREAK */
            .page-break {
                page-break-after: always;
                break-after: page;
                /* Properti ini memaksa elemen break mengambil lebar penuh row,
                   sehingga elemen berikutnya jatuh ke halaman baru */
                width: 100%;
                height: 0;
                margin: 0;
                visibility: hidden;
            }

            /* Paksa A4 Landscape */
            @page {
                size: A4 landscape;
                margin: 5mm;
            }
        }

        .label {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            width: 30%;
            /* Tetap 30% sesuai asli */
            display: inline-block;
            /* Support flex & block */
            margin: 0.8%;
            /* Sedikit penyesuaian margin agar 3 kolom pas */
            box-sizing: border-box;
            background: white;
        }

        .header {
            text-align: center;
            font-weight: bold;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .label-content {
            font-size: 12px;
            text-align: left;
            line-height: 10px;
        }

        .signature-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signature-table td {
            border: 1px solid black;
            text-align: center;
            height: 35px;
            font-size: 9px;
        }

        .ms-4 {
            margin-left: 2.5rem !important;
        }

        @media print {
            html {
                zoom: .95;
            }

            /* Zoom disesuaikan sedikit agar pas */
        }
    </style>
</head>
@php
    $k = request()->get('k');
@endphp

<body x-data="{ jumlah: 1 }">
    <center>
        <div class="tidak-cetak p-2">
            <div class="d-flex justify-content-center align-items-center gap-2">
                <label>Jumlah Copy:</label>
                <div class="col-2">
                    <input type="number" class="form-control form-control-sm" placeholder="Jml" min="1"
                        x-model.number="jumlah">
                </div>
                <button onclick="window.print()" class="btn btn-primary btn-sm">Print</button>
            </div>
        </div>

        <div class="p-2 container-fluid">
            <div class="row">

                @foreach ($labels as $d)
                    <template x-for="i in jumlah" :key="i">
                        <div style="display: contents;">

                            <div class="label mt-1">
                                <div class="header">
                                    <div class="d-flex align-items-start">
                                        <img src="{{ asset('img/logo.jpeg') }}" class="logo" alt="Logo"
                                            style="height:40px;">
                                        <div class="flex-grow-1 text-center">
                                            <p style="font-size: 9px; margin:0;">PT. AGRIKA GATYA ARUM</p>
                                            <p style="font-size: 9px; margin:0;">
                                                <strong><u>Identitas Bahan {{ ucwords($d->kategori) }}</u></strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <table style="font-size: 9px; text-align: left; width:100%">
                                    <tr>
                                        <td width="35%">Nama
                                            {{ in_array($d->kategori, ['barang', 'kemasan']) ? 'Barang' : 'Bahan Baku' }}
                                        </td>
                                        <td>:</td>
                                        <th>{{ $d->kategori == 'Baku' ? ucwords(strtolower($d->grade)) : ucwords($d->barang->nama_barang) }}
                                        </th>
                                        @if ($d->kategori == 'Baku')
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Nama Produsen</td>
                                        <td>:</td>
                                        <td>{{ $d->kategori == 'Baku' ? ucwords($d->rumah_walet) : $d->supplier }}</td>
                                        @if ($d->kategori == 'Baku')
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kedatangan</td>
                                        <td>:</td>
                                        <td>
                                            @if ($d->kategori == 'Baku')
                                                @php $tgl_sbw = date('Y-m-d', strtotime($d->tgl)); @endphp
                                                {{-- Sesuaikan function tanggal() jika ada, atau pakai date biasa --}}
                                                {{ date('d-m-Y', strtotime($tgl_sbw)) }}
                                            @elseif($d->kategori == 'barang')
                                                {{ date('d-m-Y', strtotime($d->tanggal_terima)) }}
                                            @else
                                                {{ date('d-m-Y', strtotime($d->tanggal_penerimaan)) }}
                                            @endif
                                        </td>
                                        @if ($d->kategori == 'Baku')
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        @endif
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
                                            <td>{{ $d->kategori == 'Baku' ? $d->kode : $d->kode_lot }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $d->keterangan ?? '-' }}</td>
                                    </tr>
                                </table>
                                <table class="signature-table">
                                    <tr>
                                        <td width="30%">
                                            {{ $k == 'sbw' ? 'KEPALA GUDANG BAHAN BAKU' : 'KEPALA PURCHASING' }}</td>
                                        <td width="30%">
                                            {{ $k != 'sbw' ? 'KEPALA GUDANG BARANG KEMASAN' : 'KEPALA QC' }}</td>
                                        <td width="30%">STATUS</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 55px">
                                            <x-ttd-barcode size="40" :id_pegawai="whereTtd(
                                                $k == 'sbw' ? 'KEPALA GUDANG BAHAN BAKU' : 'KEPALA PURCHASING',
                                            )" />
                                        </td>
                                        <td>
                                            <x-ttd-barcode size="40" :id_pegawai="whereTtd(
                                                $k != 'sbw' ? 'KEPALA GUDANG BARANG KEMASAN' : 'Kepala Lab & FSTL',
                                            )" />
                                        </td>
                                        <td>
                                            PASS / REJECT <br>
                                            <span style="font-size: 8px">(Coret yang tidak perlu)</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <template x-if="i % 9 === 0 && i < jumlah">
                                <div class="page-break"></div>
                            </template>

                        </div>
                    </template>

                    <div class="page-break"></div>
                @endforeach

            </div>
        </div>
    </center>
</body>

</html>
