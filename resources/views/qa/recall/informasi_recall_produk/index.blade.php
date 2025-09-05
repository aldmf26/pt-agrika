<x-app-layout :title="$title">

    <div class="row" x-data="{ checked: [] }">
        <div class="col-lg-12">
            <a href="{{ route('qa.5.1.create') }}" class="btn btn-sm  btn-primary float-end"><i class="fas fa-plus"></i>
                {{ $title }}</a>
        </div>
        <div class="col-12">
            <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="">#</th>
                        <th class="">Tanggal</th>
                        <th class="">No Nota</th>
                        <th class="" width="300">Skenario</th>
                        <th class="">Dibuat Oleh</th>
                        <th class="">Jumlah Tim</th>
                        <th class="">Jumlah Produk</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recalls as $recall)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ tanggal(date('Y-m-d', strtotime($recall->created_at))) }}</td>
                            <td>{{ $recall->no_nota }}</td>
                            <td>{!! $recall->skenario_recall !!}</td>
                            <td>{{ $recall->dibuat_oleh }}</td>
                            <td>{{ $recall->teamMembers->count() }}</td>
                            <td>{{ $recall->products->count() }}</td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('qa.5.1.edit', $recall) }}" class="btn btn-sm btn-primary"><i
                                            class="fas fa-edit"></i> Edit</a>

                                    <a target="_blank" href="{{ route('qa.5.1.print', $recall) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</a>

                                    <a href="{{ route('qa.5.1.hasil', $recall) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-plus"></i> Hasil</a>

                                    <a target="_blankeni" href="{{ route('qa.5.1.hasil_print', $recall) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-print"></i> Print Hasil</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
