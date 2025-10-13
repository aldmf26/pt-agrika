<x-app-layout :title="$title">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end gap-2">

                <div>
                    {{-- <a href="{{ route('ppc.gudang-fg.1.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Delivery</a> --}}
                </div>
            </div>


            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Order</th>
                        <th>Tanggal Order</th>
                        <th>Nama Customer</th>
                        <th class="text-end">Ttl Produk</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($delivery as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>P-{{ $d['no_nota'] }}</td>
                            <td>{{ tanggal($d['tgl']) }}</td>
                            <td>{{ $d['tujuan'] }}</td>
                            <td class="text-end">
                                {{ $d['ttl_box'] }} Box
                            </td>
                            <td class="text-center">
                                <a class="btn btn-xs  btn-primary" target="_blank"
                                    href="{{ route('ppc.gudang-fg.1.print', ['no_nota' => $d['no_nota'], 'tgl' => $d['tgl']]) }}"><i
                                        class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
