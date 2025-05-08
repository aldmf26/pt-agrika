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
            <a class="btn btn-primary float-end " href="{{ route('qc.kontrol_grading.print', ['tgl' => $tgl]) }}"
                target="_blank"><i class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jam sampling</th>
                        <th>No Lot SBW : Tgl Bln Panen - Tgl Bln dtg - <br> 2 digit trakhir nomor reg rumah walet
                            <br> (Lihat Produksi)
                        </th>
                        <th>Jumlah SBW <br> (Keping/ gr)</th>
                        <th>Jenis (Grade)</th>
                        <th>Ok/Tidak Ok</th>
                        <th>Keterangan</th>
                        <th>Kode Grading : Nomor Urut - Tanggal Bulan Tahun <br> Grading <br>
                            (Lihat di Produksi)</th>
                    </tr>

                </thead>
                <tbody>
                    @php
                        $startTime = \Carbon\Carbon::createFromTime(9, 0); // mulai dari jam 09:00
                    @endphp
                    @foreach ($grading as $index => $g)
                        @php
                            $time = $startTime->copy()->addMinutes(floor($index / 9) * 10);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $time->format('H:i') }}</td>
                            <td></td>
                            <td>{{ $g['pcs'] }}/{{ $g['gr'] }}</td>
                            <td>{{ $g['grade'] }}</td>
                            <td>Ok</td>
                            <td></td>
                            <td>{{ $g['box_pengiriman'] }}-{{ date('dmY', strtotime($g['tgl'])) }}</td>
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
