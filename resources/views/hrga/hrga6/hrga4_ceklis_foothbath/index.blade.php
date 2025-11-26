<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-end">
                <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm"><i
                        class="fas fa-plus"></i> Add</a>
            </div>
        </div>
        <div class="col-lg-12">
            <section class="row">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center" width="5">#</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->lokasi }}</td>
                                <td>{{ $d->item }}</td>
                                <td>{{ $d->bulan }}</td>
                                <td>{{ $d->tahun }}</td>
                                @php
                                    $param = [
                                        'bulan' => $d->bulan,
                                        'tahun' => $d->tahun,
                                        'lokasi_id' => $d->lokasi_id,
                                        'item' => $d->item,
                                        'id' => $d->id,
                                    ];
                                @endphp
                                <td>
                                    <button class="btn btn-warning btn-sm btnEdit" data-id="{{ $d->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <a target="_blank" class="btn btn-sm btn-primary"
                                        href="{{ route('hrga6.4.print', $param) }}"><i class="fas fa-print"></i>
                                        Print</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <form action="{{ route('hrga6.4.store') }}" method="post">
                @csrf
                <x-modal btnSave="Y" idModal="tambah" size="modal-lg" title="Tambah Data">

                    <table class="table table-bordered" id="table-sanitasi">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Item</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="bulan[]" class="form-control select2">
                                        <option value="">-- Pilih Bulan --</option>
                                        @foreach ($bulan as $b)
                                            <option value="{{ $b->id_bulan }}">{{ $b->nm_bulan }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="item[]" class="form-control"
                                        value="Footh Bath Low Risk" placeholder="Item">
                                </td>
                                <td>
                                    <select name="lokasi_id[]" class="form-control select2">
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach ($lokasi as $l)
                                            <option value="{{ $l->id }}">{{ ucwords($l->lokasi) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm remove">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary btn-sm" id="addRow">
                        + Tambah Baris
                    </button>

                </x-modal>
            </form>

            <div class="modal fade" id="editModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('hrga6.4.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <!-- Spinner -->
                                <div id="spinnerEdit" class="text-center py-5" style="display:none;">
                                    <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;"></div>
                                    <p>Loading...</p>
                                </div>

                                <!-- Form edit -->
                                <div id="formEdit" style="display:none;">
                                    <div class="mb-3">
                                        <label>Bulan</label>
                                        <select name="bulan" id="edit_bulan" class="form-control">
                                            <option value="">-- Pilih Bulan --</option>
                                            @foreach ($bulan as $b)
                                                <option value="{{ $b->id_bulan }}">{{ $b->nm_bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Item</label>
                                        <input type="text" name="item" id="edit_item" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Lokasi</label>
                                        <select name="lokasi_id" id="edit_lokasi_id" class="form-control">
                                            <option value="">-- Pilih Lokasi --</option>
                                            @foreach ($lokasi as $l)
                                                <option value="{{ $l->id }}">{{ ucwords($l->lokasi) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>Tahun</label>
                                        <input type="number" name="tahun" id="edit_tahun" class="form-control">
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {

                // 🔹 Inisialisasi Select2 pertama kali
                $('.select2').select2({
                    dropdownParent: $('#tambah'),
                    width: '100%'
                });

                // 🔹 Tambah baris baru
                $('#addRow').click(function() {
                    let newRow = `
        <tr>
            <td>
                <select name="bulan[]" class="form-control select2">
                    <option value="">-- Pilih Bulan --</option>
                    @foreach ($bulan as $b)
                        <option value="{{ $b->id_bulan }}">{{ $b->nm_bulan }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" name="item[]" value="Footh Bath Low Risk" class="form-control" placeholder="Item">
            </td>
            <td>
                <select name="lokasi_id[]" class="form-control select2">
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach ($lokasi as $l)
                        <option value="{{ $l->id }}">{{ ucwords($l->lokasi) }}</option>
                    @endforeach
                </select>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>`;

                    // Tambahkan baris baru ke tabel
                    $('#table-sanitasi tbody').append(newRow);

                    // Re-inisialisasi select2 untuk baris baru
                    $('#table-sanitasi tbody tr:last .select2').select2({
                        dropdownParent: $('#tambah'),
                        width: '100%'
                    });
                });

                // 🔹 Hapus baris
                $(document).on('click', '.remove', function() {
                    $(this).closest('tr').remove();
                });
                

                // === EDIT BUTTON CLICK ===
                $(document).on('click', '.btnEdit', function() {
                    let id = $(this).data('id');

                    $('#editModal').modal('show');
                    $('#spinnerEdit').show();
                    $('#formEdit').hide();

                    // Load data
                    $.get("{{ url('hrga/6/3-ceklist-foothbath/get') }}/" + id, function(res) {

                        $('#edit_id').val(res.id);
                        $('#edit_bulan').val(res.bulan);
                        $('#edit_item').val(res.item);
                        $('#edit_lokasi_id').val(res.lokasi_id);
                        $('#edit_tahun').val(res.tahun);

                        $('#spinnerEdit').hide();
                        $('#formEdit').show();
                    });
                });

            });
        </script>
    @endsection
</x-app-layout>
