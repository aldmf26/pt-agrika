<x-hccp-print :title="$title" :dok="$dok">
    <table class="table border-dark table-bordered" style="font-size: 9px">
        <thead>
            <tr style="vertical-align: middle;">
                <th class="dhead text-center" rowspan="2">No</th>
                <th class="dhead text-center" rowspan="2">Tanggal</th>
                <th class="dhead text-center" rowspan="2">Nama</th>
                <th class="dhead text-center" rowspan="2">Suhu Badan <br> (<37,3 C)</th>
                <th class="dhead text-center" rowspan="2">Masker <br> (√/ X )</th>
                <th class="dhead text-center" rowspan="2">Alamat /Instansi</th>
                <th class="dhead text-center" rowspan="2">Nomor Kendaraan</th>
                <th class="dhead text-center" rowspan="2">Bertemu Dengan</th>
                <th class="dhead text-center" rowspan="2">Keperluan</th>
                <th class="dhead text-center" colspan="2">Jam</th>
                <th class="dhead text-center" rowspan="2">TTD Visitor</th>
            </tr>
            <tr style="vertical-align: middle;">
                <th class="dhead text-center">Masuk</th>
                <th class="dhead text-center">Keluar</th>
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
                    <td align="center">
                        <img src="{{ Storage::url($d->visitor_signature) }}" alt="" style="width: 50px">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <b><small class="" style="font-size: 9px">HRGA DEPARTMENT</small></b>
    </div>
</x-hccp-print>