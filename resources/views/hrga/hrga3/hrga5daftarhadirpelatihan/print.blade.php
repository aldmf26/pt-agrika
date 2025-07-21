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
                <img style="width: 150px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">DAFTAR HADIR PELATIHAN</p>
                </div>
            </div>
            <div class="col-3 ">
                <p class="cop_text">Dok.No.: FRM.HRGA.03.05, Rev.00</p>
            </div>
            <div class="col-12">
                <table class="table table-bordered" with="100%">
                    <tr>
                        <td width="20%" class="dhead p-2">Tema Pelatihan</td>
                        <td colspan="4">{{ $jadwal->tema_pelatihan }}</td>
                    </tr>
                    <tr>
                        <td width="20%" class="dhead p-2">Hari/Tanggal</td>
                        <td>{{ tanggal($jadwal->tanggal) }}
                        </td>
                        <td width="20%" class="dhead p-2">Waktu</td>
                        <td>{{ $jadwal->waktu }}</td>
                    </tr>
                    <tr>
                        <td width="20%" class="dhead p-2">Tempat</td>
                        <td colspan="4">{{ $jadwal->tempat }}</td>
                    </tr>
                    <tr>
                        <td width="20%" class="dhead p-2">Narasumber</td>
                        <td colspan="4">{{ $jadwal->narasumber }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-12 mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center dhead align-middle">No</th>
                            <th class="text-start dhead align-middle">
                                Nama Peserta Training
                            </th>
                            <th class="text-center dhead align-middle">
                                Div / Dept
                            </th>
                            <th class="text-center dhead align-middle">
                                Jabatan
                            </th>
                            <th class="text-center dhead align-middle">
                                Tanda Tangan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal_detail as $j)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $j->data_pegawai->nama }}</td>
                                <td class="text-center">{{ $j->data_pegawai->divisi->divisi }}</td>
                                <td class="text-center">{{ $j->data_pegawai->posisi }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <div class="col-6">
                <p class="ms-3">Penyelenggara : </p>
                <p class="ms-3"><input type="checkbox" name="" id=""
                        {{ $jadwal->penyelenggara == 'internal' ? 'checked' : '' }}> Internal</p>
                <p class="ms-3"><input type="checkbox" name="" id=""
                        {{ $jadwal->penyelenggara == 'eksternal' ? 'checked' : '' }}> Eksternal</p>

            </div>
            <div class="col-6">
                <p>Banjarmasin , {{ date('d-m-Y') }}</p>
                <br>
                (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
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
