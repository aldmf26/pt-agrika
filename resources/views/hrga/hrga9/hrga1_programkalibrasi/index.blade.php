<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> View</button>
            <a href="{{ route('hrga9.1.print', ['tahun' => $tahun]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> Print</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap">
                    <thead>
                        <tr style="text-transform: capitalize">
                            <th rowspan="2">#</th>
                            <th rowspan="2" class="text-nowrap">Nama alat ukur</th>
                            <th rowspan="2" class="text-nowrap">Merek</th>
                            <th rowspan="2" class="text-nowrap">Type / Nomor seri</th>
                            <th rowspan="2" class="text-nowrap">Lokasi</th>
                            <th rowspan="2" class="text-nowrap">Frekuensi kalibrasi</th>
                            <th rowspan="2" class="text-nowrap">Rentang min-Maks</th>
                            <th rowspan="2" class="text-nowrap">Resolusi</th>
                            <th colspan="12" class="text-center">Tahun {{ $tahun }}</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                <th>{{ $b->nm_bulan }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($p->item_kalibrasi->name)) }}</td>
                                <td>{{ $p->item_kalibrasi->merk }}</td>
                                <td>{{ $p->item_kalibrasi->nomor_seri }}</td>
                                <td>{{ $p->item_kalibrasi->lokasi->lokasi ?? '-' }}</td>
                                <td>{{ $p->frekuensi }}</td>
                                <td>{{ $p->rentang }}</td>
                                <td>{{ $p->resolusi }}</td>
                                @foreach ($bulan as $b)
                                    <td class="{{ $p->bulan == $b->bulan ? 'bg-secondary' : '' }}"></td>
                                @endforeach
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit"
                                        data-id="{{ $p->id }}" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <form action="{{ route('hrga9.1.update') }}" method="POST">
        @csrf


        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kalibrasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" class="edit-id">

                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <label>Nama alat ukur</label>
                                <select name="item_kalibrasi_id" class="select3 form-control edit-item">
                                    @foreach ($item as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}
                                            ({{ $i->nomor_seri }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3 col-6">
                                <label>Merek</label>
                                <input type="text" class="form-control edit-merek" disabled>
                            </div>

                            <div class="col-lg-3 col-6">
                                <label>Type/Nomor Seri</label>
                                <input type="text" class="form-control edit-nomor" disabled>
                            </div>

                            <div class="col-lg-3 col-6">
                                <label>Lokasi</label>
                                <input type="text" class="form-control edit-lokasi" disabled>
                            </div>

                            <div class="col-lg-3 col-6 mt-2">
                                <label>Frekuensi</label>
                                <input type="text" name="frekuensi" class="form-control edit-frekuensi">
                            </div>

                            <div class="col-lg-3 col-6 mt-2">
                                <label>Rentang</label>
                                <input type="text" name="rentang" class="form-control edit-rentang">
                            </div>

                            <div class="col-lg-3 col-6 mt-2">
                                <label>Resolusi</label>
                                <input type="text" name="resolusi" class="form-control edit-resolusi">
                            </div>

                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="select3 form-control edit-bulan">
                                    @foreach ($bulan as $b)
                                        <option value="{{ $b->bulan }}">{{ $b->nm_bulan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="select3 form-control edit-tahun">
                                    <option value="{{ date('Y', strtotime('-1 year')) }}">
                                        {{ date('Y', strtotime('-1 year')) }}</option>
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    <option value="{{ date('Y', strtotime('+1 year')) }}">
                                        {{ date('Y', strtotime('+1 year')) }}</option>

                                </select>
                            </div>

                            <div class="col-lg-3 col-6 mt-2">
                                <label>Status</label>
                                <input type="text" name="status" class="form-control edit-status">
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
            </div>
        </div>
    </form>


    <form action="{{ route('hrga9.1.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Kalibrasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3 col-6 ">
                                <label for="">Nama alat ukur</label>
                                <select name="item_kalibrasi_id" id=""
                                    class="select2 form-control item_kalibrasi_id">
                                    <option value="">-Pilih alat ukur-</option>
                                    @foreach ($item as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}
                                            ({{ $i->nomor_seri }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-6">
                                <label for="">Merek</label>
                                <input type="text" class="form-control merek" disabled>
                            </div>
                            <div class="col-lg-3 col-6">
                                <label for="">Type/Nomer seri</label>
                                <input type="text" class="form-control nomor-ser" disabled>
                            </div>
                            <div class="col-lg-3 col-6">
                                <label for="">Lokasi</label>
                                <input type="text" class="form-control lokasi" disabled>
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Frekuensi kalibrasi</label>
                                <input type="text" class="form-control" name="frekuensi" value="Tahunan">
                            </div>
                            <div class="col-3 mt-2">
                                <label for="">Rentang Min-Maks</label>
                                <input type="text" class="form-control" name="rentang">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Resolusi</label>
                                <input type="text" class="form-control" name="resolusi">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="select2 form-control">
                                    @foreach ($bulan as $b)
                                        <option value="{{ $b->bulan }}">{{ $b->nm_bulan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="select2 form-control">
                                    <option value="{{ date('Y', strtotime('-1 year')) }}">
                                        {{ date('Y', strtotime('-1 year')) }}</option>
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    <option value="{{ date('Y', strtotime('+1 year')) }}">
                                        {{ date('Y', strtotime('+1 year')) }}</option>

                                </select>
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Status kalibrasi te</label>
                                <input type="text" class="form-control" name="status">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" method="get">
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">View</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
    </form>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.item_kalibrasi_id').on('change', function() {
                    var item_kalibrasi_id = $(this).val();

                    $.ajax({
                        url: "{{ url('hrga/hrga9/hrga9.1_Program_Kalibrasi/itemKalibrasi') }}/" +
                            item_kalibrasi_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            $('.merek').val(data.merk);
                            $('.nomor-ser').val(data.nomor_seri);
                            $('.lokasi').val(data.lokasi.lokasi);

                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Terjadi kesalahan saat mengambil data!');
                        }
                    });
                });

            });

            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('hrga9.1.getData', ['id' => ':id']) }}".replace(':id', id),
                    type: "GET",
                    success: function(data) {
                        $('.select3').select2({
                            dropdownParent: $('#editModal'), // Ganti dengan ID modal kamu
                            width: '100%'
                        });

                        // isi hidden id
                        $('.edit-id').val(data.id);

                        // select item
                        $('.edit-item').val(data.item_kalibrasi_id).trigger('change');

                        // atribut
                        $('.edit-merek').val(data.item_kalibrasi.merk);
                        $('.edit-nomor').val(data.item_kalibrasi.nomor_seri);
                        $('.edit-lokasi').val(
                            data.item_kalibrasi.lokasi ?
                            data.item_kalibrasi.lokasi.lokasi :
                            '-'
                        );

                        // lainnya
                        $('.edit-frekuensi').val(data.frekuensi);
                        $('.edit-rentang').val(data.rentang);
                        $('.edit-resolusi').val(data.resolusi);
                        $('.edit-bulan').val(data.bulan).trigger('change');
                        $('.edit-tahun').val(data.tahun).trigger('change');
                        $('.edit-status').val(data.status);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Terjadi kesalahan mengambil data!");
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
