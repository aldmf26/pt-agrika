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
                    <p class="cop_judul">JADWAL VERIFIKASI</p>

                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.QA.07.01, Rev.00</p>
                <br>

            </div>
            <div class="col-4"></div>
            <div class="col-10">
            </div>
            <div class="col-lg-12">
                <br>
                <table class="table table-bordered border-dark table-sm" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th colspan="5"></th>
                            <th colspan="12" class="text-center">Tahun {{ $tahun }}</th>
                        </tr>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Aktivitas</th>
                            <th class="text-nowrap text-center">Frekuensi</th>
                            <th class="text-nowrap text-center">Dept</th>
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $tgl = date('M', strtotime($tahun . '-' . $i . '-01'));
                                @endphp
                                <th class="text-center">{{ $tgl }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $audit)
                            <tr>
                                <td class="text-end">{{ $key + 1 }}</td>
                                <td>
                                    {{ ucfirst(strtolower($audit->item)) }}
                                </td>
                                <td>{{ $audit->aktivitas }}</td>
                                <td class="text-nowrap">{{ $audit->frek }}</td>
                                <td class="text-nowrap">{{ $audit->departemen }}</td>
                                @for ($i = 1; $i <= 12; $i++)
                                    @php
                                        $field = 'bulan_' . $i; // Nama kolom di database
                                        $cek = DB::table('jadwal_verifikasis')
                                            ->where('id', $audit->id)
                                            ->where('tahun', $tahun)
                                            ->value($field);

                                        $cekSelesai = App\Models\Notif::where([
                                            ['nama', $audit->item],
                                            ['month', $i],
                                            ['year', $tahun],
                                            ['user_id', auth()->user()->id],
                                            ['is_read', 1],
                                        ])->first();
                                    @endphp
                                    <td
                                        class="text-center td-hover @if ($cekSelesai) bg-success @elseif ($cek == 1) bg-warning @endif">
                                    </td>
                                @endfor
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>




        </div>
        <div class="row">
            <div class="col-8">
                <table>
                    <tr>
                        <td class="bg-warning" width="50%">&nbsp;</td>
                        <td>Rencana Eksekusi</td>
                    </tr>
                    <tr>
                        <td class="bg-success" width="50%">&nbsp;</td>
                        <td>Batas Realisasi</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-bordered border-dark" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="25%">Dibuat Oleh:</th>
                            <th class="text-center" width="25%">Diketahui Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('KEPALA LAB & FSTL')" />
                            </td>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('DIREKTUR UTAMA')" />
                            </td>
                        </tr>
                        <tr>

                            <td class="text-center align-middle">
                                (KEPALA LAB & FSTL)
                            </td>
                            <td class="text-center align-middle">
                                (DIREKTUR UTAMA)
                            </td>

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
