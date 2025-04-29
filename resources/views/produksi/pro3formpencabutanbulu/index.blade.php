<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <label for="" class="float-start">Tanggal : {{ tanggal($tgl) }}</label>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button>

            <a href="{{ route('produksi.3.print', ['tgl' => $tgl]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="" rowspan="2">No</th>
                        <th rowspan="2" class="">Nama Operator Cabut <br><span class="fst-italic fw-lighter">
                                Operator
                                name</span></th>
                        <th rowspan="2" class="text-start">Kode Batch/Lot <br> <span class="fst-italic fw-lighter">
                                Batch/Lot
                                code</span>
                        <th rowspan="2" class="">Jenis<br> <span class="fst-italic fw-lighter">
                                type</span></th>
                        <th class="" colspan="2">Jumlah <br> <span class="fst-italic fw-lighter">
                                Quantity</span></th>
                        <th class="" colspan="2">Kembali <br> <span class="fst-italic fw-lighter">Retur</span>
                        </th>
                        <th class="" colspan="2">Hasil Pencabutan
                            <br> <span class="fst-italic fw-lighter">Inspection results</span>
                        </th>
                        <th rowspan="2" class="">Keterangan<br> <span
                                class="fst-italic fw-lighter">Remarks</span>
                        </th>
                    </tr>
                    <tr>
                        <th class="">Pcs</th>
                        <th class="">Gr</th>
                        <th class="">Pcs</th>
                        <th class="">Gr</th>
                        <th class="">Ok</th>
                        <th class="">Not Ok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabut as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(strtolower($c['nama'])) }}</td>
                            <td class="text-start">{{ $c['no_box'] }}</td>
                            <td>{{ $c['tipe'] }}</td>
                            <td>{{ $c['pcs_awal'] }}</td>
                            <td>{{ $c['gr_awal'] }}</td>
                            <td>{{ $c['pcs_akhir'] }}</td>
                            <td>{{ $c['gr_akhir'] }}</td>
                            @php
                                $susut = (1 - $c['gr_akhir'] / $c['gr_awal']) * 100;
                            @endphp
                            <td class="">
                                {!! round($susut, 1) < $c['batas_susut'] ? '<i class="fa-solid fa-check"></i>' : '' !!}
                            </td>
                            <td class="">
                                {!! round($susut, 1) >= $c['batas_susut'] ? '<i class="fa-solid fa-check"></i>' : '' !!}
                            </td>
                            <td>{!! round($susut, 1) >= $c['batas_susut'] ? 'Susut melebihi batas susut' : '' !!}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="" method="get">
        <x-modal_plus size="modal-sm" id="view">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl" value="{{ $tgl }}">
                </div>

            </div>
        </x-modal_plus>
    </form>
</x-app-layout>
