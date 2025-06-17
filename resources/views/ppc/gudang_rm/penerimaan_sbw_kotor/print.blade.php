<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Jenis SBW Kotor</td>
            <td>:</td>
            <td>{{ $penerimaan->nama }}</td>
        </tr>
        <tr>
            <td>No Lot SBW</td>
            <td>:</td>
            <td>{{ $penerimaan->no_invoice }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($penerimaan->tgl)->format('d M Y') }}</td>
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
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah Sbw Kotor (Kg)</td>
            <td>:</td>
            <td>{{ number_format($penerimaan->kg, 1) }}</td>
        </tr>
        <tr>
            <td>Jumlah Pcs</td>
            <td>:</td>
            <td>{{ number_format($penerimaan->pcs, 0) }}</td>
        </tr>
        <tr>
            <td>Jumlah Sample</td>
            <td>:</td>
            <td>20 Kg / @ {{ number_format($penerimaan->kg / 20, 0) }} box</td>
        </tr>
    </table>
    @php
        $batas = round($penerimaan->kg / 20, 0);
        $maxPerRow = 10; // maksimal kolom per baris
        $jumlahKolom = $batas;
        $jumlahBarisKolom = ceil($jumlahKolom / $maxPerRow);
    @endphp

    <table class="mt-2 table table-xs table-bordered">
        <tr>
            <th></th>
            <th colspan="{{ $maxPerRow }}">No Reg Rumah Walet :</th>
        </tr>

        @for ($baris = 0; $baris < $jumlahBarisKolom; $baris++)
            @php
                $start = $baris * $maxPerRow + 1;
                $end = min(($baris + 1) * $maxPerRow, $jumlahKolom);
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
                        <td class="text-center">√</td>
                    @endfor
                </tr>
            @endforeach
        @endfor
    </table>

    <p>Keputusan: <br>
    <div class="ms-5">
        <input disabled type="checkbox" name="keputusan" value="Diterima" required checked> Diterima
        <br>
        <input disabled type="checkbox" name="keputusan" value="Ditolak" required> diterima
        dengan Catatan .....
        <br>
        <input disabled type="checkbox" name="keputusan" value="Ditolak" required> Ditolak
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
                        <td style="height: 80px"></td>
                        <td style="height: 80px"></td>
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
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center">[Dokter Hewan]</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</x-hccp-print>
