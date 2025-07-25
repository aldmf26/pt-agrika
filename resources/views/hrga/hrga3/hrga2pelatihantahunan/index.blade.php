<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            {{-- <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fas fa-plus"></i> Data
            </button> --}}
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#print">
                <i class="fas fa-print"></i> print
            </button>
        </div>
        <div class="card-body">
            <form action="{{ route('hrga3.2.store') }}" method="post">
                @csrf
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Materi pelatihan</th>
                            <th>I/E <br> *</th>
                            <th>Narasumber</th>
                            <th>Sasaran peserta</th>
                            <th>Tanggal rencana</th>
                            <th>Tanggal realisasi</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program as $p)
                            <tr x-data="{
                                edit: false
                            }">
                                <td>
                                    {{ $loop->iteration }}
                                    <input type="hidden" name="id[]" value="{{ $p->id }}">
                                </td>
                                <td>
                                    @if ($p->isi_usulan == 'Y')
                                        {{ ucfirst(strtolower($p->materi_pelatihan)) }}
                                    @else
                                        <a href="#" class="usulan" data-bs-toggle="modal" data-bs-target="#tambah"
                                            usulan="{{ $p->materi_pelatihan }}" tgl="{{ $p->tgl_realisasi }}"
                                            Getid="{{ $p->id }}">
                                            {{ ucfirst(strtolower($p->materi_pelatihan)) }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <span x-show="!edit"> {{ $p->sumber == 'internal' ? 'I' : 'E' }}</span>

                                    <select name="sumber[]" id="" class="form-control" x-show="edit">
                                        <option value="internal" {{ $p->sumber == 'internal' ? 'selected' : '' }}>I
                                        </option>
                                        <option value="eksternal" {{ $p->sumber == 'eksternal' ? 'selected' : '' }}>
                                            E
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <span x-show="!edit"> {{ ucfirst(strtolower($p->narasumber)) }}</span>
                                    <input type="text" x-show="edit" value="{{ $p->narasumber }}"
                                        class="form-control" name="narasumber[]">
                                </td>
                                <td>
                                    <span x-show="!edit"> {{ ucfirst(strtolower($p->sasaran_peserta)) }}</span>
                                    <input type="text" x-show="edit" value="{{ $p->sasaran_peserta }}"
                                        class="form-control" name="sasaran_peserta[]">
                                </td>
                                <td>

                                    <span x-show="!edit">{{ $p->tgl_rencana }}</span>
                                    <input type="date" x-show="edit" value="{{ $p->tgl_rencana }}"
                                        class="form-control" name="tgl_rencana[]">
                                </td>
                                <td>
                                    <span x-show="!edit">{{ $p->tgl_realisasi }}</span>
                                    <input type="date" x-show="edit" value="{{ $p->tgl_realisasi }}"
                                        class="form-control" name="tgl_realisasi[]">
                                </td>
                                <td class="text-center">
                                    <a x-show="!edit" @click="edit = !edit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-edit"></i> edit</a>
                                    <a x-show="edit" @click="edit = !edit" class="btn btn-sm btn-primary">
                                        cancel</a>
                                    <button type="submit" x-show="edit" class="btn btn-sm btn-success"><i
                                            class="fa fa-check"></i>
                                        save</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </form>
        </div>
    </div>
    {{-- <form action="{{ route('hrga3.2.store') }}" method="POST">
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
                                <label for="">Materi Pelatihan</label>
                                <input type="text" name="materi_pelatihan" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">I/E</label>
                                <select name="sumber" class="form-control" id="">
                                    <option value="internal">Internal</option>
                                    <option value="eksternal">Eksternal</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Narasumber</label>
                                <input type="text" name="narasumber" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Sasaran Peserta</label>
                                <input type="text" name="sasaran_peserta" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Tanggal Rencana</label>
                                <input type="date" name="tgl_rencana" class="form-control" required>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label for="">Tanggal Realisasi</label>
                                <input type="date" name="tgl_realisasi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}
    <form action="{{ route('hrga3.3.store') }}" method="post">
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
                                <label for="">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="Getid" id="Getid">

                            </div>
                            <div class="col-lg-3">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tgl" readonly>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Pengusul</label>
                                <input type="text" class="form-control" name="pengusul">
                            </div>
                            <div class="col-lg-4">
                                <label for="">Usulan jenis pelatihan</label>
                                <input type="text" class="form-control" name="usulan_jenis_pelatihan"
                                    id="usulan" readonly>
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
    <form action="{{ route('hrga3.2.print') }}" method="get" target="_blank">
        <div class="modal fade" id="print" tabindex="-1" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control">
                                    @foreach ($tahuns as $t)
                                        <option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
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

                $(document).on('click', '.usulan', function() {
                    var usulan = $(this).attr('usulan');
                    var tgl = $(this).attr('tgl');
                    var Getid = $(this).attr('Getid');
                    $('#Getid').val(Getid);
                    $('#usulan').val(usulan);
                    $('#tgl').val(tgl);
                });
            });
        </script>
    @endsection
</x-app-layout>
