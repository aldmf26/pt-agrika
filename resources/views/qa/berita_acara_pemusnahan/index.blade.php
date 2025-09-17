<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>
        </div>
        <div>
            <a href="{{ route('qa.penanganan-produk.2.print') }}" class="btn btn-sm btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print
            </a>
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
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penanganan as $d)
                <tr class="{{ $d->beritaAcara ? 'table-success' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $d->rwb->grade->nama }}
                        @if ($d->beritaAcara)
                            <span class="badge bg-success ms-2">
                                <i class="fas fa-check-circle"></i> Sudah Diisi
                            </span>
                        @endif
                    </td>
                    <td>{{ $d->jumlah_produk }} gram</td>
                    <td>{{ $d->beritaAcara->cakupan ?? ($d->cakupan_pemusnahan ?? '-') }}</td>
                    <td>{{ $d->beritaAcara->alasan ?? ($d->alasan_pemusnahan ?? '-') }}</td>
                    <td>
                        @if ($d->beritaAcara && $d->beritaAcara->tgl)
                            {{ tanggal($d->beritaAcara->tgl) }}
                        @elseif($d->tgl_pemusnahan)
                            {{ tanggal($d->tgl_pemusnahan) }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($d->beritaAcara)
                            <span class="badge bg-success">Sudah Ada Berita Acara</span>
                        @else
                            <span class="badge bg-warning">Belum Ada Berita Acara</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#edit"
                            data-id="{{ $d->id }}"
                            data-cakupan="{{ $d->beritaAcara->cakupan ?? ($d->cakupan_pemusnahan ?? '') }}"
                            data-alasan="{{ $d->beritaAcara->alasan ?? ($d->alasan_pemusnahan ?? '') }}"
                            data-tgl="{{ $d->beritaAcara ? \Carbon\Carbon::parse($d->beritaAcara->tgl)->format('Y-m-d') : ($d->tgl_pemusnahan ? \Carbon\Carbon::parse($d->tgl_pemusnahan)->format('Y-m-d') : '') }}"
                            data-sudah-ada="{{ $d->beritaAcara ? 'true' : 'false' }}"
                            class="btn btn-{{ $d->beritaAcara ? 'info' : 'warning' }} btn-xs edit">
                            <i class="fas fa-edit"></i>
                            {{ $d->beritaAcara ? 'Update' : 'Edit' }}
                        </button>
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
                        <h5 class="modal-title" id="tambahModalLabel">
                            <span id="modal-title">Edit</span> Berita Acara Pemusnahan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" class="id" name="id">

                        <!-- Alert untuk menunjukkan status -->
                        <div id="status-alert" class="alert d-none mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <span id="status-message"></span>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="fw-bold">Cakupan Pemusnahan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="cakupan"
                                        placeholder="Cakupan Pemusnahan" required>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="fw-bold">Alasan Pemusnahan <span
                                            class="text-danger">*</span></label>
                                    <textarea name="alasan" class="form-control" cols="10" rows="5" placeholder="Jelaskan alasan pemusnahan..."
                                        required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="fw-bold">Tanggal Pemusnahan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tgl_pemusnahan" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            <span id="submit-btn-text">Save</span>
                        </button>
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

                    // Ambil data dari tombol
                    var id = $(this).attr('data-id');
                    var cakupan = $(this).attr('data-cakupan');
                    var alasan = $(this).attr('data-alasan');
                    var tgl_pemusnahan = $(this).attr('data-tgl');
                    var sudahAda = $(this).attr('data-sudah-ada');

                    // Set nilai form
                    $('.id').val(id);
                    $('input[name=cakupan]').val(cakupan);
                    $('textarea[name=alasan]').val(alasan);
                    $('input[name=tgl_pemusnahan]').val(tgl_pemusnahan);

                    // Update UI berdasarkan status
                    if (sudahAda === 'true') {
                        $('#modal-title').text('Update');
                        $('#submit-btn-text').text('Update');
                        $('#status-alert').removeClass('d-none alert-warning').addClass('alert-info');
                        $('#status-message').text(
                            'Data berita acara sudah ada. Anda akan mengupdate data yang existing.');
                    } else {
                        $('#modal-title').text('Tambah');
                        $('#submit-btn-text').text('Save');
                        $('#status-alert').removeClass('d-none alert-info').addClass('alert-warning');
                        $('#status-message').text(
                            'Belum ada berita acara untuk produk ini. Data baru akan dibuat.');
                    }
                });

                // Reset modal saat ditutup
                $('#edit').on('hidden.bs.modal', function() {
                    $('#status-alert').addClass('d-none');
                    $(this).find('form')[0].reset();
                });
            });
        </script>
    @endsection

    @section('styles')
        <style>
            /* Highlight untuk baris yang sudah ada berita acara */
            .table-success {
                background-color: #d1f2eb !important;
            }

            /* Animasi untuk badge */
            .badge {
                animation: fadeIn 0.5s;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            /* Hover effect untuk tombol */
            .btn-xs:hover {
                transform: scale(1.05);
                transition: transform 0.2s;
            }
        </style>
    @endsection
</x-app-layout>
