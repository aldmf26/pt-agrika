<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @include('hrga.hrga5.hrga1_programperawatansarana.nav', [
                'url' => 'hrga5.3.index',
            ])
            <a class="btn btn-primary float-end"
                href="{{ route('hrga5.3.formPermintaanperbaikan', ['kategori' => $kategori]) }}" target="_blank"><i
                    class="fas fa-plus"></i>
                Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr style="text-transform: capitalize">

                            <th>No</th>
                            <th class="text-nowrap">No Pengajuan</th>
                            <th class="text-nowrap">Nama sarana & prasarana</th>
                            <th class="text-nowrap">lokasi</th>
                            <th class="text-nowrap">No identifikasi</th>
                            <th class="text-nowrap">Diajukan</th>
                            <th class="text-nowrap">Deskripsi masalah</th>
                            <th class="text-nowrap">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permintaan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($p->invoice_pengajuan)) }}</td>
                                <td>{{ ucfirst(strtolower($p->item->nama_item)) }}</td>
                                <td>{{ ucfirst(strtolower($p->item->lokasi->lokasi)) }}</td>
                                <td>{{ ucfirst(strtolower($p->item->no_identifikasi)) }}</td>
                                <td>{{ ucfirst(strtolower($p->diajukan_oleh)) }}</td>
                                <td>{{ ucfirst(strtolower($p->deskripsi_masalah)) }}</td>
                                <td class="text-nowrap">

                                    <a href="{{ route('hrga5.3.print', ['invoice_pengajuan' => $p->invoice_pengajuan]) }}"
                                        class="btn btn-primary btn-sm" target="_blank"
                                        {{ empty($p->verifikasi_user) ? 'hidden' : '' }}><i class="fas fa-print"></i>
                                        Print</a>
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
    </div>

    <form action="{{ route('hrga5.3.save_tindakan') }}" method="post">
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
