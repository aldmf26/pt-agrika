<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>TGL PANEN</th>
                        <th>TGL DATANG</th>
                        <th>NO. REG. RUMAH WALET</th>
                        <th>NAMA RUMAH WALET</th>
                        <th>BERAT KOTOR (GR)</th>
                        <th>BERAT AKHIR SORTIR (GR)</th>
                        <th>SUSUT SORTIR (GR)</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($bk as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($b['tgl']) }}</td>
                            <td>{{ tanggal($b['tgl']) }}</td>
                            <td>{{ $b['nm_partai'] }}</td>
                            <td>{{ $b['nm_partai'] }}</td>
                            <td>{{ number_format($b['gr'], 0) }}</td>
                            <td>{{ number_format($b['gr_bk'], 0) }}</td>
                            <td>{{ number_format($b['gr_susut'], 0) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
