<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-mobile" role="alert">
            <h3 class="alert-heading">Verifikasi Tanda Tangan Digital</h3>
            <p><b>Nama: {{ $pegawai->nama }}</b></p>
            <p>Divisi: {{ $pegawai->divisi->divisi }}</p>
            <p>Posisi: {{ $pegawai->posisi }}</p>
            <p>Status: <span class="badge bg-success">Valid</span></p>
        </div>
    </div>
</body>

</html>
