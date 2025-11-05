<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
    <style>
        .cop_judul {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 15px;
        }

        .shapes {
            border: 1px solid black;
            border-radius: 10px;
        }

        .cop_text {
            font-size: 12px;
            text-align: left;
            font-weight: normal;
            margin-top: 100px;

        }

        .dhead {
            background-color: #C0C0C0 !important;
        }

        .bg-black {
            background-color: black !important;
        }

        .border_atas {
            border-top: 1px solid black;
        }

        .border_bawah {
            border-bottom: 1px solid black;
        }

        .border_kanan {
            border-right: 1px solid black;
            padding-right: 6px;
        }

        .border_kiri {
            border-left: 1px solid black;
            padding-left: 6px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 mt-4">
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">LAPORAN PENGGUNAAN INSTALASI KARANTINA HEWAN</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QC.01.02, Rev.00</p>
                <br>

            </div>
            <div class="col-4"></div>
            <div class="col-10">
                <table>
                    <tr>
                        <td>Kepada Yth.</td>
                    </tr>
                    <tr>
                        <td>KEPALA Badan Karantina Pertanian</td>
                    </tr>
                    <tr>
                        <td>Melalui</td>
                    </tr>
                    <tr>
                        <td>KEPALA UPT Balai Karantina Kelas I</td>
                    </tr>
                    <tr>
                        <td>Banjarmasin Kalimantan Selatan</td>
                    </tr>
                </table>

            </div>
            <div class="col-lg-12">
                <br>
                <br>
                <table width="100%">
                    <tr>
                        <td>Nama Pemilik</td>
                        <td width="1%">:</td>
                        <td width="50%">{{ $laporan->nama_pemilik }}</td>
                    </tr>
                    <tr>
                        <td>No. SK Penetapan</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->no_sk }}</td>
                    </tr>
                    <tr>
                        <td>Masa Berlaku</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->masa_berlaku }}</td>
                        <td>Perusahaan</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->perusahaan }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Media Pembawa</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->jenis_media_pembawa }}</td>
                        <td>Alamat Perusahaan</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Negara / Area Asal</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->negara_asal }}</td>
                        <td>No. Telp</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>Kapasitas / Daya tampung</td>
                        <td width="1%">:</td>
                        <td>{{ $laporan->kapasitas }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center align-middle fw-thin" rowspan="2">No.</td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Tanggal Pemeriksaan</td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Jenis Media Pembawa</td>
                            <td class="text-center align-middle fw-thin" colspan="3" class="text-center">Realisasi
                            </td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Tanggal Pengeluaran</td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Petugas Karantina Hewan</td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Ket/kejadian khusus selama masa
                                pengamatan (*)</td>
                            <td class="text-center align-middle fw-thin" rowspan="2">Keterangan</td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle fw-thin">Jumlah (ekor/kg)</td>
                            <td class="text-center align-middle fw-thin">Negara / Area Asal</td>
                            <td class="text-center align-middle fw-thin">Negara / Area Tujuan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan_detail as $l)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($l->tgl)) }}</td>
                                <td class="text-center">{{ $l->jenis_media_pembawa }}</td>
                                <td class="text-center">{{ $l->jumlah }}</td>
                                <td class="text-center">{{ $l->negara_asal }}</td>
                                <td class="text-center">{{ $l->negara_tujuan }}</td>
                                <td class="text-center">{{ date('d/m/Y', strtotime($l->tgl_pengeluaran)) }}</td>
                                <td class="text-center">{{ $l->petugas_karantina_hewan }}</td>
                                <td class="text-center">{{ $l->kejadian }}</td>
                                <td class="text-center">{{ $l->keterangan }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="col-12">
                <p>(*) kejadian khusus : Ditemukan HPHK dan atau perlakuan, pemusnahan akibat adanya HPHK</p>
                <p>Demikian laporan ini dibuat dengan sesungguhnya untuk dipergunakan seperlunya.</p>
            </div>
            <div class="col-lg-8"></div>
            <div class="col-lg-4 text-center">
                <p>Banjarmasin , {{ date('d M Y') }}</p>
                <br>
            </div>
            <div class="col-lg-4 text-center">
                <p>Subkoordinator Karantina Hewan</p>
                <p>Balai Karantina Pertanian Kelas I Banjarmasin</p>
                <br>
                <br>
                <p>Drh. Isrokal</p>
                <p>NIP. 19820519 200912 1 003</p>
            </div>
            <div class="col-lg-4 text-center">
                <p>Pemilik IKH</p>
                <p>&nbsp;</p>
                <br>
                <br>
                <p>Herry Setiawan Gema</p>
                <p></p>
            </div>
            <div class="col-lg-4 text-center">
                <p>Drh Penanggungjawab IKH</p>
                <p>&nbsp;</p>
                <br>
                <br>
                <p>Drh. Edi Sentosa</p>
                <p></p>
            </div>


        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
