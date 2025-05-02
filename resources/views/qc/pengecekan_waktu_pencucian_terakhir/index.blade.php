<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#view"
                        class="btn btn-sm btn-primary float-end"><i class="fas fa-calendar"></i> view</a>
                    <a target="_blank"
                        href="{{ route('qc.pengecekan_waktu_pencucian_terakhir.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                        class="btn btn-sm btn-primary float-end me-2"><i class="fas fa-print"></i> print</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start align-middle">#</th>
                                <th class="text-start align-middle">Kode cabut bulu : No urut - tanggal
                                    bulan & tahun cabut bulu </th>
                                <th class="text-start align-middle">No Lot SBW : Tgl Bln Panen - Tgl Bln dtg - 2 digit
                                    trakhir nomor reg rumah walet</th>
                                <th class="text-start align-middle">Jumlah (pcs / gram)</th>
                                <th class="text-start align-middle">Jenis (grade)</th>
                                <th class="text-start align-middle">Waktu mulai</th>
                                <th class="text-start align-middle">Waktu akhir</th>
                                <th class="text-start align-middle">Total waktu</th>
                                <th class="text-start align-middle">Kode Pencucian Nitrit : No Urut - Tanggal Bulan dan
                                    Tahun Pencucian Nitrit</th>

                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($cabut as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c['no_box'] }}-{{ date('dmY', strtotime($c['tgl_terima'])) }}</td>
                                    <td></td>
                                    <td>{{ $c['pcs_awal'] }}/{{ $c['gr_awal'] }}</td>
                                    <td>{{ $c['tipe'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="GET">
        <x-modal_plus size="modal-md" id="view">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Bulan</label>
                    <select name="bulan" id="" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach ($bulanlist as $b)
                            <option value="{{ $b->bulan }}" @selected($bulan == $b->bulan)>{{ $b->nm_bulan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Tahun</label>
                    <select name="tahun" id="" class="form-control">
                        <option value="">-- Pilih Tahun --</option>
                        <option value="{{ date('Y') }}" @selected($tahun == date('Y'))>{{ date('Y') }}</option>
                        <option value="{{ date('Y', strtotime('+1 year')) }}" @selected($tahun == date('Y', strtotime('+1 year')))>
                            {{ date('Y', strtotime('+1 year')) }}</option>
                    </select>
                </div>
            </div>
        </x-modal_plus>
    </form>







</x-app-layout>
