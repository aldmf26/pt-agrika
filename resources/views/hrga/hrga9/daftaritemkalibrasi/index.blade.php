<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fas fa-plus"></i>
                Add
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Merk</th>
                            <th>Nomer Seri</th>
                            <th>Lokasi</th>
                            <th>Lantai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->merk }}</td>
                                <td>{{ $i->nomor_seri }}</td>
                                <td>{{ $i->lokasi->lokasi ?? '-' }}</td>
                                <td>{{ $i->lokasi->lantai ?? '-' }}</td>
                                <td class="text-nowrap">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                        data-id="{{ $i->id }}" class="btn btn-sm btn-warning edit">Edit</a>
                                    <a onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        href="{{ route('hrga9.0.delete', ['id' => $i->id]) }}"
                                        class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <style>
        .modal-xlplus {
            max-width: 90%;
        }
    </style>

    <!-- FORM -->
    <form action="{{ route('hrga9.0.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Header Baris -->
                        <div class="row fw-bold mb-2">
                            <div class="col-lg-3">Nama Item Kalibrasi</div>
                            <div class="col-lg-3">Merek</div>
                            <div class="col-lg-3">Nomer Seri</div>
                            <div class="col-lg-3">Lokasi</div>

                        </div>

                        <!-- Dynamic Rows -->

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="nama_item"
                                    placeholder="Nama Alat Kalibrasi" required>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="merk" required>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="nomor_seri" required>
                            </div>
                            <div class="col-lg-3">
                                <select name="lokasi_id" class="select2" id="">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($lokasi as $lokasi)
                                        <option value="{{ $lokasi->id }}">{{ $lokasi->lokasi }} -
                                            {{ $lokasi->lantai }}</option>
                                    @endforeach
                                </select>
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
    <form action="{{ route('hrga8.0.update') }}" method="post">
        @csrf
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlplus">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div id="load_data"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {{-- <form action="" method="get">
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">View</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <select name="tahun" id="" class=" form-control">
                            @foreach ($tahuns as $t)
                                <option value="{{ $t }}" @selected($tahun == $t)>{{ $t }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.jenis', function() {
                    var jenis = $(this).val();
                    if (jenis == 'ruangan') {
                        $('.ruangan').show();
                    } else {
                        $('.ruangan').hide();
                    }

                })
                $(document).on('click', '.edit', function() {
                    var id = $(this).data('id');

                    $.ajax({
                        url: "{{ route('hrga8.0.get_data') }}",
                        type: "GET",
                        data: {
                            id
                        },
                        success: function(data) {
                            $('#load_data').html(data);

                            // Penting! Inisialisasi Alpine untuk data baru
                            Alpine.initTree(document.getElementById('load_data'));

                            // Inisialisasi Select2 (kalau dipakai)
                            $('.select2_baru').select2({
                                dropdownParent: $('#edit'),
                                width: '100%'
                            });

                            $('#edit').modal('show');
                        }
                    });
                });


            });
        </script>
        <script>
            function itemForm() {
                return {
                    items: [],
                    addItem() {
                        this.items.push({
                            rincian: ''
                        });
                    }
                };
            }
        </script>
    @endsection
</x-app-layout>
