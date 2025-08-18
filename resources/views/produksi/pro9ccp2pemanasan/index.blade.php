<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">


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
                            <td>{{ tanggal($p['tgl']) }}</td>
                            <td>{{ number_format($p['pcs'], 0) }}</td>
                            <td>{{ number_format($p['gr'], 0) }}</td>
                            <td class="text-center">
                                <a href="{{ route('produksi.9.print', ['tgl' => $p['tgl']]) }}" target="_blank"
                                    class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    Print</a>
                                <button type="button" tgl="{{ $p['tgl'] }}" gr="{{ $p['gr'] }}"
                                    class="btn btn-primary btn-sm edit" data-bs-toggle="modal" data-bs-target="#edit"><i
                                        class="fas fa-edit"></i>
                                    Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

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
