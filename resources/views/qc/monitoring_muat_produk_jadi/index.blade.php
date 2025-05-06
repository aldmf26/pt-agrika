<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end ms-2"><i
                    class="fas fa-plus"></i> add</a>
            <a class="btn btn-primary float-end "
                href="{{ route('qc.release_steaming.print', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank"><i
                    class="fas fa-print"></i> print</a> --}}
            <a class="btn btn-primary float-end " href="{{ route('qc.monitoring_muat_produkJadi.print') }}"
                target="_blank"><i class="fas fa-print"></i> print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th colspan="2">Tanggal</th>
                        <th colspan="3">Jam</th>
                        <th rowspan="2">Nomor mobil</th>
                        <th rowspan="2">No.DO</th>
                        <th rowspan="2">Nama Produk & Kode <br> Produksi</th>
                        <th rowspan="2">Jumlah Produk (kg)</th>
                        <th rowspan="2">Nama Ekspedisi</th>
                        <th colspan="2">Ttd dan Nama</th>
                    </tr>
                    <tr>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Lama muat</th>
                        <th>QC FG</th>
                        <th>Spv Gudang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('dmY', strtotime($d->tgl_masuk)) }}</td>
                            <td>{{ date('dmY', strtotime($d->tgl_keluar)) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $d->nm_produk }} & {{ $d->kode_produk }}</td>
                            <td>{{ $d->kg / 1000 }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>


</x-app-layout>
