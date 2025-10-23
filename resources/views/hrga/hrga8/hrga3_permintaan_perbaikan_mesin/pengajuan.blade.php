<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--single {
            height: calc(1.5em + .75rem + 2px);
            /* Sesuai tinggi .form-control */
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .select2-container {
            width: 100% !important;
            /* Lebar penuh seperti form-control */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 6px;
            right: 1px;
            width: 20px;
        }
    </style>


    <title>{{ $title }}</title>
</head>

<body>
    <div class="container justify-content-center mt-4">
        <form action="{{ route('hrga8.3.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5 class="title text-center"> {{ $title }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $url = 'formPermintaanperbaikan';
                            $url2 = 'formpengajuan';
                        @endphp
                        <div class="col-lg-12">
                            <ul class="nav nav-pills float-start">

                                <li class="nav-item">
                                    <a class="nav-link  {{ $kategori == 'ruangan' ? 'active' : '' }}"
                                        aria-current="page"
                                        href="{{ route($url, ['kategori' => 'ruangan']) }}">Ruangan</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ $kategori == 'ac' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route($url, ['kategori' => 'ac']) }}">AC</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ $kategori == 'mesin' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route($url2, ['kategori' => 'mesin']) }}">Mesin</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ $kategori == 'it' ? 'active' : '' }}" aria-current="page"
                                        href="{{ route($url2, ['kategori' => 'it']) }}">IT</a>

                                </li>

                            </ul>
                        </div>

                        <div class="col-12 mt-2">
                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                            <label for="">Nama Mesin</label>
                            <select name="item_id" id="" class="select2 item">
                                <option value="">-Pilih Mesin-</option>
                                @foreach ($mesin as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_mesin }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="">Merek</label>
                            <input type="text" class="form-control merk" disabled>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="">No identifikasi</label>
                            <input type="text" class="form-control no_identifikasi" disabled>
                        </div>
                        <div class="col-6 mt-2">
                            <label for="">Diajukan oleh</label>
                            <input type="text" class="form-control" name="diajukan_oleh">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="">Deadline</label>
                            <input type="date" class="form-control" name="deadline">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Deskripsi Masalah</label>
                            <textarea name="deskripsi_masalah" class="form-control" id="" cols="10" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.lokasi', function() {
                var id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('hrga5.1.get_item') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('.item').html(response);
                    }
                });

            })
            $(document).on('change', '.item', function() {
                var id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('hrga5.1.get_merk') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('.merk').val(response.merk);
                        $('.no_identifikasi').val(response.no_identifikasi);
                    }
                });

            })
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                const btn = form.querySelector('button[type="submit"]');
                btn.disabled = true;
                btn.innerText = 'Menyimpan...';
            });
        });
    </script>
</body>

</html>
