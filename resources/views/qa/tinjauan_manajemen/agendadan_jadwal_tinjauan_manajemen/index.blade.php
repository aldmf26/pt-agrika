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
                                <th class="text-nowrap" width="60%">Agenda</th>
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
    @endsection
</x-app-layout>
