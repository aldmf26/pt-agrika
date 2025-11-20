<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <h5>Divisi : {{ $nm_divisi->divisi ?? 'All' }}</h5>
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
            <button data-bs-toggle="modal" data-bs-target="#print" class="btn btn-primary float-end me-2"><i
                    class="fas fa-print"></i> print</button>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Divisi</th>
                            <th colspan="12" class="text-center">Tahun {{ $tahun }}</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                <th>{{ substr($b->nm_bulan, 0, 3) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($j->data_pegawai->nama ?? '-')) }} </td>
                                <td>{{ $j->data_pegawai->divisi->divisi ?? '-' }}</td>
                                @foreach ($bulan as $b)
                                    <td class="{{ $b->bulan == $j->bulan ? 'bg-primary' : '' }}"></td>
                                @endforeach
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <form action="{{ route('hrga4.1.store') }}" method="post">
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
                            <div class="col-lg-4">
                                <label for="">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    <option value="All">Semua Karyawan</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-4">
                                <label for="">bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <option value="">Pilih Bulan</option>
                                    @foreach ($bulan as $b)
                                        <option value="{{ $b->id_bulan }}">{{ $b->nm_bulan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <option value="">Pilih Tahun</option>
                                    <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                    <option value="{{ date('Y', strtotime('+1Year')) }}">
                                        {{ date('Y', strtotime('+1Year')) }}</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div id="load_karyawan"></div>

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

    <form action="{{ route('hrga4.1.print') }}" method="get" target="_blank">
        <div class="modal fade" id="print" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Print Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    @foreach ($tahuns as $t)
                                        <option value="{{ $t->tahun }}" @selected($t->tahun == $tahun)>
                                            {{ $t->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Divisi</label>
                                <select name="divisi" id="" class="form-control">
                                    <option value="">Pilih Divisi</option>
                                    <option value="All" @selected($id_divisi == 'All')>All</option>
                                    @foreach ($divisi as $t)
                                        <option value="{{ $t->id }}" @selected($id_divisi == $t->id)>
                                            {{ $t->divisi }}</option>
                                    @endforeach
                                </select>
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
                        <h5 class="modal-title" id="tambahModalLabel">View Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    @foreach ($tahuns as $t)
                                        <option value="{{ $t->tahun }}" @selected($t->tahun == $tahun)>
                                            {{ $t->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Divisi</label>
                                <select name="divisi" id="" class="form-control">
                                    <option value="">Pilih Divisi</option>
                                    <option value="All" @selected($id_divisi == 'All')>All</option>
                                    @foreach ($divisi as $t)
                                        <option value="{{ $t->id }}" @selected($id_divisi == $t->id)>
                                            {{ $t->divisi }}</option>
                                    @endforeach
                                </select>
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

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#divisi').change(function() {
                    var divisi = $(this).val();



                    // Panggil AJAX untuk mengambil data pegawai berdasarkan divisi
                    $.ajax({
                        url: "{{ route('hrga4.1.getPegawai') }}", // Endpoint server
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
