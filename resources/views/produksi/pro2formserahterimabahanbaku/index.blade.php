<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button>
            <a href="{{ route('produksi.2.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank"
                class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">No</th>
                        <th class="text-center" rowspan="2">Hari/tanggal <br> <span
                                class="fst-italic fw-lighter">date</span></th>
                        <th class="text-center" rowspan="2">Jenis bahan baku <br> <span
                                class="fst-italic fw-lighter">raw material type</span></th>
                        <th class="text-center" rowspan="2">Kode Batch/Lot <br> <span
                                class="fst-italic fw-lighter">Bacth/Lot code</span></th>
                        <th class="text-center" colspan="4">Diserahkan <br> <span
                                class="fst-italic fw-lighter">Over</span></th>
                        <th class="text-center" colspan="4">Diterima <br> <span
                                class="fst-italic fw-lighter">Accepted</span></th>
                        <th class="text-center" rowspan="2">Keterangan <br> <span
                                class="fst-italic fw-lighter">Remaks</span></th>
                    </tr>
                    <tr>
                        <th class="text-center">Box</th>
                        <th class="text-center">Pcs</th>
                        <th class="text-center">Gr</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Box</th>
                        <th class="text-center">Pcs</th>
                        <th class="text-center">Gr</th>
                        <th class="text-center">Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bk as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($b['tgl']) }}</td>
                            <td>{{ $b['tipe'] }}</td>
                            <td>{{ $b['nm_partai'] }}</td>
                            <td class="text-start">{{ $b['no_box'] }}</td>
                            <td>{{ $b['pcs_awal'] }}</td>
                            <td>{{ $b['gr_awal'] }}</td>
                            <td>{{ ucwords(strtolower($b['pengawas'])) }}</td>
                            <td class="text-start">{{ $b['no_box'] }}</td>
                            <td>{{ $b['pcs_awal'] }}</td>
                            <td>{{ $b['gr_awal'] }}</td>
                            <td>{{ ucwords(strtolower($b['name'])) }}</td>
                            <td>-</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <form action="" method="get">
        <x-modal_plus size="modal-md" id="view">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Bulan</label>
                    <select class="form-control" name="bulan">
                        @foreach ($bulans as $b)
                            <option value="{{ $b->bulan }}">{{ $b->nm_bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Tahun</label>
                    <Select class="form-control" name="tahun">
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </Select>
                </div>
            </div>
        </x-modal_plus>
    </form>
</x-app-layout>
