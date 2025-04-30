<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            {{-- <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button> --}}
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#print"><i
                    class="fas fa-print"></i> print</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Calon Peserta yang Diusulkan</th>
                        <th>NIP</th>
                        <th>Pengusul</th>
                        <th>Divisi</th>
                        <th>
                            Usulan Jenis Pelatihan <br>
                            [yang sesuai dengan peningkatan kompetensi]
                        </th>
                        <th>Tanggal</th>
                        <th>Usulan Waktu <br> Pelaksanaan</th>
                        <th>Alasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($u->data_pegawai->nama)) }}</td>
                            <td>{{ $u->data_pegawai->karyawan_id_dari_api }}</td>
                            <td>{{ ucfirst(strtolower($u->pengusul)) }}</td>
                            <td>{{ $u->divisi->divisi }}</td>
                            <td>{{ ucfirst(strtolower($u->usulan_jenis_pelatihan)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($u->tanggal)) }}</td>
                            <td>{{ $u->usulan_waktu }}</td>
                            <td>{{ ucfirst(strtolower($u->alasan)) }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <form action="{{ route('hrga3.3.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-3">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Pengusul</label>
                                <input type="text" class="form-control" name="pengusul">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Usulan jenis pelatihan</label>
                                <input type="text" class="form-control" name="usulan_jenis_pelatihan">
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Usulan waktu</label>
                                <input type="time" class="form-control" name="usulan_waktu">
                            </div>
                            <div class="col-lg-6 m-2">
                                <label for="">Alasan</label>
                                <input type="text" class="form-control" name="alasan">
                            </div>

                            <div class="col-lg-12">
                                <hr>
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
    <form action="{{ route('hrga3.3.print') }}" method="get">
        <div class="modal fade" id="print" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Print data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-primary">save</button>
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
