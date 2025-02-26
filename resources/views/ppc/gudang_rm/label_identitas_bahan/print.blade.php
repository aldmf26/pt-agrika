<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Label</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

            .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                page-break-inside: avoid;
            }
        }

        .label {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            width: 48%;
            display: inline-block;
            margin: 1%;
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
            height: 50px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <center>
        <div class="container mt-3 p-4">
            <div class="row">
                @foreach ($labels as $d)
                    <!-- Label pertama -->
                    <div class="label mt-3">
                        <div class="header">
                            <div class="d-flex justify-content-evenly">
                                <img src="{{ asset('img/logo.jpeg') }}" class="logo" alt="Logo">
                                <p>PT. AGRIKAGATYA ARUM</p>
                            </div>

                            <p><strong><u>Identitas Bahan {{ ucwords($d->identitas) }}</u></strong></p>
                        </div>
                        <table style="font-size: 10px; text-align: left">
                            <tr>
                                <td>Nama Bahan Baku</td>
                                <td>:</td>
                                <th>{{ $d->barang->nama_barang }}</th>
                            </tr>
                            <tr>
                                <td>
                                    @if ($d->identitas == 'baku sbw')
                                        No. Reg RBW
                                    @else
                                        Nama Produsen
                                    @endif
                                </td>
                                <td>:</td>
                                <td>{{ $d->noregrbw_nmprodusen }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kedatangan</td>
                                <td>:</td>
                                <td>{{ tanggal($d->tgl_kedatangan) }}</td>
                            </tr>
                            <tr>
                                <td>No. Lot</td>
                                <td>:</td>
                                <td>{{ $d->barang->no_lot }}</td>
                            </tr>
                            <tr>
                                <td>Kode Grading/Bahan</td>
                                <td>:</td>
                                <td>{{ $d->barang->kode_barang }}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{ $d->keterangan }}</td>
                            </tr>
                        </table>
                        <table class="signature-table">
                            <tr>
                                <td>Ka Gudang</td>
                                <td>QC Incoming</td>
                                <td>Status</td>
                            </tr>
                            <tr>
                                <td></td> <!-- Untuk tanda tangan -->
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </center>
    <script>
        window.print(); // Otomatis print saat halaman dibuka
    </script>
</body>

</html>
