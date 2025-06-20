<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">

            {{-- <a href="{{ route('produksi.6.print', ['tgl' => $tgl]) }}" target="_blank" class="btn btn-primary float-end"><i
                    class="fas fa-print"></i> print</a>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> view</button> --}}

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Regu
                        </th>
                        <th rowspan="2">Tanggal</th>
                        <th colspan="2">Berat Kering <br> <span class="fst-italic fw-lighter">Qty for moulding</th>
                        <th colspan="2">Berat Hasil <br> <span class="fst-italic fw-lighter">Result qty</th>
                        <th rowspan="2">Hcr <br> <span class="fst-italic fw-lighter">(gr)</th>
                        <th rowspan="2">Aksi</th>
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
                            <td>{{ $c['name'] }}</td>
                            <td>{{ tanggal($c['tgl']) }}</td>
                            <td>{{ $c['pcs_awal_ctk'] }}</td>
                            <td>{{ $c['gr_awal_ctk'] }}</td>
                            <td>{{ $c['pcs_akhir'] }}</td>
                            <td>{{ $c['gr_akhir'] }}</td>
                            <td>0</td>
                            @php
                                $tgl = $c['tgl'];
                                $id_pengawas = $c['id_pengawas'];
                                $pengawas = $c['name'];
                            @endphp
                            <td><a href="{{ route('produksi.6.print', ['tgl' => $tgl, 'id_pengawas' => $id_pengawas, 'pengawas' => $pengawas]) }}"
                                    target="_blank" class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    print</a></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</x-app-layout>
