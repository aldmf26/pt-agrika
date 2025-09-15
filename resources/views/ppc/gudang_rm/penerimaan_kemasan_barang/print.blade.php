<x-hccp-print :title="$title" :dok="$dok">
    <table class="table-xs">
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->barang->nama_barang }}</td>
        </tr>
        <tr>
            <td>Kode Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->kode_lot }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td>{{ tanggal($penerimaan->tanggal_penerimaan) }}</td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>{{ $penerimaan->supplier->nama_supplier }}</td>
        </tr>
        <tr>
            <td>No Kendaraan</td>
            <td>:</td>
            <td>{{ $penerimaan->no_kendaraan }}</td>
        </tr>
        <tr>
            <td>Pengemudi</td>
            <td>:</td>
            <td>Bpk. {{ $penerimaan->pengemudi }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->jumlah_barang }}</td>
        </tr>
        <tr>
            <td>Jumlah Sampel</td>
            <td>:</td>
            @php
                $sampel = $penerimaan->jumlah_barang > 5 ? 5 : $penerimaan->jumlah_barang;
            @endphp
            <td>{{ number_format($sampel, 0) }} PCS</td>
        </tr>
    </table>

    @php
        $kriterias = collect(['Warna Termasuk Hasil Print Kemasan', 'Kondisi Kemasan', 'Ukuran Kemasan', 'Kriteria Penerimaan']);

        // Jumlah sampel aktual (maksimal 5 atau sesuai jumlah barang)
        // $jumlah_sampel = $penerimaan->jumlah_sampel;
        $jumlah_sampel = $sampel;

        // Total kolom yang akan ditampilkan
        $total_kolom = 20;

        // Buat array untuk semua kolom (1-20)
        $all_columns = range(1, $total_kolom);

        // Chunk kolom menjadi grup per 10 kolom untuk tampilan yang lebih baik
        $column_chunks = collect($all_columns)->chunk(10);
    @endphp
    <table class="mt-4 table table-xs table-bordered w-full">
        <thead>
            <tr>
                <th></th>
                <th colspan="{{ $total_kolom }}">KODE LOT : {{ $penerimaan->kode_lot }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($column_chunks as $chunk)
                <tr>
                    <th>Kriteria Penerimaan</th>
                    @foreach ($chunk as $nomor_kolom)
                        <th class="text-center">{{ $nomor_kolom }}</th>
                    @endforeach
                </tr>

                @foreach ($kriterias as $kriteria)
                    <tr>
                        <th>{{ ucfirst($kriteria) }}</th>
                        @foreach ($chunk as $nomor_kolom)
                            <td class="text-center">
                                {{-- Tampilkan centang hanya jika nomor kolom <= jumlah sampel --}}
                                @if ($nomor_kolom <= $jumlah_sampel)
                                    √
                                @else
                                    {{-- Kolom kosong untuk nomor > jumlah sampel --}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach

                {{-- Tambahkan separator row jika bukan chunk terakhir --}}
                @if (!$loop->last)
                    <tr>
                        <td colspan="{{ count($chunk) + 1 }}"></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">
            <p>Keputusan: <br>
            <div class="ms-2" style="font-size: 11px">
                <input @checked($penerimaan->keputusan == 'Diterima') type="checkbox" name="keputusan" value="Diterima" required>
                Diterima
                <br>
                <input @checked($penerimaan->keputusan == 'Ditolak') type="checkbox" name="keputusan" value="Ditolak" required>
                Ditolak
                <br>
                <input @checked(str_contains($penerimaan->keputusan, 'Catatan')) type="checkbox" name="keputusan" value="Diterima dengan Catatan"
                    required> {{ $penerimaan->keputusan }}
            </div>
            </p>
        </div>
        <div class="col-8">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50%;">Dibuat Oleh:</th>
                        <th class="text-center" style="width: 50%;">Diperiksa Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <x-ttd />
                        </td>
                        <td>
                            {{-- jika ada ttd kepala gudang bisa tambahkan x-ttd2 --}}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(ADM. GUDANG)</td>
                        <td class="text-center">(KA. GUDANG)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-hccp-print>
