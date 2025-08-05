<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Jenis SBW Kotor</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ $penerimaan->nama }}</td>
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
                {{ tanggal($tgl_terima) }}</td>

        </tr>
        <tr>
            <td>Nama Rumah Walet</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ $penerimaan->rumah_walet }}</td>
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
                {{ empty($penerimaan->driver) ? $penerimaan->pengemudi : $penerimaan->driver }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah Sbw Kotor (Gr)</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ number_format($acuan['gr_awal'], 0) }} gr</td>
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

                    Alasan : kadar air masih tinggi saat dipanen hingga muat pengiriman



                </td>

            </tr>
        @else
        @endif
        <tr>
            <td>Jumlah Pcs</td>
            <td>:</td>
            <td colspan="2" style="border-bottom: 1px solid black">{{ number_format($acuan['pcs_awal'], 0) }} pcs
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
                {{ $kg < 20000 ? '1,000 gr / @ 1 box' : '20,000 gr / @ ' . number_format($jumlahBox) . ' box' }}
            </td>
        </tr>

    </table>


    <table class="mt-2 table table-xs table-bordered">
        <tr>
            <th></th>
            <th colspan="{{ $maxPerRow }}">No Reg Rumah Walet :</th>
        </tr>

        @for ($baris = 0; $baris < $jumlahBaris; $baris++)
            @php
                $start = $baris * $maxPerRow + 1;
                $end = min(($baris + 1) * $maxPerRow, $totalBoxDisplay);
            @endphp

            <tr>
                <th>Kriteria Penerimaan</th>
                @for ($i = $start; $i <= $end; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>

            @foreach ($kriteria as $k)
                <tr>
                    <td>{{ $k->kriteria }}</td>
                    @for ($i = $start; $i <= $end; $i++)
                        <td class="text-center">
                            {{-- Hanya centang sesuai jumlah box asli --}}
                            {!! $i <= $jumlahBox ? '&#10004;' : '&nbsp;' !!}
                        </td>
                    @endfor
                </tr>
            @endforeach
        @endfor
    </table>

    <p>Keputusan: <br>
    <div class="ms-5">
        <input readonly type="checkbox" name="keputusan" value="Diterima" required checked> Diterima
        <br>
        <input readonly type="checkbox" name="keputusan" value="Ditolak" required> diterima
        dengan Catatan .....
        <br>
        <input readonly type="checkbox" name="keputusan" value="Ditolak" required> Ditolak
        <br>
    </div>
    </p>
    <div class="row">
        <div class="col-8">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px"></td>
                        <td style="height: 50px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[ADM. GUDANG]</td>
                        <td class="text-center">[KA. GUDANG]</td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[Dokter Hewan]</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</x-hccp-print>
