<x-app-layout :title="$title">
    <div class="container mt-4" x-data="alpineFunc">
        <form action="" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">No Reg Rumah Walet</label>
                                <select name="id_penerimaan" class="form-control select2noreg selectNoreg"
                                    id="">
                                    <option value="">- Pilih No Reg -</option>
                                    @foreach ($penerimaanSbwKotors as $d)
                                        <option data-alamat="{{ $d->alamat }}" data-noreg="{{ $d->nama }}"
                                            value="{{ $d->id }}">{{ $d->no_reg }} |
                                            {{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Nama/ No. Registrasi Rumah Walet</label>
                                <input readonly type="text" name="nama_registrasi_rumah_walet" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Alamat Rumah Walet</label>
                                <input readonly type="text" name="alamat_rumah_walet" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">IKPH</label>
                                <select name="id_ikph" class="form-control select2noreg selectIkph" id="">
                                    <option value="">- Pilih Ikph -</option>
                                    @foreach ($ikph as $d)
                                        <option data-alamat="{{ $d->alamat_ikph }}"
                                            data-noreg="{{ $d->no_registrasi_ikph }}" value="{{ $d->id }}">
                                            {{ $d->no_registrasi_ikph }}
                                            {{ $d->nama_ikph }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tujuan IKH</label>
                                <input type="text" name="tujuan_ikh" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>No. Registrasi IKPH</label>
                                <input readonly type="text" name="no_registrasi_ikph" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Alamat IKPH</label>
                                <input readonly type="text" name="alamat_ikph" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal, Bulan, Tahun</label>
                                <input type="date" name="tgl_bln_thn" class="form-control" required>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">No</th>
                                    <th class="text-center" rowspan="2">Tanggal Panen</th>
                                    <th class="text-center" rowspan="2">Berat Panen (gr)</th>
                                    <th class="text-center" colspan="2">Pengiriman ke IKPH</th>
                                    <th class="text-center" rowspan="2">Keterangan</th>
                                    <th class="text-center" rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Tanggal Kirim</th>
                                    <th class="text-center">Berat Kirim (IKPH)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(row, index) in rows">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <input type="date" name="tgl_panen[]" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="berat_panen[]" class="form-control text-end"
                                                required>
                                        </td>
                                        <td>
                                            <input type="date" name="tgl_kirim[]" class="form-control" required>
                                        </td>
                                        <td>
                                            <input type="number" name="berat_kirim[]" class="form-control text-end"
                                                required>
                                        </td>
                                        <td>
                                            <input type="text" name="keterangan[]" class="form-control">
                                        </td>
                                        </td>
                                        <td>
                                            <span @click="rows.splice(index, 1)" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i></span>
                                        </td>
                                    </tr>
                                </template>
                                <tr>
                                    <td colspan="8">
                                        <button type="button" @click="rows.push({})"
                                            class="btn-block btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah
                                            Baris Data</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                // Delay the initialization slightly to ensure DOM is fully ready
                setTimeout(function() {
                    $('.select2noreg').select2();
                }, 100);
            });
        </script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('alpineFunc', () => ({
                    rows: [],
                    tgl: "{{ date('Y-m-d') }}"
                }))
            })
        </script>
        <script>
            $(document).ready(function() {


                $(".selectNoreg").change(function(e) {
                    e.preventDefault();

                    var alamat = $(this).find(':selected').data('alamat');
                    $("input[name=alamat_rumah_walet]").val(alamat);

                    var noreg = $(this).find(':selected').data('noreg');
                    $("input[name=nama_registrasi_rumah_walet]").val(noreg);
                });

                $(".selectIkph").change(function(e) {
                    e.preventDefault();

                    var alamat = $(this).find(':selected').data('alamat');
                    $("input[name=alamat_ikph]").val(alamat);

                    var noreg = $(this).find(':selected').data('noreg');
                    $("input[name=no_registrasi_ikph]").val(noreg);
                });
            });
        </script>
    @endsection
</x-app-layout>
