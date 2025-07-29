<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> view</button>
            <a href="{{ route('hrga9.2.print', ['tahun' => $tahun]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> print</a>
            <h2 class="h6 mb-0">Tahun:{{ $tahun }}</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-nowrap">Nama alat ukur</th>
                            <th class="text-nowrap">Merek</th>
                            <th class="text-nowrap">Type / Nomor seri</th>
                            <th class="text-nowrap">Lokasi</th>
                            <th class="text-nowrap">Frekuensi kalibrasi</th>
                            <th class="text-nowrap">Rentang min-maks</th>
                            <th class="text-nowrap">Resolusi</th>
                            <th class="text-nowrap">Tanggal aktual kalibrasi</th>
                            <th class="text-nowrap">Standard nilai koreksi</th>
                            <th class="text-nowrap">Aktual nilai koreksi</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Rencana kalibrasi selanjutnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($j->itemKalibrasi->name)) }}</td>
                                <td>{{ $j->itemKalibrasi->merk }}</td>
                                <td>{{ $j->itemKalibrasi->nomor_seri }}</td>
                                <td>{{ $j->itemKalibrasi->lokasi->lokasi ?? '-' }}</td>
                                <td>{{ $j->frekuensi }}</td>
                                <td>{{ $j->rentang }}</td>
                                <td>{{ $j->resolusi }}</td>
                                <td>{{ date('d-m-Y', strtotime($j->tanggal)) }}</td>
                                <td>{{ $j->standar_nilai }}</td>
                                <td>{{ $j->aktual_nilai }}</td>
                                <td>{{ $j->status }}</td>
                                <td>{{ date('d-m-Y', strtotime($j->tanggal_selanjutnya)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form action="{{ route('hrga9.2.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
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
                            <div class="col-lg-3  col-6 mt-2">
                                <label for="">Rentang Min-Maks</label>
                                <input type="text" class="form-control" name="rentang">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Resolusi</label>
                                <input type="text" class="form-control" name="resolusi">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Tanggal Aktual Kalibrasi</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Standard Nilai koreksi</label>
                                <input type="text" class="form-control" name="standart">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Aktual nilai koreksi</label>
                                <input type="text" class="form-control" name="aktual">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Status</label>
                                <input type="text" class="form-control" name="status">
                            </div>
                            <div class="col-lg-3 col-6 mt-2">
                                <label for="">Rencana Kalibrasi selanjutnya</label>
                                <input type="date" class="form-control" name="tgl_selanjutnya" required>
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
        </script>
    @endsection
</x-app-layout>
