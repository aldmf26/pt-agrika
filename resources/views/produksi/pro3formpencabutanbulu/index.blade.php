<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">


        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="" rowspan="3">No</th>
                        <th rowspan="3" class="">Regu</th>
                        <th rowspan="3" class="">Tanggal</th>
                        <th class="" colspan="2">Jumlah <br> <span class="fst-italic fw-lighter">
                                Quantity</span></th>
                        <th class="" colspan="2">Kembali <br> <span class="fst-italic fw-lighter">Retur</span>
                        </th>
                        <th class="" colspan="4">Hasil Pencabutan
                            <br> <span class="fst-italic fw-lighter">Inspection results</span>
                        </th>
                        <th rowspan="3">Aksi</th>

                    </tr>
                    <tr>
                        <th rowspan="2">Pcs</th>
                        <th rowspan="2">Gr</th>
                        <th rowspan="2">Pcs</th>
                        <th rowspan="2">Gr</th>
                        <th colspan="2">Ok</th>
                        <th colspan="2">Not Ok</th>

                    </tr>
                    <tr>
                        <th>Pcs</th>
                        <th>Gr</th>
                        <th>Pcs</th>
                        <th>Gr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabut as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(strtolower($c['name'])) }}</td>
                            <td>{{ tanggal($c['tgl']) }}</td>
                            <td>{{ $c['pcs_awal'] }}</td>
                            <td>{{ $c['gr_awal'] }}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{{ $c['pcs_akhir'] }}</td>
                            <td>{{ $c['gr_akhir'] }}</td>
                            @php
                                $susut = (1 - $c['gr_akhir'] / $c['gr_awal']) * 100;
                            @endphp
                            <td>0</td>
                            <td>0</td>
                            @php
                                $tgl = $c['tgl'];
                                $id_pengawas = $c['id_pengawas'];
                                $pengawas = $c['name'];

                            @endphp
                            <td><a target="_blank"
                                    href="{{ route('produksi.3.print', ['tgl' => $tgl, 'id_pengawas' => $id_pengawas, 'pengawas' => $pengawas]) }}"
                                    class="btn btn-warning btn-sm"> <i class="fas fa-print"></i> </a></td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


</x-app-layout>
