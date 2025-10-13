<x-hccp-print :title="$title" :dok="$dok">

    <style>
        th,
        td {

            font-size: 12px;
        }
    </style>
    <table>
        <tr>
            <td>Jenis SBW Kotor</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ ucfirst(strtolower($penerimaan->nama)) }}</td>
        </tr>
        <tr>
            <td>No Lot SBW</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ $penerimaan->no_invoice }}</td>
        </tr>
        {{-- <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ substr($penerimaan->nm_partai, 3) }}</td>
        </tr> --}}

        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">
                @php
                    $tgl_terima = date('Y-m-d', strtotime($penerimaan->tgl . ' +1 day'));
                @endphp
                {{ tanggal($penerimaan->tgl) }}</td>

        </tr>
        <tr>
            <td>Nama Rumah Walet</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ ucwords($penerimaan->rumah_walet) }}</td>
        </tr>

        <tr>
            <td>No Kendaraan</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">
                {{ empty($penerimaan->no_kendaraan_edit) ? $penerimaan->no_kendaraan : $penerimaan->no_kendaraan_edit }}
            </td>
        </tr>
        <tr>
            <td>Pengemudi</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">
                Bpk. {{ empty($penerimaan->driver) ? ucwords($penerimaan->pengemudi) : ucwords($penerimaan->driver) }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah Sbw Kotor (GR)</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ number_format($acuan['gr_awal'], 0) }} GR</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            @php
                $kg_bk = $acuan['gr_awal'];
                $penerimaan_kg = $penerimaan->kg;
            @endphp
            <td style="border-bottom: 1px solid black"><input type="checkbox"
                    {{ $kg_bk != $penerimaan_kg ? 'checked' : '' }} name="" id=""> <span
                    style="font-size: 11px" class="align-middle">Berbeda dengan
                    surat keterangan</span>

            </td>
            <td style="border-bottom: 1px solid black">&nbsp;<input type="checkbox"
                    {{ $kg_bk == $penerimaan_kg ? 'checked' : '' }} name="" id=""> <span
                    style="font-size: 11px" class="align-middle">Tidak berbeda dengan
                    surat
                    keterangan</span></td>
        </tr>
        @if ($kg_bk != $penerimaan_kg)
            <tr>
                <td></td>
                <td></td>
                <td style="font-size: 11px;border-bottom: 1px solid black" colspan="2">

                    Alasan : Kadar air masih tinggi saat dipanen hingga muat pengiriman (visual)

                </td>

            </tr>
        @else
        @endif
        <tr>
            <td>Jumlah (PCS)</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ number_format($acuan['pcs_awal'], 0) }} PCS
            </td>
        </tr>
        <tr>
            @php
                // Konversi kg ke float
                $kg = (float) str_replace(',', '.', $acuan['gr_awal']);

                // Hitung jumlah box: 20 kg per box
                $jumlahBox = max(1, round($kg / 20000, 0)); // minimal 1 box

                // Set total kolom sample yang ingin ditampilkan (default 20)
                $totalBoxDisplay = max(20, $jumlahBox); // tampilkan minimal 20 kolom

                $maxPerRow = 10; // jumlah kolom per baris
                $jumlahBaris = ceil($totalBoxDisplay / $maxPerRow);
            @endphp
            <td>Jumlah Sample</td>
            <td>:</td>
            <td>
                {{ $kg < 20000 ? '1,000 GR / @ 1 BOX' : '20,000 GR / @ ' . number_format($jumlahBox) . ' BOX' }}
            </td>
        </tr>

    </table>


    @php
        $kriterias = collect(['Warna', 'Kondisi (bulu berat & ringan, bebas jamur)', 'Grade', 'Kadar Air']);

        // Jumlah sampel aktual (maksimal 5 atau sesuai jumlah barang)
        $jumlah_sampel = $jumlahBox;

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
                <th colspan="{{ $total_kolom }}">No Reg Rumah Walet : {{ $penerimaan->no_invoice }}</th>
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

    <p style="font-size: 11px">Keputusan: <br>
    <div class="ms-5" style="font-size: 9px">
        <input readonly type="checkbox" name="keputusan" value="Diterima" required checked> Diterima
        <br>
        <input readonly type="checkbox" name="keputusan" value="Ditolak" required> Diterima
        dengan catatan .....
        <br>
        <input readonly type="checkbox" name="keputusan" value="Ditolak" required> Ditolak
        <br>
    </div>
    </p>

    <div class="row">
        <div class="col-12">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>

                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>


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
                        <td style="height: 50px; font-size: 8px" class="text-center align-middle"><span
                                style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF GUDANG BAHAN BAKU)</td>
                        <td class="text-center">(KA. GUDANG BAHAN BAKU)</td>
                        <td class="text-center">(DOKTER HEWAN)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <div class="col-4">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px; font-size: 8px" class="text-center align-middle">Ttd &
                            Nama
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">(DOKTER HEWAN)</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}

    </div>

</x-hccp-print>
