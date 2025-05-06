<x-app-layout :title="$title">
    <div class="d-flex justify-content-end gap-2">
        <div>

        </div>
        <div>
            <a href="{{ route('pur.pembelian.2.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                Purchase Order</a>
        </div>
    </div>

    <table id="example" class="table table-dark table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-start">No PO</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Alamat Pengiriman</th>
                <th>PIC</th>
                <th class="text-start">Telp</th>
                <th>Estimasi</th>
                <td class="text-center">Aksi</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start">{{ $d->no_po }}</td>
                    <td>{{ tanggal($d->tgl) }}</td>
                    <td>{{ $d->supplier }}</td>
                    <td>{{ $d->alamat_pengiriman }}</td>
                    <td>{{ $d->pic }}</td>
                    <td class="text-start">{{ $d->telp }}</td>
                    <td>{{ tanggal($d->estimasi_kedatangan) }}</td>
                    <td>
                        @if ($d->status == 'draft')
                            <a class="btn btn-xs float-end btn-info selesai" data-id="{{ $d->id }}"
                                data-item="{{ json_encode($d->item) }}" href="#">setuju</a>
                        @else
                            <a class="btn btn-xs float-end btn-primary"
                                href="{{ route('pur.pembelian.2.print', $d->id) }}"><i class="fas fa-print"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="" method="post">
        @csrf
        <x-modal title="Detail Po" idModal="selesai">
            <input type="hidden" name="id">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jumlah</th>
                        <th>Item</th>
                        <th>Harga</th>
                        <th>Tgl Dibutuhkan</th>
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

                    const item = $(this).data('item');
                    $('#tbody-purchase-request').empty();
                    $.each(item, function(index, value) {
                        $('#tbody-purchase-request').append(`
                        <tr>
                            <td>${index+1}</td>
                            <td>${value.jumlah}</td>
                            <td>${value.item_spesifikasi}</td>
                            <td>${Number(value.harga_po).toLocaleString('id-ID')}</td>
                            <td>${value.tgl_dibutuhkan}</td>
                        </tr>
                        `);
                    });
                    $('#selesai').modal('show');
                });
            });
        </script>
    @endsection

</x-app-layout>
