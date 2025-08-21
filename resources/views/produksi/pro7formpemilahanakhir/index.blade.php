<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            {{-- <label for="" class="float-start">Tanggal : {{ tanggal($tgl) }}</label>
            <a href="{{ route('produksi.7.print', ['tgl' => $tgl]) }}" target="_blank" class="btn btn-primary float-end"><i
                    class="fas fa-print"></i> Print</a>
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end me-2"><i
                    class="fas fa-calendar"></i> View</button> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-start">Tanggal</th>
                        <th class="text-start">Kode Lot</th>
                        <th class="text-start">Nomer Po Grading</th>
                        <th class="text-start">Grade</th>
                        <th class="text-end">Pcs</th>
                        <th class="text-end">Gr</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grading as $g)
                        @php
                            $sbw = DB::table('sbw_kotor')
                                ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                ->where('nm_partai', 'like', '%' . $g['nm_partai'] . '%')
                                ->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($g['tgl']) }}</td>
                            <td>{{ $sbw->no_invoice ?? $g['nm_partai'] }}</td>
                            <td>{{ $g['no_invoice'] }}</td>
                            <td>{{ $sbw->nama ?? '-' }}</td>
                            <td>{{ number_format($g['pcs'], 0) }}</td>
                            <td>{{ number_format($g['gr'], 0) }}</td>
                            <td class="text-center">
                                <a href="{{ route('produksi.7.print', ['tgl' => $g['tgl'], 'nm_partai' => $g['nm_partai'], 'grade' => $sbw->nama ?? '-', 'kode_lot' => $sbw->no_invoice, 'no_po' => $g['no_invoice']]) }}"
                                    target="_blank" class="btn btn-primary btn-sm "><i class="fas fa-print"></i>
                                    Print</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</x-app-layout>
