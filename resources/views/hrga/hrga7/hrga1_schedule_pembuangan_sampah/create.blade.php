<x-app-layout title="{{ $title }}">
    <p>{{ $title }}</p>
    <form action="{{ route('hrga7.1.store') }}" method="POST">
        @csrf
        @if ($kategori == 'terjadwal')
            <div class="row">
                <div class="col-lg-3">
                    <label for="">Bulan</label>
                    <select name="bulan" id="" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach ($bulan as $b)
                            <option value="{{ $b->id_bulan }}" {{ date('m') == $b->id_bulan ? 'selected' : '' }}>
                                {{ $b->nm_bulan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="">Jenis Limbah</label>
                    <select name="jenis_sampah" id="" class="form-control">
                        <option value="">-- Pilih Jenis Limbah --</option>
                        <option value="Organik">Organik</option>
                        <option value="Non Organik">Non Organik</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label for="">Jadwal Checklist</label>
                    <input type="time" name="jam_cek" class="form-control">
                    <input type="hidden" name="kategori" value="{{ $kategori }}" class="form-control">
                </div>


                <div class="col-lg-12" style="margin-top: 25px">
                    <button class="btn btn-sm btn-primary float-end"><i class="fas fa-save"></i> Save</button>
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-lg-3">

                    <label for="">Jenis Limbah</label>
                    <select name="jenis_sampah" id="" class="form-control">
                        <option value="">-- Pilih Jenis Limbah --</option>
                        <option value="Organik">Organik</option>
                        <option value="Non Organik">Non Organik</option>
                    </select>
                    <input type="hidden" name="kategori" value="{{ $kategori }}" class="form-control">

                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="col-lg-3 mb-2">
                    <label for="">Tanggal</label>
                    <input type="date" name="tgl[]" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-3 mb-2">
                    <label for="">Jadwal Checklist</label>
                    <input type="time" name="jam_cek[]" class="form-control">

                </div>
                <div class="col-lg-2 mb-2">
                    <label for="">Berat</label>
                    <input type="text" name="berat[]" class="form-control">

                </div>
                <div class="col-lg-3 mb-2">
                    <label for="">Keterangan</label>
                    <input type="text" name="katerangan[]" class="form-control">
                </div>
                <div class="col-lg-1 mb-2">
                    <label for="">Aksi</label>

                </div>
                <div class="col-lg-12" id="container-baris">
                    <!-- baris data baru akan muncul di sini -->
                </div>
                <div class="col-lg-12 mt-4">
                    <button type="button" class="btn btn-block btn-warning btn-sm tambah-baris">Tambah Baris</button>
                </div>


                <div class="col-lg-12" style="margin-top: 25px">
                    <button class="btn btn-sm btn-primary float-end"><i class="fas fa-save"></i> Save</button>
                </div>

            </div>
        @endif

    </form>

    @section('scripts')
        <script>
            var count = 0;
            $('.tambah-baris').on('click', function() {
                count += 1;
                var html = `<div class="row row-` + count + ` mb-2">
                    <div class="col-lg-3">
                        <input type="date" name="tgl[]" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-lg-3">
                        <input type="time" name="jam_cek[]" class="form-control">
                    </div>
                    <div class="col-lg-2">
                        <input type="text" name="berat[]" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <input type="text" name="katerangan[]" class="form-control" >
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-sm btn-danger btn-block hapus-baris" data-id="` + count + `"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`;
                $('#container-baris').append(html);
            });

            $(document).on('click', '.hapus-baris', function() {
                var id = $(this).data('id');
                $('.row-' + id).remove();
            });
        </script>
    @endsection
</x-app-layout>
