<div>
    @forelse ($datas as $d)

        <table class="table table-bordered table-dark">
            <tr>
                <th>NO PR</th>
                <th>{{ $d['purchase_request']['no_pr'] }}</th>
            </tr>
            <tr>
                <th>NO PO</th>
                <th>{{ $d['no_po'] }}</th>
            </tr>
            <tr>
                <th>Tanggal PO</th>
                <td>{{ tanggal($d['tgl']) }}</td>
            </tr>
            <tr>
                <th>Supplier</th>
                <td>{{ $d['supplier'] }}</td>
            </tr>
            <tr>
                <th>Alamat Pengiriman</th>
                <td>{{ $d['alamat_pengiriman'] }}</td>
            </tr>
            <tr>
                <th>PIC</th>
                <td>{{ $d['pic'] }}</td>
            </tr>
            <tr>
                <th>Telp</th>
                <td>{{ $d['telp'] }}</td>
            </tr>
            <tr>
                <th>Estimasi Kedatangan</th>
                <td>{{ tanggal($d['estimasi_kedatangan']) }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>{{ 'Rp. ' . number_format($d['total_harga'], 0, ',', '.') }}</td>
            </tr>
        </table>

        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jumlah</th>
                    <th>Item dan Spesifikasi</th>
                    <th>Tanggal Dibutuhkan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($d['item'] as $i)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $i['jumlah'] }}</td>
                        <td>{{ $i['item_spesifikasi'] }}</td>
                        <td>{{ tanggal($i['tgl_dibutuhkan']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <div class="alert alert-warning">
            <strong>Loading!</strong> Tunggu sebentar.
        </div>
    @endforelse
</div>
