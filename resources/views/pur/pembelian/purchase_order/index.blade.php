<x-app-layout :title="$title">
    <div class="d-flex justify-content-between">
        <nav>
            <x-nav-link route="pur.pembelian.2.index" />
        </nav>
        <br>
        <div>
            @if ($kategori != 'lainnya')
                <a href="{{ route('pur.pembelian.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                    Purchase Order</a>
            @endif
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-start">No PO</th>
                <th class="text-end" width="120">Tanggal</th>
                {{-- <th>Supplier</th>
                <th>Alamat Pengiriman</th>
                <th>PIC</th>
                <th class="text-start">Telp</th> --}}
                <th class="text-end">Estimasi</th>
                <td class="text-center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                @if ($kategori == 'lainnya')
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td data-bs-toggle="modal" data-bs-target="#detail"
                            onclick="Livewire.dispatch('showDetail', { no_po: '{{ $d->no_po }}' })"
                            class="text-start cursor-pointer text-info">{{ $d->no_po }}</td>
                        <td class="text-end">{{ tanggal($d->tgl) }}</td>
                        {{-- <td>{{ $d->supplier }}</td>
                        <td>{{ $d->alamat_pengiriman }}</td>
                        <td>Sinta</td>
                        <td class="text-start">08</td> --}}
                        <td>{{ tanggal(date('Y-m-d', strtotime('+2 days', strtotime($d->tgl)))) }}
                        </td>
                        <td>

                            <a class="btn btn-xs float-end btn-primary"
                                href="{{ route('pur.pembelian.2.print_sbw', [
                                    'no_po' => $d->no_po,
                                    'tgl' => $d->tgl,
                                    'rwb_id' => $d->rwb_id,
                                ]) }}"><i
                                    class="fas fa-print"></i></a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td data-bs-toggle="modal" data-bs-target="#detail"
                            onclick="Livewire.dispatch('showDetail', { no_po: '{{ $d->no_po }}' })"
                            class="text-start cursor-pointer text-info">{{ $d->no_po }}</td>
                        <td class="text-end">{{ tanggal($d->tgl) }}</td>
                        {{-- <td>{{ $d->supplier }}</td>
                        <td>{{ $d->alamat_pengiriman }}</td>
                        <td>{{ $d->pic }}</td>
                        <td class="text-start">{{ $d->telp }}</td> --}}
                        <td class="text-end">{{ tanggal($d->estimasi_kedatangan) }}</td>
                        <td>
                            @if ($d->status == 'draft')
                                <a class="btn btn-xs float-end btn-info selesai" data-id="{{ $d->id }}"
                                    data-item="{{ json_encode($d->item) }}" data-kategori="{{ $kategori }}"
                                    href="#">setuju</a>
                            @else
                                <a class="btn btn-xs float-end btn-primary"
                                    href="{{ route('pur.pembelian.2.print', $d->id) }}"><i
                                        class="fas fa-print"></i></a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <x-modal title="Detail Purchase Order" idModal="detail" btnSave="T">
        @livewire('pur.detail')
    </x-modal>

    <form action="" method="post">
        @csrf
        <x-modal title="Detail Po" idModal="selesai">
            <input type="hidden" name="id">
            <input type="hidden" name="kategori">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jumlah</th>
                        <th>Item</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody id="tbody-purchase-request">
                </tbody>
            </table>
        </x-modal>
    </form>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.selesai').click(function(e) {
                    e.preventDefault();

                    const id = $(this).data('id');
                    $('input[name=id]').val(id);

                    const kategori = $(this).data('kategori');
                    $('input[name=kategori]').val(kategori);

                    const item = $(this).data('item');
                    $('#tbody-purchase-request').empty();
                    $.each(item, function(index, value) {
                        $('#tbody-purchase-request').append(`
                        <tr>
                            <td>${index+1}</td>
                            <td>${value.jumlah}</td>
                            <td>${value.item_spesifikasi}</td>
                            <td>${Number(value.harga_po).toLocaleString('id-ID')}</td>
                        </tr>
                        `);
                    });
                    $('#selesai').modal('show');
                });
            });
        </script>
    @endsection

</x-app-layout>
