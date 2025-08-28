<x-app-layout :title="$title" :container="'container-fluid'">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            {{-- <a href="{{ route('qa.penanganan-produk.2.print') }}" class="btn btn-sm btn-primary" target="_blank"><i
                    class="fas fa-print"></i>
                Print</a> --}}

            <a href="{{ route('qa.kesigapan.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Add</a>
        </div>
    </div>

    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Jenis Insiden</th>
                <th>Lokasi</th>
                <th>Penyebab</th>
                <th>Akibat</th>
                <th>Jam</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kesigapan as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal($d->tgl) }}</td>
                    <td>{{ ucfirst(strtolower($d->jenis_insiden)) }}</td>
                    <td>{{ ucfirst(strtolower($d->lokasi)) }}</td>
                    <td>{{ ucfirst(strtolower($d->penyebab)) }}</td>
                    <td>{{ ucfirst(strtolower($d->akibat)) }}</td>
                    <td>{{ $d->dari_jam }} - {{ $d->sampai_jam }}</td>

                    <td>{{ ucfirst(strtolower($d->kejadian)) }}</td>

                    <td>
                        <a href="{{ route('qa.kesigapan.1.edit', ['id' => $d->id]) }}"
                            class="btn btn-warning btn-xs edit"><i class="fas fa-edit"></i>
                            Edit</a>
                        <a href="{{ route('qa.kesigapan.1.print', ['id' => $d->id]) }}" target="_blank"
                            class="btn btn-warning btn-xs edit"><i class="fas fa-print"></i>
                            Print</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>







</x-app-layout>
