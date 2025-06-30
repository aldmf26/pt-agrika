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
            <div class="col-2 mt-4">
                <img style="width: 120px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-8 mt-4">
                <div class="shapes">
                    <p class="cop_judul">Form Ketelusuran (Traceability)
                    </p>

                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-8"></div>
            <div class="col-4 ">
                <p class="mt-2">Dok.No.: FRM.QA.07.01</p>

            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">NO URUT</th>
                            <th class="text-center align-middle">TGL PANEN</th>
                            <th class="text-center align-middle">TGL DATANG</th>
                            <th class="text-center align-middle">NO. REG. RUMAH WALET</th>
                            <th class="text-center align-middle">NAMA RUMAH WALET</th>
                            <th class="text-center align-middle">BATCH MATERIAL</th>
                            <th class="text-center align-middle">BERAT KOTOR RAW (KG)</th>
                            <th class="text-center align-middle">BERAT AKHIR GRADING RAW (KG)</th>
                            <th class="text-center align-middle">SUSUT SORTIR (KG)</th>
                            <th class="text-center align-middle">BERAT SAAT PEMBAGIAN (Gram)</th>
                            <th class="text-center align-middle">TGL PRODUKSI (PENCABUTAN)</th>
                            <th class="text-center align-middle">JML KEPING AWAL (pcs & gram)</th>
                            <th class="text-center align-middle">BERAT HASIL CABUT & DRYING (pcs / gram)</th>
                            <th class="text-center align-middle">TANGGAL SELESAI DRYING</th>
                            <th class="text-center align-middle">TANGGAL SELESAI CETAK</th>
                            <th class="text-center align-middle">JUMLAH KEPING CETAK</th>
                            <th class="text-center align-middle">BERAT HASIL CETAK</th>
                            <th class="text-center align-middle">TGL FINEAL GRADING AKHIR</th>
                            <th class="text-center align-middle">JUMLAH KEPING GRADING AKHIR</th>
                            <th class="text-center align-middle">BERAT AKHIR GRADING AKHIR (KERING)</th>
                            <th class="text-center align-middle">TANGGAL STEAM</th>
                            <th class="text-center align-middle">JML KEPING AKHIR (pcsm)</th>
                            <th class="text-center align-middle">JML BERAT AKHIR (gram)</th>
                            <th class="text-center align-middle">PRESENTASE YIELD (%)</th>
                            <th class="text-center align-middle">JUMLAHKEPING YANG DITERIMA GUDANG</th>
                            <th class="text-center align-middle">BERAT MASUK GUDANG PRODUK JADI</th>
                            <th class="text-center align-middle">TANGGAL MASUK GUDANG PRODUK JADI</th>
                            <th class="text-center align-middle">JUMLAH KEPING TERKIRIM</th>
                            <th class="text-center align-middle">PRODUK TERKIRIM (Gram)</th>
                            <th class="text-center align-middle">TGL PENGIRIMAN</th>
                            <th class="text-center align-middle">TUJUAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @php
                                $rumah_walet = DB::table('rumah_walet')->where('id', $bk['rwb_id'])->first();
                            @endphp
                            <td class="align-middle text-center">1</td>
                            <td class="align-middle text-center">{{ date('d/m/Y', strtotime($bk['tgl'])) }}</td>
                            <td class="align-middle text-center">{{ date('d/m/Y', strtotime($bk['tgl'] . ' + 1 day')) }}
                            </td>
                            <td class="align-middle text-center">{{ $rumah_walet->no_reg }}</td>
                            <td class="align-middle text-center">{{ $rumah_walet->nama }}</td>
                            <td class="align-middle text-nowrap">{{ $bk['no_invoice'] }}</td>
                            <td class="align-middle text-center text-nowrap">
                                {{ number_format($bk['gr_kotor'] / 1000, 2) }} Kg</td>
                            <td class="align-middle text-center text-nowrap">
                                {{ number_format($bk['gr_awal'] / 1000, 2) }} Kg</td>
                            <td class="align-middle text-center text-nowrap">
                                {{ number_format(($bk['gr_kotor'] - $bk['gr_awal']) / 1000, 2) }} Kg</td>
                        </tr>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // window.print();
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
