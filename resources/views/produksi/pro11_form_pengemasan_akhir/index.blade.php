<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a target="_blank" class="btn  btn-primary float-end"
                href="{{ route('produksi.11.print', ['tgl' => $tgl]) }}"><i class="fas fa-print"></i> Print</a>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> View</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center">No</th>
                        <th rowspan="2" class="text-center">Kode Batch/Lot <br>
                            <span class="fst-italic fw-lighter">Batch/Lot code</span>
                        </th>
                        <th rowspan="2" class="text-center">Jenis Produk <br>
                            <span class="fst-italic fw-lighter">Grade</span>
                        </th>
                        <th colspan="2" class="text-center">Jumlah</th>
                        <th rowspan="2" class="text-center">Tgl/ bln/ thn
                            <br>
                            Produksi
                            <br>
                            (Steaming)
                            <br>
                            <span class="fst-italic fw-lighter">steaming production date (DD/MM/YY)</span>
                        </th>
                        <th rowspan="2" class="text-center">Kemasan<br>
                            <span class="fst-italic fw-lighter">Packaging</span>
                        </th>
                        <th rowspan="2" class="text-center">No Lot Kemasan<br>
                            <span class="fst-italic fw-lighter">Packaging lot no</span>
                        </th>
                        <th rowspan="2" class="text-center">Barcode<br>
                            <span class="fst-italic fw-lighter">Barcode</span>
                        </th>
                        <th rowspan="2" class="text-center">Keterangan<br>
                            <span class="fst-italic fw-lighter">Remarks</span>
                        </th>
                    </tr>
                    <tr>
                        <th>Pcs</th>
                        <th>Gr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengiriman_akhir as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $p['no_box'] }}</td>
                            <td class="text-center">{{ $p['grade'] }}</td>
                            <td class="text-center">{{ $p['pcs'] }}</td>
                            <td class="text-center">{{ $p['gr'] }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($p['tgl_input'])) }}</td>
                            <td class="text-center">Mika</td>
                            <td class="text-center">{{ $p['no_nota'] }}</td>
                            <td class="text-center">{{ $p['no_barcode'] }}</td>
                            <td class="text-center"></td>
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
