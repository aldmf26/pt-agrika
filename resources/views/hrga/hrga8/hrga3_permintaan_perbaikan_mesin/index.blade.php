<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('hrga8.3.formpengajuan', ['kategori' => $kategori]) }}" class="btn btn-primary float-end"><i
                    class="fas fa-plus"></i>
                Add</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr style="text-transform: capitalize">
                        <th>#</th>
                        <th>Nama Item</th>
                        <th>Lokasi</th>
                        <th>No Item</th>
                        <th>Deadline</th>
                        <th>Diajukan oleh</th>
                        <th>Deskripsi Masalah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($p->item_mesin->nama_mesin)) }}</td>
                            <td>{{ ucfirst(strtolower($p->item_mesin->lokasi->lokasi ?? '-')) }}</td>
                            <td>{{ ucfirst(strtolower($p->item_mesin->no_identifikasi)) }}</td>
                            <td>{{ tanggal($p->deadline) }}</td>
                            <td>{{ ucfirst(strtolower($p->diajukan_oleh)) }}</td>
                            <td>{{ ucfirst(strtolower($p->deskripsi_masalah)) }}</td>
                            <td>
                                <a target="_blank"
                                    href="{{ route('hrga8.3.print', ['invoice_pengajuan' => $p->invoice_pengajuan, 'kategori' => $kategori]) }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Print</a>
                                <button type="button" invoice_pengajuan="{{ $p->invoice_pengajuan }}"
                                    detail_perbaikan="{{ $p->detail_perbaikan }}"
                                    verifikasi_user="{{ $p->verifikasi_user }}"
                                    deskripsi_masalah="{{ $p->deskripsi_masalah }}"
                                    class="btn {{ empty($p->verifikasi_user) ? 'btn-primary' : 'btn-success' }}  btn-sm tindakan"
                                    data-bs-toggle="modal" data-bs-target="#tindakan"><i class="fas fa-edit"></i>
                                    Tindakan</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <form action="{{ route('hrga8.3.save_tindakan') }}" method="post">
        @csrf
        <div class="modal fade" id="tindakan" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tindakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="no_invoice" name="invoice_pengajuan">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="" class="fw-bold">Deskripsi Masalah</label>
                                <p class="deskripsi_masalah"></p>
                                <label for="" class="fw-bold">Detail Perbaikan</label>
                                <textarea name="detail_perbaikan" class="form-control" cols="30" rows="10"></textarea>
                                <label for="" class="fw-bold">Verifikasi User</label>
                                <input type="text" class="form-control" name="verifikasi_user">
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
                $('.tindakan').click(function(e) {
                    e.preventDefault();
                    var invoice_pengajuan = $(this).attr('invoice_pengajuan');
                    var detail_perbaikan = $(this).attr('detail_perbaikan');
                    var verifikasi_user = $(this).attr('verifikasi_user');
                    var deskripsi_masalah = $(this).attr('deskripsi_masalah');
                    $('.no_invoice').val(invoice_pengajuan);
                    $('textarea[name=detail_perbaikan]').val(detail_perbaikan);
                    $('input[name=verifikasi_user]').val(verifikasi_user);
                    $('.deskripsi_masalah').text(deskripsi_masalah);


                });
            });
        </script>
    @endsection
</x-app-layout>
