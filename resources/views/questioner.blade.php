<!DOCTYPE html>
<html lang="en">

<head>
    <title>Food Safety Culture Questioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 50px;
            vertical-align: middle;
        }

        .instructions {
            background-color: #ffd700;
            padding: 10px;
            margin-bottom: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }



        .category-header {
            font-weight: bold;
            text-align: start;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>FOOD SAFETY CULTURE QUESTIONER</h1>
        <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
            <h3>PT Agrika Gatya Arum</h3>
            <img style="width: 100px" src="{{ asset('img/logo.jpeg') }}" alt="">
        </div>
    </div>

    @if (session('sukses'))
        <div class="alert alert-success">
            {{ session('sukses') }}
        </div>
    @else
        <div class="instructions">
            <p><strong>Petunjuk Pengisian :</strong></p>
            <ol>
                <li>Pilih jenis kelamin dan bagian pekerjaan</li>
                <li>Jawablah pernyataan di bawah ini dengan jawaban di samping, sesuai dengan kondisi aktual di
                    lapangan.
                    Jika belum mengerti mengenai pertanyaannya bisa ditanyakan pada pihak HRD.</li>
            </ol>
        </div>

        <form action="{{ route('questioner.store') }}" method="POST" class="table-container">
            @csrf

            <div class="row ">
                <div class="col-3">

                    <div class="form-group">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input id="laki" class="form-check-input" type="radio" name="gender" value="L"
                                required>
                            <label class="form-check-label" for="laki">Laki laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="perempuan" class="form-check-input" type="radio" name="gender" value="P"
                                required>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        @error('gender')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="bagian_pekerjaan" class="form-label">Bagian Pekerjaan</label>
                        <select name="bagian_pekerjaan" class="form-control" required>
                            <option value="Management">Management</option>
                            <option value="Staff">Staff</option>
                            <option value="Produksi">Produksi</option>
                        </select>
                        @error('bagian_pekerjaan')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <table class="mt-3">
                <tr>
                    <th colspan="2""></th>
                    <th class="text-center">Sangat <br> Benar</th>
                    <th class="text-center">Benar</th>
                    <th class="text-center">Netral</th>
                    <th class="text-center">Tidak <br> Benar</th>
                    <th class="text-center">Tidak Benar <br> Sama Sekali</th>
                </tr>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Questioner</th>
                    <th class="text-center">5</th>
                    <th class="text-center">4</th>
                    <th class="text-center">3</th>
                    <th class="text-center">2</th>
                    <th class="text-center">1</th>
                </tr>
                @foreach ($pertanyaan->groupBy('kategori') as $kategori => $questions)
                    <tr>
                        <td colspan="7" class="category-header">{{ $kategori }}</td>
                    </tr>
                    @foreach ($questions as $p)
                        <tr>
                            <td class="text-center">{{ $p->no_pertanyaan }}</td>
                            <td>{{ $p->teks_pertanyaan }}</td>
                            @for ($i = 5; $i >= 1; $i--)
                                <td class="text-center">
                                    <input type="radio" style="width: 2em; height: 2em;"
                                        name="jawaban[{{ $p->id }}]" value="{{ $i }}" required>
                                </td>
                            @endfor
                            @error('jawaban.' . $p->id)
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </tr>
                    @endforeach
                @endforeach
            </table>
            <button type="submit" class="btn btn-primary float-end">Simpan</button>
        </form>
    @endif


</body>

</html>
