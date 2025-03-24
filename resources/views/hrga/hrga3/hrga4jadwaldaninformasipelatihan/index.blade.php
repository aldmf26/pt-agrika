<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            {{-- <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tema Pelatihan</th>
                        <th>Hari/Tanggal</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Narasumber</th>
                        <th>Kisaran Materi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $j)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $j->tema_pelatihan }}</td>
                            <td>{{ $j->tanggal }}</td>
                            <td>{{ $j->waktu }}</td>
                            <td>{{ $j->tempat }}</td>
                            <td>{{ $j->narasumber }}</td>
                            <td>{{ $j->kisaran_materi }}</td>
                            <td>
                                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail"
                                    nota="{{ $j->nota_pelatihan }}"><i class="fas fa-info"></i></button> --}}
                                <a href="{{ route('hrga3.4.print', ['nota_pelatihan' => $j->nota_pelatihan]) }}"
                                    target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('hrga3.4.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="">Tema Pelatihan</label>
                                <input type="text" name="tema_pelatihan" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Waktu</label>
                                <input type="time" name="waktu" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Tempat</label>
                                <input type="text" name="tempat" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Narasumber</label>
                                <input type="text" name="narasumber" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Penyelenggara</label>
                                <select name="penyelenggara" id="" class="form-control">
                                    <option value="">-Pilih Penyelenggara-</option>
                                    <option value="internal">Internal</option>
                                    <option value="eksternal">Eksternal</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label for="">Kisaran Materi</label>
                                <input type="text" name="kisaran_materi" class="form-control" required>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="load_karyawan"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#divisi').change(function() {
                    var divisi = $(this).val();

                    // Panggil AJAX untuk mengambil data pegawai berdasarkan divisi
                    $.ajax({
                        url: "{{ route('hrga3.3.getPegawai') }}", // Endpoint server
                        type: "GET",
                        data: {
                            divisi: divisi
                        },
                        success: function(data) {

                            if ($.fn.DataTable.isDataTable('#table_scroll')) {
                                $('#table_scroll').DataTable().destroy();
                            }
                            $('#load_karyawan').html(data);
                            $("#table_scroll").DataTable({
                                scrollX: true,
                                scrollY: "400px",
                                scrollCollapse: true,
                                paging: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading data:", error);
                        },
                    });
                });

                $(document).on('click', '.checkall', function() {
                    var check = $(this).prop('checked');
                    $('.check_item').prop('checked', check);
                });
            });
        </script>
    @endsection
</x-app-layout>
