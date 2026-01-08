<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#import"><i
                    class="fas fa-plus"></i> import</button>

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemanasan as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ tanggal($p->tgl) }}</td>
                            <td>{{ number_format($p->pcs, 0) }}</td>
                            <td>{{ number_format($p->gr, 0) }}</td>
                            <td class="text-center">
                                <a href="{{ route('produksi.9.2.print', ['tgl' => $p->tgl]) }}" target="_blank"
                                    class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    Print</a>
                                <a href="{{ route('produksi.9.2.print2', ['tgl' => $p->tgl]) }}" target="_blank"
                                    class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    Print2</a>
                                <a href="{{ route('produksi.9.2.delete', ['tgl' => $p->tgl]) }}"
                                    onclick=" return confirm('Yakin ingin menghapus data ini?')"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('produksi.9.2.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-modal_plus size="modal-lg" id="import">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
            </div>
        </x-modal_plus>
    </form>

    <style>
        .modal-xlplus {
            max-width: 90%;
        }
    </style>
    <form action="{{ route('produksi.9.store') }}" method="post">
        @csrf
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlplus">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="load_data">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.edit').click(function(e) {
                    e.preventDefault();

                    var tgl = $(this).attr('tgl');
                    var gr = $(this).attr('gr');
                    $.ajax({
                        url: "{{ route('produksi.9.get_edit') }}",
                        type: "GET",
                        data: {
                            tgl: tgl,
                            gr: gr
                        },
                        success: function(response) {
                            $('#load_data').html(response);
                        }
                    });

                });
            });
        </script>
    @endsection


</x-app-layout>
