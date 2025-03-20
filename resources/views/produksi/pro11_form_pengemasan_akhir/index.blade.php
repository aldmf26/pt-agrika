<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <a target="_blank" class="btn  btn-primary float-end" href="{{ route('produksi.11.print') }}"><i
                    class="fas fa-print"></i> Print</a>
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
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">1001</td>
                        <td class="text-center">D</td>
                        <td class="text-center">50</td>
                        <td class="text-center">500</td>
                        <td class="text-center">01/01/2025</td>
                        <td class="text-center">Mika</td>
                        <td class="text-center">30968</td>
                        <td class="text-center">30001</td>
                        <td class="text-center"></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
