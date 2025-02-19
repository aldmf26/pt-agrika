<x-hccp-print :title="$title" :dok="$dok">
    <span>{{ $profil->nama_perusahaan }}</span>
    <ul style="list-style: none; padding-left: 0">
        <li>Telp : {{ $profil->telepon }}</li>
        <li>Fax : {{ $profil->fax }}</li>
    </ul>

    <div class="row">
        <div class="col-md-6">
            <strong>To:</strong> {{ $datas->pelanggan->nama_pelanggan }}
        </div>
        <div class="col-md-6 text-end">
            <strong>Order No:</strong> {{ $datas->nomor_order }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{ $datas->pelanggan->alamat }}
        </div>
        <div class="col-md-6 text-end">
            <strong>Tanggal:</strong> {{ tanggal($datas->tanggal_order) }}
        </div>
    </div>

    <p>Bersama ini kami kirimkan</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Item & Kode</th>
                <th>Jumlah</th>
                <th>CoA*</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas->detailSuratJalan as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $detail->jumlah }} {{ $detail->produk->satuan }} {{ $detail->catatan }}</td>
                    <td>{{ $detail->perlu_coa }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>* Disertai CoA Ya (Y) atau Tidak (T)</p>

    <div class="row mb-5">
        <div class="col-md-6">
            <strong>No Kendaraan: {{$datas->nomor_kendaraan}}</strong><br>
            <strong>Supir: {{$datas->nama_supir}}</strong>
        </div>
    </div>

    <div class="row mb-4 mt-5">
        <div class="col-md-4">
            Dibuat oleh, {{$datas->dibuat_oleh}}
        </div>
        <div class="col-md-4">
            Disetujui oleh, {{$datas->dibuat_oleh}}
        </div>
        <div class="col-md-4">
            Pengirim, {{$datas->pengirim}}
        </div>
    </div>

    <div class="mb-4">
        <strong>Keterangan:</strong> Tanda terima terlampir
    </div>

</x-hccp-print>
