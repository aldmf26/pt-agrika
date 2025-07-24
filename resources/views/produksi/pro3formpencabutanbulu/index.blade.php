<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">


        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="">Regu</th>
                        <th class="">Pcs</th>
                        <th class="">Gr</th>
                        <th class="">Gr Akhir</th>
                        <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($cabut as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(strtolower($c['nm_pengawas'])) }}</td>
                            <td>{{ number_format($c['pcs'], 0) }}</td>
                            <td>{{ number_format($c['gr'], 0) }}</td>
                            <td>{{ number_format($c['gr_akhir'], 0) }}</td>
                            @php
                                $id_pengawas = $c['id_pengawas'];
                                $pengawas = $c['nm_pengawas'];
                            @endphp
                            <td><a target="_blank"
                                    href="{{ route('produksi.3.print', ['id_pengawas' => $id_pengawas, 'pengawas' => $pengawas]) }}"
                                    class="btn btn-warning btn-sm"> <i class="fas fa-print"></i> </a></td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


</x-app-layout>
