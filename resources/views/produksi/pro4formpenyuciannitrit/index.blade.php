<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <h5 class="float-start"></h5>


            {{-- <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> add</button> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="">Tanggal</th>
                        <th class="">Regu</th>
                        <th class="">Pcs</th>
                        <th class="">Gr</th>
                        <th class="">Gr Akhir</th>
                        <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($cabut as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($c['tgl']) }}</td>
                            <td>{{ ucwords(strtolower($c['nm_pengawas'])) }}</td>
                            <td>{{ number_format($c['pcs'], 0) }}</td>
                            <td>{{ number_format($c['gr'], 0) }}</td>
                            <td>{{ number_format($c['gr_akhir'], 0) }}</td>
                            @php
                                $id_pengawas = $c['id_pengawas'];
                                $pengawas = $c['nm_pengawas'];
                                $tanggal = $c['tgl'];
                            @endphp
                            <td><a target="_blank"
                                    href="{{ route('produksi.4.print', ['tgl' => $tanggal, 'id_pengawas' => $id_pengawas, 'pengawas' => $pengawas]) }}"
                                    class="btn btn-warning btn-sm"> <i class="fas fa-print"></i> </a></td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <style>
        .modal .modal-body {
            position: relative;
            z-index: 1;
        }

        .select2-container {
            z-index: 2000 !important;
        }

        .select2-results__options {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>


    <!-- Modal Tambah -->
    {{-- <form action="{{ route('produksi.4.store') }}" method="POST">
        @csrf
        <x-modal_plus size="modal-xl" id="tambah">
            <div class="row">

               
                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-lg-3">
                    <label for="">Nama Regu</label>
                    <input type="text" class="form-control" name="nama_operator" value="{{ auth()->user()->name }}"
                        readonly>
                </div>
                <div class="col-lg-2">
                    <label for="">Start</label>
                    <input type="time" class="form-control" name="start">
                </div>
                <div class="col-lg-2">
                    <label for="">Waktu cuci per pcs</label>
                    <input type="text" class="form-control" name="waktu_penyucian" value="30">
                </div>

                <div class="col-lg-12">
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-2">
                        <label for="">Pcs rekomendasi</label>
                        <input type="text" class="form-control pcs_rekomen">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-lg-3"><label>Nama operator cabut</label></div>
                    <div class="col-lg-3"><label>No box</label></div>
                    <div class="col-lg-2"><label>Pcs</label></div>
                </div>

                @foreach ($anak as $a)
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <input type="hidden" class="form-control" name="pegawai_id[]" value="{{ $a['id'] }}"
                                readonly>

                            <input type="text" class="form-control" value="{{ $a['nama'] }}" readonly>
                        </div>

                        <div class="col-lg-3">
                            <select name="no_box[]" id="" class="form-control select4">
                                <option value="">-Pilih Box-</option>
                                @foreach ($no_box as $b)
                                    <option value="{{ $b['no_box'] }}">{{ $b['no_box'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <input type="text" class="form-control pcs-hasil" name="pcs[]">
                        </div>

                        <div class="col-lg-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger delete" id_pegawai="{{ $a['id'] }}">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-modal_plus>
    </form>


    <form action="" method="get">
        <x-modal_plus size="modal-sm" id="view">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl">
                </div>

            </div>

        </x-modal_plus>
    </form> --}}
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.pcs_rekomen').keyup(function() {
                    var pcs = $(this).val();
                    $('.pcs-hasil').val(pcs);
                });
                $('.delete').click(function(e) {
                    e.preventDefault();
                    var id_pegawai = $(this).attr('id_pegawai');
                    var row = $(this).closest('.row');
                    row.remove();
                });
            });
        </script>
        <script>
            function initSelect2InModal() {
                $('.select4').each(function() {
                    if (!$(this).hasClass("select2-hidden-accessible")) {
                        // Dapatkan modal parent terdekat
                        const modal = $(this).closest('.modal');
                        $(this).select2({
                            dropdownParent: modal.find('.modal-body'),
                            width: '100%'
                        });
                    }
                });
            }
            $(document).on('shown.bs.modal', '.modal', function() {
                initSelect2InModal();
            });
        </script>
    @endsection


</x-app-layout>
