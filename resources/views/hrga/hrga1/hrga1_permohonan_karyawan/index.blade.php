<x-app-layout :title="$title">

    <div class="row">
        <div class="col-lg-12">
            <div class="text-end mb-3">
                <a href="{{ route('hrga1.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah
                    Permintaan</a>

                <a href="{{ route('hrga1.1.singkron') }}" class="btn btn-info ms-2 btn-sm float-end mb-2"><i
                        class="fas fa-sync"></i> Singkron Data</a>
            </div>

        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th class="dhead">#</th>
                        <th class="dhead">Tgl Dibutuhkan</th>
                        <th class="dhead">Status</th>
                        <th class="dhead">Jabatan</th>
                        <th class="dhead">Jumlah</th>
                        <th class="dhead">Alasan Penambahan</th>
                        <th class="dhead">Diajukan Oleh</th>
                        <th class="dhead">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($dataBaru as $d)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td align="right">{{ tanggal($d->tgl_dibutuhkan) }} - {{ $d->tgl_masuk ?? '' }}</td>
                            <td>{{ ucwords($d->status) }}</td>
                            <td>{{ $d->divisi->divisi }}</td>
                            <td>{{ $d->jumlah }} Orang</td>
                            <td>Adanya penambahan kapasitas aktivitas {{ $d->divisi->divisi }}</td>
                            <td>{{ $d->diajukan_oleh }}</td>
                            <td>
                                <a href="{{ route('hrga1.1.edit', [$d]) }}" class="btn btn-sm btn-primary"><i
                                        class="fas fa-pen"></i> Edit </a>

                                <a target="_blank" href="{{ route('hrga1.1.print', [$d]) }}"
                                    class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print </a>
                            </td>
                        </tr>
                    @endforeach

                    {{-- @foreach ($datas as $d)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td align="right">{{ tanggal($d->tgl_dibutuhkan) }}</td>
                            <td>{{ ucwords($d->status) }}</td>
                            <td>{{ $d->jabatan }}</td>
                            <td>{{ $d->jumlah }} Orang</td>
                            <td>Adanya penambahan kapasitas aktivitas {{ $d->jabatan }}</td>
                            <td>Widani</td>
                            <td>
                                <a target="_blank" href="{{ route('hrga1.1.print', [$d->id, $d->jumlah]) }}"
                                    class="btn btn-sm btn-primary float-end"><i class="fas fa-print"></i> Print </a>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
