<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Add</button>
            <a href="{{ route('hrga8.1.print', ['kategori' => $kategori]) }}" target="_blank"
                class="btn  btn-primary float-end me-2"><i class="fas fa-print"></i> Print</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr style="text-transform: capitalize">
                        <th class=" dhead" rowspan="2">No</th>
                        <th class=" dhead" rowspan="2">Lantai</th>
                        <th class=" dhead" rowspan="2">Nama item</th>
                        <th class=" dhead" rowspan="2">Jumlah</th>
                        <th class=" dhead" rowspan="2">Lokasi</th>
                        <th class=" dhead" rowspan="2">Frekuensi perawatan</th>
                        <th class=" dhead" rowspan="2">Penanggung jawab</th>
                        <th class="text-center dhead" colspan="12">Tahun {{ $tahun }}</th>
                    </tr>
                    <tr>
                        @foreach ($bulan as $b)
                            @php
                                $tgl_bulan = $tahun . '-' . $b->bulan . '-01';

                            @endphp
                            <th class="dhead text-center">{{ date('M', strtotime($tgl_bulan)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perawatan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($p->item->lokasi->lantai ?? '-')) }}</td>
                            <td>{{ ucfirst(strtolower($p->item->nama_mesin)) }}</td>
                            <td>{{ $p->item->jumlah }}</td>
                            <td>{{ ucfirst(strtolower($p->item->lokasi->lokasi ?? '-')) }}</td>
                            <td>{{ $p->frekuensi_perawatan }} bulan</td>
                            <td>{{ ucwords($p->penanggung_jawab) }}</td>
                            @php
                                $startDate = \Carbon\Carbon::parse($p->tanggal_mulai);
                                $frekuensi = is_numeric($p->frekuensi_perawatan) ? (int) $p->frekuensi_perawatan : 1;
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
    <style>
        .modal-xlplus {
            max-width: 90%;
        }
    </style>
    <style>
        .modal-scrollable .modal-body {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
    <form action="{{ route('hrga8.1.store') }}" method="post">
        @csrf
        <div class="modal modal-scrollable fade" id="tambah" tabindex="-1" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
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
                                <input type="hidden"name="kategori" value="{{ $kategori }}">
                                <select class="form-control select2" name="item_mesin_id[]">
                                    <option value="">Pilih mesin</option>
                                    @foreach ($item as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_mesin }} -
                                            {{ $i->lokasi->lokasi ?? '-' }}
                                        </option>

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

    @section('scripts')
        <script>
            $(document).ready(function() {
                count = 0;
                $(document).on('click', '.tambah-baris', function() {
                    count++;
                    var kategori = '{{ $kategori }}';

                    $.ajax({
                        type: "get",
                        url: "{{ route('hrga8.1.load_baris') }}",
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
