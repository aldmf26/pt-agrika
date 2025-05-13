<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end ms-2"><i
                    class="fas fa-plus"></i> add</a>
            <a class="btn btn-primary float-end "
                href="{{ route('qc.release_steaming.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank"><i
                    class="fas fa-print"></i> print</a> --}}
            <button data-bs-toggle="modal" data-bs-target="#view" class="btn btn-primary float-end ms-2"><i
                    class="fas fa-calendar"></i> view</button>
            <a class="btn btn-primary float-end " href="{{ route('qc.kontrol_pengemasan.print', ['tgl' => $tgl]) }}"
                target="_blank"><i class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jam</th>
                        <th rowspan="2">Item</th>
                        <th colspan="2">Mika</th>
                        <th rowspan="2">Bruto (gr)</th>
                        <th rowspan="2">Netto (gr)</th>
                        <th rowspan="2">
                            Nama & kode jenis <br> produk (XXXX)
                            <br> Ok/Not OK
                        </th>
                        <th rowspan="2">Kode produksi (YYMMDD)
                            <br> Ok/Not OK
                        </th>
                    </tr>
                    <tr>
                        <th>Per keping (gram) atau per <br> cetakan untuk hancuran (gram)</th>
                        <th>Satu kemasan MIKA <br> (gram)</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $startTime = \Carbon\Carbon::createFromTime(9, 0); // mulai dari jam 09:00
                    @endphp
                    @foreach ($bk as $index => $b)
                        @php
                            $time = $startTime->copy()->addMinutes(floor($index / 9) * 10);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $time->format('H:i') }}</td>
                            <td>{{ $b['grade'] }}</td>
                            <td>{{ empty($b['pcs']) ? 0 : number_format($b['gr'] / $b['pcs'], 0) }} gram</td>
                            <td>{{ $b['gr'] }} gram</td>
                            <td>{{ $b['gr'] + 140 }} gram</td>
                            <td>{{ $b['gr_awal'] }} gram</td>
                            <td></td>
                            <td class="text-start">{{ date('ymd', strtotime($tgl)) }} - Ok</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <form action="" method="get">
        <x-modal_plus size="modal-md" id="view">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl" value="{{ $tgl }}">
                </div>
            </div>
        </x-modal_plus>
    </form>

</x-app-layout>
