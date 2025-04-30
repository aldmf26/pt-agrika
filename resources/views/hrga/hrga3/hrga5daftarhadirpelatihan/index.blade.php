<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tema Pelatihan</th>
                        <th>Hari/Tanggal</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Narasumber</th>
                        <th>Kisaran Materi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $j)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst(strtolower($j->tema_pelatihan)) }}</td>
                            <td>{{ $j->tanggal }}</td>
                            <td>{{ $j->waktu }}</td>
                            <td>{{ $j->tempat }}</td>
                            <td>{{ ucfirst(strtolower($j->narasumber)) }}</td>
                            <td>{{ ucfirst(strtolower($j->kisaran_materi)) }}</td>
                            <td>
                                <a href="{{ route('hrga3.5.print', ['nota_pelatihan' => $j->nota_pelatihan]) }}"
                                    target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> print</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
