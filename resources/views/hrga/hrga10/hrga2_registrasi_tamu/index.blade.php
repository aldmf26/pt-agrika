<x-app-layout :title="$title">

    <div class="row" x-data="{ checked: [] }">
        <div class="col-lg-12">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{route('hrga10.2.add')}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Data
                </a>
                <a href="{{route('hrga10.2.print')}}" class="btn btn-sm btn-primary"><i
                        class="fas fa-print"></i> Print
                </a>
            </div>
        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th class="dhead" rowspan="2">No</th>
                        <th class="dhead" rowspan="2">Tanggal</th>
                        <th class="dhead" rowspan="2">Nama</th>
                        <th class="dhead" rowspan="2">Suhu Badan <br> (<37,3 C)</th>
                        <th class="dhead" rowspan="2">Masker <br> (√/ X )</th>
                        <th class="dhead" rowspan="2">Alamat /Instansi</th>
                        <th class="dhead" rowspan="2">Nomor Kendaraan</th>
                        <th class="dhead" rowspan="2">Bertemu Dengan</th>
                        <th class="dhead" rowspan="2">Keperluan</th>
                        <th class="dhead text-center" colspan="2">Jam</th>
                        <th class="dhead" rowspan="2">TTD Visitor</th>
                        <th class="dhead" rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th class="dhead">Masuk</th>
                        <th class="dhead">Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal($d->tanggal) }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->suhu }}</td>
                            <td>{{ $d->masker }}</td>
                            <td>{{ $d->alamat }}</td>
                            <td>{{ $d->nomor_kendaraan }}</td>
                            <td>{{ $d->bertemu_dengan }}</td>
                            <td>{{ $d->keperluan }}</td>
                            <td>{{ jam($d->time_in) }}</td>
                    <td>{{ jam($d->time_out) }}</td>
                            <td>
                                <a href="{{ Storage::url($d->visitor_signature) }}" data-fancybox="signature">
                                    <img src="{{ Storage::url($d->visitor_signature) }}" alt="" width="100">
                                </a>
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
