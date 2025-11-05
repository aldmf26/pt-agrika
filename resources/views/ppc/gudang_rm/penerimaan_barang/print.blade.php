<x-hccp-print :title="$title" :dok="$dok">
    <style>
        @media print {
            @page {
                margin: 15mm;
            }

            body {
                margin: 0;
            }

            table {
                border-collapse: collapse;
            }

            td,
            th {
                padding: 2px;
            }
        }
    </style>

    <table class="table-xs">
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td>{{ strtoupper($penerimaan->barang->nama_barang) }}</td>
        </tr>
        <tr>
            <td>Kode Barang</td>
            <td>:</td>
            <td>{{ $penerimaan->kode_lot }}</td>
        </tr>

        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td>{{ tanggal($penerimaan->tanggal_terima) }}</td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>{{ $penerimaan->barang->supplier->nama_supplier }}</td>
        </tr>
        <tr>
            <td>No Kendaraan</td>
            <td>:</td>
            <td>{{ $penerimaan->no_kendaraan }}</td>
        </tr>
        <tr>
            <td>Pengemudi</td>
            <td>:</td>
            <td>{{ $penerimaan->pengemudi }}</td>
        </tr>

        <tr>
            <td>Jumlah Barang</td>
            <td>:</td>
            <td>{{ number_format($penerimaan->jumlah_barang, 0) }} PCS</td>
        </tr>
        <tr>
            <td>Jumlah Sample</td>
            <td>:</td>
            @php
                $sampel = $penerimaan->jumlah_barang > 5 ? 5 : $penerimaan->jumlah_barang;
            @endphp
            <td>{{ number_format($sampel, 0) }} PCS</td>
        </tr>
    </table>
    @php
        $kriterias = collect(['Keutuhan Barang', 'Kesesuaian Jumlah', 'Kesesuaian Kondisi (tebal, warnanya, dll)']);

        // Jumlah sampel aktual (maksimal 5 atau sesuai jumlah barang)
        $jumlah_sampel = $sampel;

        // Total kolom yang akan ditampilkan
        $total_kolom = 20;

        // Buat array untuk semua kolom (1-20)
        $all_columns = range(1, $total_kolom);

        // Chunk kolom menjadi grup per 10 kolom untuk tampilan yang lebih baik
        $column_chunks = collect($all_columns)->chunk(10);
    @endphp

    <table class="mt-4 table table-xs table-bordered border-dark">
        <thead>
            <tr>
                <th></th>
                <th colspan="{{ $total_kolom }}">KODE BARANG : {{ $penerimaan->kode_lot }}</th>
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
                        <td>{{ ucfirst($kriteria) }}</td>
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
    <div class="row table-xs">
        <div class="col-4">
            <p>Keputusan: <br>
            <div class="ms-2">
                <input @checked($penerimaan->status_penerimaan == 'Diterima') type="checkbox" name="keputusan" value="Diterima" required>
                Diterima
                <br>
                <input @checked($penerimaan->status_penerimaan == 'Diterima dengan Catatan (sortir)') type="checkbox" name="keputusan"
                    value="Diterima dengan Catatan (sortir)" required> Diterima dengan Catatan (sortir) <br>
                <input @checked($penerimaan->status_penerimaan == 'Ditolak') type="checkbox" name="keputusan" value="Ditolak" required>
                Ditolak
                <br>
            </div>
            </p>
        </div>

    </div>
    <div class="row">
        <div class="col-5"></div>

        <div class="col-7">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px; font-size: 8px" class="text-center align-middle"><span
                                style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 50px; font-size: 8px" class="text-center align-middle"><span
                                style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF PURCHASING)</td>
                        <td class="text-center">(KEPALA PURCHASING)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
