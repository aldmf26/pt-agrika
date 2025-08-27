<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-start">Tanggal</th>
                        <th class="text-start">Kode Batch</th>
                        <th class="text-start">Kode</th>
                        <th class="text-start">Nama rumah walet</th>
                        <th class="text-start">Grade</th>
                        <th class="text-center">Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($bk as $b)
                        @php
                            $grade = DB::table('grade_sbw_kotor')->where('id', $b['grade_id'])->first();
                            $rumah_walet = DB::table('rumah_walet')->where('id', $b['rwb_id'])->first();
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ tanggal($b['tgl']) }}</td>
                            <td class="text-start">{{ $b['no_invoice'] }}</td>
                            <td class="text-start">{{ $b['nm_partai'] }}</td>
                            <td class="text-start">{{ ucfirst(strtolower($rumah_walet->nama)) }}</td>
                            <td class="text-start">{{ $grade->nama }}</td>
                            <td class="text-center">
                                <a target="_blank"
                                    href="{{ route('qa.traceability.print', ['nm_partai' => $b['nm_partai']]) }}"
                                    class="btn btn-warning btn-sm"> <i class="fas fa-print"></i></a>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
