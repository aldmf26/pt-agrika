<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button>
            <a href="{{ route('hrga5.1.print', ['tahun' => $tahun]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i>
                Print</a>
            <button class="btn btn-primary float-end me-2" data-bs-toggle="modal" data-bs-target="#view"><i
                    class="fas fa-calendar"></i> View</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap" rowspan="2">No</th>
                            <th class="text-center text-nowrap" rowspan="2">Nama Sarana dan Prasarana Umum</th>
                            <th class="text-center text-nowrap" rowspan="2">Merek</th>
                            <th class="text-center text-nowrap" rowspan="2">No. Identifikasi</th>
                            <th class="text-center text-nowrap" rowspan="2">Lokasi</th>
                            <th class="text-center text-nowrap" rowspan="2">Frekuensi Perawatan</th>
                            <th class="text-center text-nowrap" rowspan="2">Penanggung Jawab</th>
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
                                <td>{{ $p->item->nama_item }}</td>
                                <td>{{ $p->item->merek }}</td>
                                <td>{{ $p->item->no_identifikasi }}</td>
                                <td class="text-nowrap">{{ $p->item->lokasi->lokasi }}</td>
                                <td>Setiap {{ $p->frekuensi_perawatan }} bulan</td>
                                <td>{{ $p->penanggung_jawab }}</td>
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
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="">Lokasi</label>
                                <select id="" class="select2 lokasi">
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id }}">{{ $l->lokasi }} lantai
                                            ({{ $l->lantai }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Nama Sarana dan Prasarana Umum</label>
                                <select name="item_id" id="" class="select2 item">

                                </select>
                            </div>

                            <div class="col-lg-2">
                                <label for="">Merek</label>
                                <input type="text" class="form-control merk" disabled>
                            </div>

                            <div class="col-lg-2">
                                <label for="">No identifikasi</label>
                                <input type="text" class="form-control no_identifikasi" disabled>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Frekuensi Perawatan</label>
                                <input type="number" class="form-control" name="frekuensi_perawatan" value="1">
                            </div>
                            <div class="col-lg-2 mt-2">
                                <label for="">Penanggung jawab </label>
                                <input type="text" class="form-control" name="penanggung_jawab">
                            </div>
                            <div class="col-lg-2 mt-2">
                                <label for="">Tanggal pelaksanaan</label>
                                <input type="date" class="form-control" name="tanggal_mulai">
                            </div>





                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
            });
        </script>
    @endsection
</x-app-layout>
