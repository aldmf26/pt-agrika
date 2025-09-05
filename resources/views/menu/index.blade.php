<x-app-layout :title="$title">
    <div class="section">
        <div class="row">

            <div class="col-lg-12">
                <table class="table table-bordered" id="tableSave">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Link</th>
                            <th>Contoh</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $item)
                            @php
                                $contoh = DB::table('contoh_image')->where('id_menu', $item->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td><a href="{{ route($item->link) }}" target="_blank" class="btn btn-primary btn-sm"><i
                                            class="fas fa-link"></i></a>
                                </td>
                                <td>
                                    @if (empty($contoh->id))
                                        <button type="button" menu_id="{{ $item->id }}" title="{{ $item->title }}"
                                            class="btn btn-primary btn-sm upload" data-bs-toggle="modal"
                                            data-bs-target="#tambah"><i class="fas fa-plus"></i> Add contoh</button>
                                    @else
                                        <button type="button" menu_id="{{ $item->id }}"
                                            class="btn btn-info btn-sm upload" data-bs-toggle="modal"
                                            data-bs-target="#tambah"><i class="fas fa-eye"></i>
                                            Lihat contoh</button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>

    </div>

    <form action="{{ route('menu.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlplus">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Judul</label>
                                <input type="text" name="judul" class="form-control title" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Masukkan gambar</label>
                                <input type="file" name="contoh" class="form-control" required>
                                <input type="hidden" name="id" class="menu_id">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('scripts')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.upload', function() {

                    const menu_id = $(this).attr('menu_id');
                    const title = $(this).attr('title');


                    $('.menu_id').val(menu_id);
                    $('.title').val(title);
                })
            });
        </script>
    @endsection
</x-app-layout>
