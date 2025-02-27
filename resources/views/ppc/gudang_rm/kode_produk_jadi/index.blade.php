<x-app-layout :title="$title">
    <div x-data="{ checked: [] }">
        <div class="d-flex justify-content-end gap-2">
            <div>
                <a href="{{ route('ppc.gudang-rm.10.print') }}" type="button" class="btn btn-sm btn-primary"><i
                        class="fas fa-print"></i> Print </a>

            </div>

        </div>

        <table id="example" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Kode Barang</th>
                    <th>Satuan</th>
                    <th>Ket</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama }}</td>
                        <td class="text-center">{{ $d->kategori }}</td>
                        <td class="text-center">{{ $d->kode}}</td>
                        <td class="text-center">{{ $d->satuan }}</td>
                        <td class="text-center">{{ $d->ket }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
