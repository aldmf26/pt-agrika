<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <label for="" class="float-start">Tanggal : {{ tanggal($tgl) }}</label>
            <a href="{{ route('produksi.7.print', ['tgl' => $tgl]) }}" target="_blank" class="btn btn-primary float-end"><i
                    class="fas fa-print"></i> Print</a>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> View</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Jenis Produk<br><span
                                class="fst-italic fw-lighter">Grade<span></th>
                        <th colspan="2" class="text-center">Kondisi Produk<br><span
                                class="fst-italic fw-lighter">Product condition<span>
                        </th>
                        <th colspan="3" class="text-center">Jumlah<br><span
                                class="fst-italic fw-lighter">Quantity<span></th>
                        <th rowspan="2" class="text-center">Keterangan<br><span
                                class="fst-italic fw-lighter">Remarks<span></th>
                    </tr>
                    <tr>
                        <th>Ok</th>
                        <th>Not Ok</th>
                        <th>pcs</th>
                        <th>gr</th>
                        <th>box</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grading as $g)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $g['grade'] }}</td>
                            <td>Ok</td>
                            <td></td>
                            <td>{{ $g['pcs'] }}</td>
                            <td>{{ $g['gr'] }}</td>
                            <td>{{ $g['box'] }}</td>
                            <td></td>
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
