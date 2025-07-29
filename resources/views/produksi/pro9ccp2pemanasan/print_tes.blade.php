<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Cetak</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 2cm 2cm 3cm 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            page-break-after: always;
        }

        .kop {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 6px;
        }

        .kop h2,
        .kop p {
            margin: 0;
        }

        h3 {
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 12px;
        }

        thead {
            display: table-header-group;
        }

        .ttd {
            margin-top: 30px;
            text-align: right;
            padding-right: 2cm;
            font-size: 12px;
        }

        .ttd p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div id="container"></div>

    <script>
        const container = document.getElementById("container");

        // Contoh data dinamis
        const data = [];
        for (let i = 1; i <= 65; i++) {
            data.push({
                no: i,
                nama: `Nama ${i}`,
                jabatan: `Jabatan ${i}`,
                unit: `Unit ${i}`,
                ket: `Keterangan ${i}`
            });
        }

        const perPage = 25;
        const pages = Math.ceil(data.length / perPage);

        for (let p = 0; p < pages; p++) {
            const pageData = data.slice(p * perPage, (p + 1) * perPage);
            const page = document.createElement("div");
            page.className = "page";

            page.innerHTML = `
        <div class="kop">
          <h2>Nama Instansi / Perusahaan</h2>
          <p>Alamat lengkap - Telepon - Website</p>
        </div>

        <h3>Judul Laporan</h3>

        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Unit</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            ${pageData.map(row => `
                  <tr>
                    <td>${row.no}</td>
                    <td>${row.nama}</td>
                    <td>${row.jabatan}</td>
                    <td>${row.unit}</td>
                    <td>${row.ket}</td>
                  </tr>
                `).join("")}
          </tbody>
        </table>

        <div class="ttd">
          <p>Mengetahui,</p>
          <br><br><br>
          <p>(Nama Pejabat)</p>
          <p>NIP: 123456789</p>
        </div>
      `;

            container.appendChild(page);
        }
    </script>
</body>

</html>
