<x-app-layout :title="$title">

    <div class="row">
        <div class="col-lg-12">
        </div>
        <div class="col-12">
            <table class="table" id="example">
                <thead>
                    <tr>
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
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $d->tgl_dibutuhkan }}</td>
                            <td>{{ $d->status }}</td>
                            <td>{{ $d->jabatan }}</td>
                            <td>{{ $d->jumlah }} Orang</td>
                            <td>Adanya penambahan kapasitas aktivitas {{ $d->jabatan }}</td>
                            <td>Widani</td>
                            <td>
                                <a target="_blank" href="{{ route('hrga1.1.print', $d->id) }}"
                                    class="btn btn-sm btn-primary float-end"><i class="fas fa-print"></i> Print </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</x-app-layout>
