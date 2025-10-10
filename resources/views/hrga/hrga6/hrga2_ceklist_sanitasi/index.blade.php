<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <div class="float-end">
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary"><i
                        class="fas fa-plus"></i>Add</button>
            </div>
        </div>
        <div class="col-lg-12 mt-2">
            <section class="row">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th width="5">#</th>
                            <th>Lokasi</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->lokasi }}</td>
                                <td>{{ $d->bulan }}</td>
                                <td>{{ $d->tahun }}</td>

                                @php
                                    $param = [
                                        'id_lokasi' => $d->id_lokasi,
                                        'bulan' => $d->bulan,
                                        'tahun' => $d->tahun,
                                    ];
                                @endphp
                                <td>
                                    <a target="_blank" class="btn btn-sm btn-primary"
                                        href="{{ route('hrga6.2.print', $param) }}"><i class="fas fa-print"></i>
                                        Print</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <form action="{{ route('hrga6.2.store') }}" method="post">
        @csrf
        <x-modal idModal="tambah" title="Ceklist Sanitasi" size="modal-lg" btnSave="Y">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Bulan</label>
                    <select name="bulan" class="form-control select2">
                        <option value="">--Pilih Bulan--</option>
                        @foreach ($bulan as $b)
                            <option value="{{ $b->bulan }}">{{ $b->nm_bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Lokasi</label>
                    <select name="id_lokasi" class="form-control select2">
                        <option value="">--Pilih Lokasi--</option>
                        @foreach ($lokasi as $l)
                            <option value="{{ $l->id }}">{{ $l->lokasi }} ({{ $l->lantai }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-12 mt-3">
                    <h6>Daftar Item Sanitasi</h6>
                    <table class="table table-bordered" id="table-sanitasi">
                        <thead>
                            <tr>
                                <th>Nama Item Sanitasi</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="items[]" class="form-control"
                                        placeholder="Nama Item Sanitasi"></td>
                                <td><button type="button" class="btn btn-danger btn-sm remove"><i
                                            class="fas fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addRow" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                        Tambah Baris</button>
                </div>
            </div>
        </x-modal>
    </form>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // inisialisasi select2
                $('.select2').select2({
                    dropdownParent: $('#tambah'),
                    width: '100%'
                });

                // tambah baris baru
                $('#addRow').click(function() {
                    let row = `
                <tr>
                    <td><input type="text" name="items[]" class="form-control" placeholder="Nama Item Sanitasi"></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove"><i class="fas fa-trash"></i></button></td>
                </tr>`;
                    $('#table-sanitasi tbody').append(row);
                });

                // hapus baris
                $(document).on('click', '.remove', function() {
                    $(this).closest('tr').remove();
                });
            });
        </script>
    @endsection
</x-app-layout>
