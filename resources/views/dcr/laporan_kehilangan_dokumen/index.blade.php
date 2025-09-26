<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button>
            <a href="{{ route('dcr.6.print') }}" target="_blank" class="btn btn-primary float-end me-2"><i
                    class="fas fa-print"></i> print</a>
            {{-- <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>


                            <th class="text-center">Judul Dokumen</th>
                            <th class="text-center">No Dokumen</th>
                            <th class="text-center">Nama Pelapor</th>
                            <th class="text-center">Tgl Lapor</th>
                            <th class="text-center">Penyebab Hilang</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumen as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>


                                <td>{{ $d->judul }}</td>
                                <td>{{ $d->no_dokumen }}</td>
                                <td>{{ $d->nm_pelapor }}</td>
                                <td>{{ tanggal($d->tgl_lapor) }}</td>
                                <td>{{ $d->penyebab_hilang }}</td>
                                <td>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>
    </div>
    <style>
        .modal-lg-max {
            max-width: 90% !important;
        }
    </style>
    <form action="{{ route('dcr.6.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg-max">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Add Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            {{-- perubahan --}}
                            <div class="col-lg-3  ">
                                <label for="">Dokumen</label>
                                <select name="id_dokumen" id="" class="select2 dokumen"
                                    style="font-size: 10px">
                                    <option value="">Pilih Dokumen</option>
                                    @foreach ($daftar as $d)
                                        <option value="{{ $d->id }}">{{ $d->judul }}
                                            ({{ $d->no_dokumen }})
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-2 ">
                                <label for="">No Dokumen</label>
                                <input type="text" class="form-control no_dokumen" disabled name=""
                                    id="">
                            </div>
                            <div class="col-lg-2 ">
                                <label for="">Divisi</label>
                                <input type="text" class="form-control divisi" name="" disabled
                                    id="">
                            </div>
                            <div class="col-lg-2 ">
                                <label for="">Nama Pelapor</label>
                                <input type="text" class="form-control " name="nm_pelapor" id="">
                            </div>
                            <div class="col-lg-2 ">
                                <label for="">Tgl Lapor</label>
                                <input type="date" class="form-control " name="tgl_lapor" id="">
                            </div>
                            <div class="col-lg-4 mt-2">
                                <label for="">Penyebab Hilang</label>
                                <input type="text" class="form-control " name="penyebab_hilang" id="">
                            </div>
                            {{-- perubahan --}}




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
            $('.pengajuan').change(function() {
                var pengajuan = $(this).val();
                $('.alasan').show();

                if (pengajuan == 'perubahan') {
                    $('.perubahan').show();
                    $('.penambahan').hide();
                } else {
                    $('.perubahan').hide();
                    $('.penambahan').show();
                }
            });
            $('.dokumen').change(function(e) {
                e.preventDefault();

                var id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('dcr.3.getDokumen') }}",
                    data: {
                        id: id
                    },

                    success: function(response) {

                        $('.no_dokumen').val(response.no_dokumen);
                        $('.divisi').val(response.nama_divisi);

                    }
                });

            });
        </script>
    @endsection
</x-app-layout>
