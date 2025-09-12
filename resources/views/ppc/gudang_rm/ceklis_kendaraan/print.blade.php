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
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

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

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 7px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .header-info table {
            width: 100%;
        }

        .header-info td {
            padding: 3px;
        }

        .print {
            display: none;
            /* disembunyikan saat layar biasa */
        }

        .input {
            font-size: 8px
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .print {
                display: inline !important;
            }

            .input {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 no-print">
                <button class="btn btn-primary mt-2 float-end" onclick="window.print()">Print</button>
            </div>
            <div class="col-3 mt-4">
                <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">{{ $title }} </p>
                </div>
            </div>
            <div class="col-3">
                <p class="cop_text text-sm" style="font-size: 10px">{{ $dok }}</p>
            </div>
        </div>
        <div class="header-info">
            <p style="font-size: 8px;">BERI TANDA (&#10004;) UNTUK TIAP KOLOM YANG SESUAI STANDAR DAN TANDA (&#10008;)
                UNTUK
                TIAP KOLOM
                YANG
                TIDAK SESUAI STANDAR</p>

            <p style="font-size: 8px;">Jenis Yang diterima : <span class="">SBW KOTOR</span>/<span
                    class="text-decoration-line-through">
                    KEMASAN</span>/<span class="text-decoration-line-through">
                    BARANG</span></p>
            <table class="table table-bordered">

                <tr>
                    <td colspan="2">Tanggal</td>
                    @php
                        $jumlahData = count($checklist);
                        $maxKolom = 9;
                    @endphp

                    @foreach ($checklist as $c)
                        <td class="text-endalign-middle" width="8%" colspan="2">{{ tanggal($c->tgl) }}
                        </td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor
                </tr>
                <tr>
                    <td colspan="2">Jam Kedatangan</td>
                    @foreach ($checklist as $c)
                        <td class="text-end align-middle" width="8%" colspan="2">
                            <input type="time" name="jam_kedatangan[]"
                                value="{{ $c->jam_kedatangan == '00:00:00' || empty($c->jam_kedatangan) ? '15:00' : $c->jam_kedatangan }}"
                                class="form-control input jam_kedatangan" partai="{{ $c->nm_partai }}">

                            <span class="print jam_update" data-partai="{{ $c->nm_partai }}">
                                {{ $c->jam_kedatangan == '00:00:00' || empty($c->jam_kedatangan)
                                    ? date('h:i A', strtotime('15:00:00'))
                                    : date('h:i A', strtotime($c->jam_kedatangan)) }}
                            </span>

                        </td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor
                </tr>

                <tr>
                    <td colspan="2">Kendaraan (Internal / Eksternal)</td>
                    @foreach ($checklist as $c)
                        <td class="align-middle" width="8%" colspan="2">Eksternal</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nomor Kendaraan</td>
                    @foreach ($checklist as $c)
                        <td class="align-middle" width="8%" colspan="2">
                            <input type="text"
                                value="{{ empty($c->no_kndraan_new) ? $c->no_kendaraan : $c->no_kndraan_new }}"
                                class="form-control input no_kendaraan" partai="{{ $c->nm_partai }}">

                            <span class="print no_kendaraan_update"
                                data-partai="{{ $c->nm_partai }}">{{ empty($c->no_kndraan_new) ? $c->no_kendaraan : $c->no_kndraan_new }}</span>

                        </td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center" width="8%" colspan="2">
                        </td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Suplier</td>
                    @foreach ($checklist as $c)
                        <td class="align-middle" width="8%" colspan="2">{{ $c->nama_suplier }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Ekspedisi</td>
                    @foreach ($checklist as $c)
                        <td class="align-middle" width="8%" colspan="2">{{ $c->nama_suplier }}</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="2">Nama Pengemudi</td>
                    @foreach ($checklist as $c)
                        <td class="align-middle" width="8%" colspan="2">
                            <input type="text" value="{{ empty($c->driver) ? $c->pengemudi : $c->driver }}"
                                class="form-control input driver" partai="{{ $c->nm_partai }}">

                            <span class="print driver_update"
                                data-partai="{{ $c->nm_partai }}">{{ empty($c->driver) ? $c->pengemudi : $c->driver }}</span>



                        </td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="align-middle" width="8%" colspan="2"></td>
                    @endfor

                </tr>
                <tr>
                    <td colspan="100"></td>
                </tr>
                <tr>
                    <th class="text-center">No</th>
                    <th>Kondisi Kendaraan</th>
                    @foreach ($checklist as $c)
                        <th class="text-center">WH</th>
                        <th class="text-center">QA</th>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <th class="text-center">WH</th>
                        <th class="text-center">QA</th>
                    @endfor

                </tr>
                @foreach ($kondisi as $k)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class=" text-nowrap">{{ $k->kondisi }}</td>
                        @foreach ($checklist as $c)
                            <td class="text-center">&#10004;</td>
                            <td class="text-center">&#10004;</td>
                        @endforeach

                        @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        @endfor

                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <th>KEPUTUSAN DIPAKAI : Ya (Y) atau TIDAK (T)</th>
                    @foreach ($checklist as $c)
                        <td class="text-center" colspan="2">YA</td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center"></td>
                    @endfor

                </tr>
                <tr>
                    <td></td>
                    <th>Paraf Pemeriksa</th>
                    @foreach ($checklist as $c)
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    @endforeach

                    @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    @endfor

                </tr>
            </table>
        </div>


        <span style="font-size: 7px">
            NOTE : JIKA KONDISI KENDARAAN MEMENUHI SEMUA KETENTUAN TERSEBUT DIATAS DAN KEPUTUSANNYA DIPAKAI MAKA BERIKAN
            TANDA <b>(&#10004;)</b>
            DAN TANDA <b>(&#10008;)</b> JIKA KENDARAAN TERNYATA TIDAK
            DAPAT DIPAKAI / DITOLAK
            LIHAT DETAIL KETERANGAN SETIAP KETENTUAN KONDISI KENDARAAN
        </span>

        <div>
            <table width="100%">
                <tr>
                    <th width="60%" style="border: 1px solid black; " class="align-top">
                        KOMENTAR:
                        {{-- {{ $checklist->komentar }} --}}
                    </th>
                    <td width="25%">

                    </td>
                    <td style="width: 15%">
                        <table class="border-dark table table-bordered" style="font-size: 11px">
                            <thead>
                                <tr>
                                    <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="height: 45px" class="align-middle text-center">
                                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-center">( KA. GUDANG )</td>

                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.jam_kedatangan').change(function(e) {
                e.preventDefault();
                var partai = $(this).attr('partai');
                var jam = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "/update-jam-kedatangan",
                    data: {
                        partai: partai,
                        jam: jam,
                        kategori: 'jam_kedatangan',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                        } else {
                            alert('Gagal update.');
                        }
                        $('.jam_update[data-partai="' + partai + '"]').text(jam);

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });

            });

            // $('.no_kendaraan').keyup(function(e) {
            //     alert('dsa')
            // });
            $('.no_kendaraan').keyup(function(e) {
                e.preventDefault();

                var partai = $(this).attr('partai');
                var no_kendaraan = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "/update-jam-kedatangan",
                    data: {
                        partai: partai,
                        no_kendaraan: no_kendaraan,
                        kategori: 'no_kendaraan',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                        } else {
                            alert('Gagal update.');
                        }
                        $('.no_kendaraan_update[data-partai="' + partai + '"]').text(
                            no_kendaraan);

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });

            });
            $('.driver').keyup(function(e) {
                e.preventDefault();

                var partai = $(this).attr('partai');
                var driver = $(this).val();

                $('.driver_update[data-partai="' + partai + '"]').text(driver);
                $.ajax({
                    type: "Get",
                    url: "/update-jam-kedatangan",
                    data: {
                        partai: partai,
                        driver: driver,
                        kategori: 'driver',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                        } else {
                            alert('Gagal update.');
                        }

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });

            });
        });
    </script>
    {{-- <script>
        window.print();
    </script> --}}

</body>

</html>
