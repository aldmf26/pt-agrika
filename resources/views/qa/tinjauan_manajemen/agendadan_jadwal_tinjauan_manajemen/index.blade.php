<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end gap-2">
                        <div></div>
                        <div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-nowrap">Hari / Tanggal</th>
                                <th class="text-nowrap">Waktu</th>
                                <th class="text-nowrap">Agenda</th>
                                <th class="text-nowrap">PIC</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda2 as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ tanggal($a->tanggal) }}</td>
                                    <td class="text-nowrap">
                                        {{ date('H:i', strtotime($a->dari_jam)) }} -
                                        {{ date('H:i', strtotime($a->sampai_jam)) }}
                                    </td>
                                    <td>
                                        @foreach (explode('||', $a->agendas) as $i => $agenda)
                                            {{ $i + 1 }}. {{ $agenda }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $a->pics }}</td>
                                    <td>
                                        <a href="{{ route('qa.agendadan_jadwal_tinjauan_manajemen.print', ['tanggal' => $a->tanggal]) }}"
                                            target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <button class="btn btn-sm btn-primary btn-edit"
                                            data-tanggal="{{ $a->tanggal }}" data-dari="{{ $a->dari_jam }}"
                                            data-sampai="{{ $a->sampai_jam }}" data-agenda="{{ $a->agendas }}"
                                            data-pic="{{ $a->pics }}" data-pic-ids="{{ $a->pics_ids }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="{{ route('qa.agendadan_jadwal_tinjauan_manajemen.destroy', ['tanggal' => $a->tanggal]) }}"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM TAMBAH --}}
    <form action="{{ route('qa.agendadan_jadwal_tinjauan_manajemen.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-lg" id="tambah">
            <div class="row">

                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Waktu Dari</label>
                    <input type="time" class="form-control" name="waktu_dari" required>
                </div>
                <div class="col-lg-3">
                    <label for="">Waktu Sampai</label>
                    <input type="time" class="form-control" name="waktu_sampai" required>
                </div>
                <div class="col-lg-12 mt-2">
                    <label for="">PIC</label>
                    <div class="form-group">
                        <select class="choices form-select" name="pic[]" multiple="multiple">
                            @foreach ($pegawai as $p)
                                <option value="{{ $p->karyawan_id_dari_api }}">{{ ucfirst(strtolower($p->nama)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-lg-11"><label>Agenda</label></div>
                    {{-- <div class="col-lg-4"><label>PIC</label></div> --}}
                </div>
                <div class="row">
                    <div class="col-lg-11">
                        <textarea name="agenda[]" class="form-control" id="" cols="5" rows="2"></textarea>
                    </div>
                    {{-- <div class="col-lg-4">
                        <select name="pic[]" class="select2" required>
                            <option value="">Pilih PIC</option>
                            @foreach ($pegawai as $p)
                                <option value="{{ $p->id }}">{{ ucfirst(strtolower($p->nama)) }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div id="tambah-baris"></div>

                </div>



                <div class="col-lg-12">
                    <button type="button" class="btn btn-primary mt-2 btn-block tambah-baris"> <i
                            class="fas fa-plus"></i> Tambah
                        Baris
                    </button>
                </div>
            </div>
        </x-modal_plus>
    </form>


    {{-- MODAL EDIT --}}
    <form action="{{ route('qa.agendadan_jadwal_tinjauan_manajemen.update') }}" method="POST">
        <x-modal_plus size="modal-lg" id="editModal">
            @csrf
            <input type="hidden" name="tanggal_lama" id="edit_tanggal_lama">

            <div class="row">

                <div class="col-lg-3">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="edit_tanggal" required>
                </div>

                <div class="col-lg-3">
                    <label>Waktu Dari</label>
                    <input type="time" class="form-control" name="waktu_dari" id="edit_dari" required>
                </div>

                <div class="col-lg-3">
                    <label>Waktu Sampai</label>
                    <input type="time" class="form-control" name="waktu_sampai" id="edit_sampai" required>
                </div>

                <div class="col-lg-12 mt-2">
                    <label>PIC</label>
                    <select id="edit_pic" name="pic[]" class="form-control select2" multiple>
                        @foreach ($pegawai as $p)
                            <option value="{{ $p->karyawan_id_dari_api }}">{{ ucfirst(strtolower($p->nama)) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div id="edit_agenda_wrapper"></div>

                <div class="col-lg-12 mt-3">
                    <button type="button" class="btn btn-primary btn-block" id="edit_tambah_baris">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                </div>

            </div>
        </x-modal_plus>
    </form>




    {{-- CSS fix untuk select2 agar selalu muncul di atas modal --}}


    @section('scripts')
        <script>
            $(document).ready(function() {

                count = 1;
                $('.tambah-baris').click(function(e) {
                    count++;
                    e.preventDefault();
                    $.ajax({
                        type: "GET",
                        url: "{{ route('qa.agendadan_jadwal_tinjauan_manajemen.tambah_baris') }}",
                        data: {
                            count: count
                        },

                        success: function(response) {
                            $('#tambah-baris').append(response);
                            $('.select-baris').select2({
                                dropdownParent: $('#tambah'), // Ganti dengan ID modal kamu
                                width: '100%'
                            });
                        }
                    });

                });
                $(document).on('click', '.hapus-baris', function() {
                    var baris = $(this).attr('baris');

                    $('.' + baris).remove();
                });
            });
        </script>

        <script>
            function barisAgenda() {
                return `
        <div class="row mb-2 baris-agenda">
            <div class="col-lg-11">
                <textarea name="agenda[]" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-danger hapus-baris">x</button>
            </div>
        </div>
    `;
            }

            // tombol tambah baris di modal EDIT
            $(document).on('click', '#edit_tambah_baris', function() {
                $('#edit_agenda_wrapper').append(barisAgenda());
            });

            $(document).on('click', '.hapus-baris', function() {
                $(this).closest('.baris-agenda').remove();
            });


            $(document).on('click', '.btn-edit', function() {
                let tanggal = $(this).data('tanggal');
                let dari = $(this).data('dari');
                let sampai = $(this).data('sampai');
                let agendas = $(this).data('agenda').split('||');

                // PAKAI pics_ids, BUKAN pics !!!
                let picIds = $(this).data('pic-ids') ? $(this).data('pic-ids').toString() : "";
                let picArr = picIds.split(',').filter(x => x);

                $('#edit_pic').val(picArr).trigger('change');

                $('#edit_tanggal_lama').val(tanggal);
                $('#edit_tanggal').val(tanggal);
                $('#edit_dari').val(dari);
                $('#edit_sampai').val(sampai);

                // tampilkan agenda
                $('#edit_agenda_wrapper').html('');
                agendas.forEach((agenda, i) => {
                    $('#edit_agenda_wrapper').append(`
            <div class="row mb-2">
                <div class="col-lg-11">
                    <textarea name="agenda[]" class="form-control">${agenda}</textarea>
                </div>
                <div class="col-lg-1">
                    <button type="button" class="btn btn-danger hapus-baris">x</button>
                </div>
            </div>
        `);
                });

                // INIT SELECT2 UNTUK EDIT MODAL
                $('#edit_pic').select2({
                    dropdownParent: $('#editModal'),
                    width: '100%'
                });

                $('#editModal').modal('show');
            });
        </script>
    @endsection
</x-app-layout>
