<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Total Agenda</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ tanggal($d->tanggal) }}</td>
                                    <td class="text-center">{{ $d->jumlah_agenda }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('qa.notulen_tinjauan_manajemen.print', ['tanggal' => $d->tanggal]) }}"
                                            target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-print"></i>
                                            Print</a>
                                        <a href="{{ route('qa.notulen_tinjauan_manajemen.export', ['tanggal' => $d->tanggal]) }}"
                                            target="_blank" class="btn btn-sm btn-primary"><i
                                                class="fas fa-download"></i> Export</a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#import"
                                            class="btn btn-sm btn-primary cek_import" tgl="{{ $d->tanggal }}"><i
                                                class="fas fa-file-upload"></i>
                                            Import</button>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="{{ route('qa.notulen_tinjauan_manajemen.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-modal_plus size="modal-lg" id="import">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">File</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                        <input type="hidden" class="tgl_import" name="tanggal">
                    </div>
                </div>
            </x-modal_plus>
        </form>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.cek_import').click(function() {
                    var tgl = $(this).attr('tgl');
                    $('.tgl_import').val(tgl);
                });
            });
        </script>
    @endsection






</x-app-layout>
