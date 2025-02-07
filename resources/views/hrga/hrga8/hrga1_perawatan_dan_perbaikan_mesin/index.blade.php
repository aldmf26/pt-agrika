<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="fas fa-plus"></i> Data</button>
            <a href="{{ route('hrga8.1.print') }}" target="_blank" class="btn  btn-primary float-end me-2"><i
                    class="fas fa-print"></i> Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th class="text-center dhead" rowspan="2">No</th>
                        <th class="text-center dhead" rowspan="2">Nama Mesin</th>
                        <th class="text-center dhead" rowspan="2">Merek</th>
                        <th class="text-center dhead" rowspan="2">No. Mesin</th>
                        <th class="text-center dhead" rowspan="2">Lokasi</th>
                        <th class="text-center dhead" rowspan="2">Frekuensi Perawatan</th>
                        <th class="text-center dhead" rowspan="2">Penanggung Jawab</th>
                        <th class="text-center dhead" colspan="12">Tahun {{ $tahun }}</th>
                    </tr>
                    <tr>
                        @foreach ($bulan as $b)
                            <th class="text-center dhead">{{ $b->bulan }}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                    @foreach ($perawatan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->item->nama_mesin }}</td>
                            <td>{{ $p->item->merek }}</td>
                            <td>{{ $p->item->no_identifikasi }}</td>
                            <td>{{ $p->item->lokasi->lokasi }}</td>
                            <td>{{ $p->frekuensi_perawatan }} bulan</td>
                            <td>{{ $p->penanggung_jawab }}</td>
                            @php
                                $startDate = \Carbon\Carbon::parse($p->tanggal_mulai);
                                $frekuensi = is_numeric($p->frekuensi_perawatan) ? (int) $p->frekuensi_perawatan : 1;
                                $bulanPerawatan = [];
                                $currentDate = $startDate->copy();
                                while ($currentDate->year === $startDate->year) {
                                    $bulanPerawatan[] = $currentDate->month;
                                    $currentDate->addMonths($frekuensi);
                                }
                            @endphp

                            @foreach ($bulan as $index => $b)
                                <td class="{{ in_array($index + 1, $bulanPerawatan) ? 'bg-primary' : '' }}"></td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('hrga8.1.store') }}" method="post">
        @csrf
        <x-modal_plus id="tambah" size="modal-lg">
            <div class="row">
                <div class="col-lg-4">
                    <label for="">Mesin</label>
                    <select name="item_mesin_id" class="select2">
                        <option value="">Pilih Mesin</option>
                        @foreach ($item as $i)
                            <option value="{{ $i->id }}">{{ $i->nama_mesin }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Frekuensi Perawatan (bulan)</label>
                    <input type="number" class="form-control" name="frekuensi_perawatan">
                </div>
                <div class="col-lg-4">
                    <label for="">Penanggun Jawab</label>
                    <input type="text" class="form-control" name="penanggung_jawab">
                </div>
                <div class="col-lg-4 mt-2">
                    <label for="">Tanggal pelaksanaan</label>
                    <input type="date" class="form-control" name="tanggal_mulai">
                </div>
            </div>
        </x-modal_plus>
    </form>
</x-app-layout>
