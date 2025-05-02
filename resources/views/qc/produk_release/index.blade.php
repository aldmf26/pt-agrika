<x-app-layout :title="$title">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Bulan/Tahun : {{ $bulan }}/{{ $tahun }}</h5>
                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                        class="btn btn-sm btn-primary float-end ms-2"><i class="fas fa-plus"></i> add</a> --}}
                    <a href="#" data-bs-toggle="modal" data-bs-target="#view"
                        class="btn btn-sm btn-primary float-end"><i class="fas fa-calendar"></i> view</a>

                    <a target="_blank"
                        href="{{ route('qc.produk_release.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                        class="btn btn-sm btn-primary float-end me-2"><i class="fas fa-print"></i> print</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-start align-middle">#</th>
                                <th class="text-start align-middle">Nama dan Kode Jenis Produk (XXXX)</th>
                                <th class="text-start align-middle">No Lot SBW : Tgl Bln Panen - Tgl Bln dtg - 2 digit
                                    trakhir nomor reg rumah walet</th>
                                <th class="text-start align-middle" width="5%">Kode Produksi (YYMMDD)</th>
                                <th class="text-start align-middle" width="10%">Barcode</th>
                                <th class="text-start align-middle" width="10%">Status Produk (Release/ Hold/ Reject)
                                </th>
                                <th class="text-start align-middle">Petugas Pemeriksa</th>
                                <th class="text-start align-middle">Keterangan </th>

                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($produk_release as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start align-middle">{{ $p['grade'] }}</td>
                                    <td></td>
                                    @php
                                        $tgls = explode(',', $p['tgl']);
                                    @endphp
                                    <td>
                                        @foreach (explode(',', $p['tgl']) as $tgl)
                                            {{ \Carbon\Carbon::parse($tgl)->format('ymd') }}<br>
                                        @endforeach
                                    </td>
                                    <td style="white-space: pre-wrap;">{{ $p['barcode'] }}</td>
                                    <td style="white-space: pre-wrap;">{{ $p['cek'] }}</td>
                                    <td></td>
                                    <td></td>
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
