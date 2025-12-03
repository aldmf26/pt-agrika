<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Informasi Tawaran Pelatihan</button>

            <button class="btn btn-sm btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#print"><i
                    class="fas fa-print"></i> print</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-center">No</th>
                        <th rowspan="2" class="align-center">Tanggal informasi</th>
                        <th rowspan="2" class="align-center">Jenis pelatihan</th>
                        <th rowspan="2" class="align-center">Sasaran pelatihan</th>
                        <th rowspan="2" class="align-center">
                            Tema pelatihan <br> [yang ditawarkan]
                        </th>
                        <th rowspan="2" class="align-center">Sumber informasi</th>
                        <th rowspan="2" class="align-center">Personil penghubung</th>
                        <th>No.Telp</th>
                        <th rowspan="2" class="align-center">Aksi</th>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informasi as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y', strtotime($i->tanggal)) }}</td>
                            <td>{{ ucfirst(strtolower($i->jenis)) }}</td>
                            <td>{{ ucfirst(strtolower($i->sasaran)) }}</td>
                            <td>{{ ucfirst(strtolower($i->tema)) }}</td>
                            <td>{{ ucfirst(strtolower($i->sumber_informasi)) }}</td>
                            <td>{{ ucfirst(strtolower($i->personil_penghubung)) }}</td>
                            <td>{{ $i->no_telp }} <br> {{ $i->email }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning btn-edit"
                                    data-id="{{ $i->id }}" data-tanggal="{{ $i->tanggal }}"
                                    data-jenis="{{ $i->jenis }}" data-sasaran="{{ $i->sasaran }}"
                                    data-tema="{{ $i->tema }}" data-sumber="{{ $i->sumber_informasi }}"
                                    data-personil="{{ $i->personil_penghubung }}" data-telp="{{ $i->no_telp }}"
                                    data-email="{{ $i->email }}" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>

                                    <form action="{{ route('hrga3.1.destroy', $i->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin Hapus Data ?')"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('hrga3.1.store') }}" method="POST">
        @csrf
        <x-modal idModal="tambah" size="modal-xl" title="Tambah Data Informasi Tawaran Pelatihan">
            <div class="row">

                <div class="col-lg-3">
                    <label for="">Tanggal Informasi</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Jenis Pelatihan</label>
                    <input type="text" name="jenis" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Sasaran Pelatihan</label>
                    <input type="text" name="sasaran" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Tema Pelatihan</label>
                    <input type="text" name="tema" class="form-control" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Sumber Informasi</label>
                    <input type="text" name="sumber_informasi" class="form-control" required>
                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Personil Penghubung</label>
                    <input type="text" name="personil_penghubung" class="form-control" required>
                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">No Telp</label>
                    <input type="text" name="no_telp" class="form-control" required>
                </div>
                <div class="col-lg-3 mt-2">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
            </div>
        </x-modal>
    </form>

    <form action="{{ route('hrga3.1.update') }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" id="edit_id">

        <x-modal idModal="editModal" size="modal-xl" title="Edit Data Informasi Tawaran Pelatihan">
            <div class="row">

                <div class="col-lg-3">
                    <label>Tanggal Informasi</label>
                    <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                </div>

                <div class="col-lg-3">
                    <label>Jenis Pelatihan</label>
                    <input type="text" name="jenis" id="edit_jenis" class="form-control" required>
                </div>

                <div class="col-lg-3">
                    <label>Sasaran Pelatihan</label>
                    <input type="text" name="sasaran" id="edit_sasaran" class="form-control" required>
                </div>

                <div class="col-lg-3">
                    <label>Tema Pelatihan</label>
                    <input type="text" name="tema" id="edit_tema" class="form-control" required>
                </div>

                <div class="col-lg-3">
                    <label>Sumber Informasi</label>
                    <input type="text" name="sumber_informasi" id="edit_sumber" class="form-control" required>
                </div>

                <div class="col-lg-3 mt-2">
                    <label>Personil Penghubung</label>
                    <input type="text" name="personil_penghubung" id="edit_personil" class="form-control"
                        required>
                </div>

                <div class="col-lg-3 mt-2">
                    <label>No Telp</label>
                    <input type="text" name="no_telp" id="edit_telp" class="form-control" required>
                </div>

                <div class="col-lg-3 mt-2">
                    <label>Email</label>
                    <input type="text" name="email" id="edit_email" class="form-control" required>
                </div>

            </div>
        </x-modal>
    </form>



    <form action="{{ route('hrga3.1.print') }}" method="Get" target="_blank">
        <x-modal idModal="print" title="Tambah Data Informasi Tawaran Pelatihan">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Dari</label>
                    <input type="date" name="tgl1" class="form-control" required
                        value="{{ date('Y-m-d', strtotime('-1 month')) }}">
                </div>
                <div class="col-lg-6">
                    <label for="">Sampai</label>
                    <input type="date" name="tgl2" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
            </div>
        </x-modal>
    </form>
    
    @section('scripts')
    <script>
        $(document).on('click', '.btn-edit', function() {
            $('#edit_id').val($(this).data('id'));
            $('#edit_tanggal').val($(this).data('tanggal'));
            $('#edit_jenis').val($(this).data('jenis'));
            $('#edit_sasaran').val($(this).data('sasaran'));
            $('#edit_tema').val($(this).data('tema'));
            $('#edit_sumber').val($(this).data('sumber'));
            $('#edit_personil').val($(this).data('personil'));
            $('#edit_telp').val($(this).data('telp'));
            $('#edit_email').val($(this).data('email'));
        });
    </script>
    @endsection

</x-app-layout>
