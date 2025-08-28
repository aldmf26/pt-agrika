<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('qa.penanganan-produk.2.print') }}" class="btn btn-sm btn-primary" target="_blank"><i
                    class="fas fa-print"></i>
                Print</a>

            {{-- <a href="{{ route('qa.penanganan-produk.2.create') }}" class="btn btn-sm btn-primary"><i
                    class="fas fa-plus"></i>
                Barang</a> --}}
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Cakupan Pemusnahan</th>
                <th>Alasan Pemusnahan</th>
                <th>Tgl</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penanganan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->rwb->grade->nama }}</td>
                    <td>{{ $d->jumlah_produk }} gram</td>
                    <td>{{ $d->cakupan_pemusnahan }}</td>
                    <td>{{ $d->alasan_pemusnahan }}</td>
                    <td>{{ empty($d->tgl_pemusnahan) ? '-' : tanggal($d->tgl_pemusnahan) }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $d->id }}"
                            cakupan="{{ $d->cakupan_pemusnahan }}" alasan="{{ $d->alasan_pemusnahan }}"
                            tgl="{{ $d->tgl_pemusnahan ? \Carbon\Carbon::parse($d->tgl_pemusnahan)->format('Y-m-d') : '' }}"
                            class="btn btn-warning btn-xs edit"><i class="fas fa-edit"></i> Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('qa.penanganan-produk.2.edit') }}" method="post">
        @csrf
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="id" name="id">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="" class="fw-bold">Cakupan Masalah</label>
                                <input type="text" class="form-control" name="cakupan"
                                    placeholder="Cakupan Pemusnahan">
                                <label for="" class="fw-bold">Alasan Pemusnahan</label>
                                <textarea name="alasan" class="form-control" cols="10" rows="5"></textarea>
                                <label for="" class="fw-bold">Tanggal Pemusnahan</label>
                                <input type="date" class="form-control " name="tgl_pemusnahan">
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
                $('.edit').click(function(e) {
                    e.preventDefault();
                    var id = $(this).attr('data-id');
                    var cakupan = $(this).attr('cakupan');
                    var alasan = $(this).attr('alasan');
                    var tgl_pemusnahan = $(this).attr('tgl');

                    $('.id').val(id);
                    $('input[name=cakupan]').val(cakupan);
                    $('textarea[name=alasan]').val(alasan);
                    $('input[name=tgl_pemusnahan]').val(tgl_pemusnahan);
                });
            });
        </script>
    @endsection



</x-app-layout>
