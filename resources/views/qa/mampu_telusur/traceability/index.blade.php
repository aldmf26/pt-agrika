<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Kode Batch</th>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Nama rumah walet</th>
                        <th class="text-center">Grade</th>
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
                            <td class="text-center">{{ tanggal($b['tgl']) }}</td>
                            <td class="text-center">{{ $b['no_invoice'] }}</td>
                            <td class="text-center">{{ $b['nm_partai'] }}</td>
                            <td class="text-center">{{ $rumah_walet->nama }}</td>
                            <td class="text-center">{{ $grade->nama }}</td>
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
