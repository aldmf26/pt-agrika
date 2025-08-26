<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @include('hrga.hrga5.hrga1_programperawatansarana.nav', [
                'url' => 'hrga5.1.index',
            ])

            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Add</button>
            <a href="{{ route('hrga5.1.print', ['tahun' => $tahun, 'kategori' => $kategori]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i>
                Print</a>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> View</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr style="text-transform: capitalize">
                            <th class="text-center text-nowrap" rowspan="2">No</th>
                            <th class="text-center text-nowrap" rowspan="2">Nama sarana dan prasarana Umum</th>
                            <th class="text-center text-nowrap" rowspan="2">Jumlah</th>
                            <th class="text-center text-nowrap" rowspan="2">No. Identifikasi</th>
                            <th class="text-center text-nowrap" rowspan="2">Lokasi</th>
                            <th class="text-center text-nowrap" rowspan="2">Frekuensi perawatan</th>
                            <th class="text-center text-nowrap" rowspan="2">Penanggung jawab</th>
                            <th class="text-center text-nowrap" colspan="12">Tahun {{ $tahun }}</th>
                        </tr>
                        <tr>
                            @foreach ($bulan as $b)
                                <th class="text-center dhead">{{ $b->bulan }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($program as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucfirst(strtolower($p->item->nama_item)) }}</td>
                                <td>{{ ucfirst(strtolower($p->item->jumlah)) }}</td>
                                <td>{{ $p->item->no_identifikasi }}</td>
                                <td class="text-nowrap">{{ ucfirst(strtolower($p->item->lokasi->lokasi)) }}</td>
                                <td>Setiap {{ $p->frekuensi_perawatan }} bulan</td>
                                <td>{{ ucfirst(strtolower($p->penanggung_jawab)) }}</td>
                                @php
                                    $startDate = \Carbon\Carbon::parse($p->tanggal_mulai);
                                    $frekuensi = is_numeric($p->frekuensi_perawatan)
                                        ? (int) $p->frekuensi_perawatan
                                        : 1;
                                    $bulanPerawatan = [];
                                    $currentDate = $startDate->copy();
                                    while ($currentDate->year === $startDate->year) {
                                        $bulanPerawatan[] = $currentDate->month;
                                        $currentDate->addMonths($frekuensi);
                                    }
                                @endphp

                                @foreach ($bulan as $index => $b)
                                    <td class="{{ in_array($index + 1, $bulanPerawatan) ? 'bg-primary' : '' }}"></td>
                                @endforeach


                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <style>
        .modal-xlplus {
            max-width: 90%;
        }
    </style>

    <!-- FORM -->
    <form action="{{ route('hrga5.1.store') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xlplus">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Header Baris -->
                        <div class="row fw-bold mb-2">
                            <div class="col-lg-3">Nama Sarana dan Prasarana</div>
                            <div class="col-lg-3">Frekuensi Perawatan (bulan)</div>
                            <div class="col-lg-2">Penanggung Jawab</div>
                            <div class="col-lg-2">Tanggal Pelaksanaan</div>
                            <div class="col-lg-1">Aksi</div>
                        </div>

                        <!-- Dynamic Rows -->

                        <div class="row mb-2">
                            <div class="col-lg-3">
                                <select class="form-control select2" name="item_id[]">
                                    <option value="">Pilih Sarana dan Prasarana</option>
                                    @foreach ($item as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_item }}
                                            ({{ $i->no_identifikasi }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" class="form-control" name="frekuensi_perawatan[]" min="1"
                                    max="12" value="1">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="penanggung_jawab[]">
                            </div>
                            <div class="col-lg-2">
                                <input type="date" class="form-control" name="tanggal_mulai[]">
                            </div>
                            <div class="col-lg-1 d-flex align-items-end">

                            </div>
                        </div>
                        <div id="load_baris"></div>


                        <!-- Tambah Baris -->
                        <div class="col-lg-12 mt-3">
                            <button type="button" class="btn btn-block btn-warning btn-sm tambah-baris">
                                + Tambah Baris
                            </button>
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


    <form action="" method="get">
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">View</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <select name="tahun" id="" class=" form-control">
                            @foreach ($tahuns as $t)
                                <option value="{{ $t }}" @selected($tahun == $t)>{{ $t }}
                                </option>
                            @endforeach
                        </select>
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
                $(document).on('change', '.lokasi', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "{{ route('hrga5.1.get_item') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('.item').html(response);
                        }
                    });

                })
                $(document).on('change', '.item', function() {
                    var id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "{{ route('hrga5.1.get_merk') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('.merk').val(response.merk);
                            $('.no_identifikasi').val(response.no_identifikasi);
                        }
                    });

                })
                count = 0;
                $(document).on('click', '.tambah-baris', function() {
                    count++;
                    var kategori = '{{ $kategori }}';
                    $.ajax({
                        type: "get",
                        url: "{{ route('hrga5.1.load_baris') }}",
                        data: {
                            count: count,
                            kategori: kategori
                        },
                        success: function(response) {
                            $('#load_baris').append(response);
                            $('.select2_baru').select2({
                                dropdownParent: $('#tambah'), // Ganti dengan ID modal kamu
                                width: '100%'
                            });
                        }
                    });

                })
                $(document).on('click', '.hapus-baris', function() {
                    var baris = $(this).attr('baris');
                    $('[baris="' + baris + '"]').remove();
                });
            });
        </script>
    @endsection
</x-app-layout>
