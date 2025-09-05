<x-app-layout :title="$title" :kategori="$kategori">
    <ul class="nav nav-pills float-start">

        <li class="nav-item">
            <a class="nav-link  {{ $kategori == 'terjadwal' ? 'active' : '' }}" aria-current="page"
                href="{{ route('hrga7.1.index', ['kategori' => 'terjadwal']) }}">Terjadwal </a>

        </li>
        <li class="nav-item">
            <a class="nav-link  {{ $kategori == 'tidak' ? 'active' : '' }}" aria-current="page"
                href="{{ route('hrga7.1.index', ['kategori' => 'tidak']) }}">Tidak Terjadwal</a>

        </li>

    </ul>
    <a href="{{ route('hrga7.1.create', ['kategori' => $kategori]) }}" class="btn btn-sm btn-primary float-end"><i
            class="fas fa-plus"></i>
        Add</a>
    <div>
        <br>
        <br>
        <br>


        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th class="dhead" width="5">#</th>
                    <th class="dhead">Bulan</th>
                    <th class="dhead">Jenis Sampah</th>
                    <th class="dhead" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($datas as $d)
                    @php
                        $param = [
                            'bulan' => $d->bulan,
                            'tahun' => $d->tahun,
                            'jenis_limbah' => $d->jenis_sampah,
                            'kategori' => $kategori,
                        ];
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a
                                href="{{ route('hrga7.1.create', $param) }}">{{ formatTglGaji($d->bulan, $d->tahun) }}</a>
                        </td>
                        <td>{{ $d->jenis_sampah }}</td>
                        <td>
                            <a target="_blank" class="btn btn-sm btn-primary"
                                href="{{ route('hrga7.1.print', $param) }}"><i class="fas fa-print"></i> Print</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</x-app-layout>
