<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <label for="" class="float-start">Tanggal : {{ tanggal($tgl) }}</label>
            <a href="{{ route('produksi.6.print', ['tgl' => $tgl]) }}" target="_blank" class="btn btn-primary float-end"><i
                    class="fas fa-print"></i> print</a>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button>

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Personil Cetak <br> <span class="fst-italic fw-lighter">Personil name
                        </th>
                        <th class="text-start" rowspan="2">Kode Batch/Lot <br> <span
                                class="fst-italic fw-lighter">Batch/Lot code</th>
                        <th rowspan="2">Jenis <br> <span class="fst-italic fw-lighter">Type</th>
                        <th colspan="2">Berat Kering <br> <span class="fst-italic fw-lighter">Qty for moulding</th>
                        <th colspan="2">Berat Hasil <br> <span class="fst-italic fw-lighter">Result qty</th>
                        <th rowspan="2">Hcr <br> <span class="fst-italic fw-lighter">(gr)</th>
                        <th rowspan="2">Keterangan <br> <span class="fst-italic fw-lighter">Remarks</th>
                    </tr>
                    <tr>
                        <td>Pcs</td>
                        <td>Gr</td>
                        <td>Pcs</td>
                        <td>Gr</td>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($cetak as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c['nama'] }}</td>
                            <td class="text-start">{{ $c['no_box'] }}</td>
                            <td>{{ $c['tipe'] }}</td>
                            <td>{{ $c['pcs_awal_ctk'] }}</td>
                            <td>{{ $c['gr_awal_ctk'] }}</td>
                            <td>{{ $c['pcs_akhir'] }}</td>
                            <td>{{ $c['gr_akhir'] }}</td>
                            <td>0</td>
                            <td>-</td>
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
