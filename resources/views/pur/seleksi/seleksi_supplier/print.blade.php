<x-hccp-print :title="$title" :dok="$dok">
    <style>
        /* Gaya khusus untuk tabel informasi produk */
        .produk-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .produk-table th {
            background-color: #eee;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #000;
        }

        .produk-table td {
            padding: 6px;
        }

        .produk-table td:first-child {
            border-right: 1px solid #000;
            vertical-align: top;
        }

        .produk-table td.checkbox-cell {
            vertical-align: top;
        }
    </style>
    <br>
    <table>
        <tr>
            <th>Nama Suplier</th>
            <th>: {{ $nama }}</th>
        </tr>
        <tr>
            <th>Jenis Supply</th>
            <th>: Material SBW Kotor</th>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>: {{ $rumah_walet->alamat }}</th>
        </tr>


    </table>

    <br>
    <table class="produk-table">
        <tr>
            <th class="dhead" colspan="2">INFORMASI PRODUK</th>
        </tr>
        <tr>
            <td width="50%" rowspan="2">Material/Kemasan/Barang/Jasa<br>yang ditawarkan</td>
            <td>: <span class="highlight">SBW Kotor</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Spesifikasi</td>
            <td>
                1. <span class="highlight">Tidak Ada Jamur Pink</span><br>
                2. <span class="highlight">Tidak Boleh Ada Batu</span>
            </td>
        </tr>
        <tr>
            <td>Nomor Reg RW</td>
            <td class="checkbox-cell">
                <input type="checkbox"> Ada (lampirkan)
                <input type="checkbox" checked> Tidak Ada
                <input type="checkbox"> Tidak relevan
            </td>
        </tr>
        <tr>
            <td>Estimasi Delivery (sejak PO diterima)</td>
            <td>: <span class="highlight">min 3 hari</span></td>
        </tr>
    </table>
    <br>
    <table class="produk-table">
        <tr>
            <th class="dhead" colspan="2">INFORMASI MANAJEMEN</th>
        </tr>
        <tr>
            <td colspan="2">Sistem Manajemen yang telah diterapkan di Perusahaan Anda :</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="50%">Spesifikasi</td>
            <td>
                1. <span class="highlight">Tidak Ada Jamur Pink</span><br>
                2. <span class="highlight">Tidak Boleh Ada Batu</span>
            </td>
        </tr>
        <tr>
            <td>Nomor Reg RW</td>
            <td class="checkbox-cell">
                <input type="checkbox"> Ada (lampirkan)
                <input type="checkbox" checked> Tidak Ada
                <input type="checkbox"> Tidak relevan
            </td>
        </tr>
        <tr>
            <td>Estimasi Delivery (sejak PO diterima)</td>
            <td>: <span class="highlight">min 3 hari</span></td>
        </tr>
    </table>




</x-hccp-print>
