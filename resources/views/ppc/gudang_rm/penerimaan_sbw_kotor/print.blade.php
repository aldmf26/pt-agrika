<x-hccp-print :title="$title" :dok="$dok">
    <table>
        <tr>
            <td>Jenis SBW Kotor</td>
            <td>:</td>
            <td>{{ $penerimaan->jenis }}</td>
        </tr>
        <tr>
            <td>No Lot SBW</td>
            <td>:</td>
            <td>{{ $penerimaan->no_lot }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($penerimaan->tgl_penerimaan)->format('dmy') }}</td>
        </tr>
        <tr>
            <td>Alamat Rumah Walet</td>
            <td>:</td>
            <td>{{ $penerimaan->alamat_rumah_walet }}</td>
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
            <td>Jumlah Sbw Kotor (Gr)</td>
            <td>:</td>
            <td>{{ $penerimaan->jumlah_gr }}</td>
        </tr>
        <tr>
            <td>Jumlah Pcs</td>
            <td>:</td>
            <td>{{ $penerimaan->jumlah_pcs }}</td>
        </tr>
    </table>

    <table class="mt-4 table table-xs table-bordered">
        <thead>
            <tr>
                <th></th>
                <th colspan="10">No Reg Rumah Walet : {{ $penerimaan->noreg_rumah_walet }}</th>
            </tr>
            <tr>
                <th>Kriteria Penerimaan </th>
                @for ($i = 1; $i < 3; $i++)
                    <th class="text-center">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaan->kriteria as $kriteria)
                <tr>
                    <th>{{ ucfirst($kriteria->kriteria) }}
                    </th>
                    <td class="text-center">{!! $kriteria->check_1 ? '√' : '' !!}</td>
                    <td class="text-center">{!! $kriteria->check_2 ? '√' : '' !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Keputusan: <br>
    <div class="ms-5">
        <input disabled @checked($penerimaan->keputusan == 'Diterima') type="checkbox" name="keputusan" value="Diterima" required> Diterima
        <br>
        <input disabled @checked($penerimaan->keputusan == 'diterima dengan Catatan (sortir)') type="checkbox" name="keputusan" value="Ditolak" required> diterima dengan Catatan (sortir)
        <br>
        <input disabled @checked($penerimaan->keputusan == 'Ditolak') type="checkbox" name="keputusan" value="Ditolak" required> Ditolak
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
                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
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
                        <td class="text-center">[DIREKTUR]</td>
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
