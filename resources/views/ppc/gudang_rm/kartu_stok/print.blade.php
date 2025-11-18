<x-hccp-print :title="$title" :kategori="$kategori" :dok="$dok">
    <table class="table-xs">
        <tr>
            <th width="5%">Nama Material</th>
            <td width="30%">:
                {{ $kategori == 'sbw' ? ucwords(strtolower($nm_barang)) : ucwords(strtolower($barang->nama_barang)) }}
            </td>
        </tr>
        <tr>
            <th>PIC</th>
            <td>: {{ $pic }}</td>
        </tr>
    </table>
    <table width="100%" class="mt-3 border-dark table table-xs table-bordered">
        <thead>
            <tr>
                <th class="text-center align-middle">Tanggal</th>
                <th class="text-center align-middle">Stok Masuk @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Stok Keluar @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Stok Akhir @if ($kategori == 'sbw')
                        <br> (GR)
                    @endif
                </th>
                <th class="text-center align-middle">Kode {{ $kategori == 'sbw' ? 'Lot' : 'Barang' }}</th>
                <th class="text-center align-middle" width="100">Ttd</th>
            </tr>
        </thead>
        <tbody>
            @if ($kategori != 'sbw')
                @php $saldo = 0; @endphp
                @foreach ($transaksi as $t)
                    @php
                        if ($t['jenis'] == 'masuk') {
                            $masuk = $t['jumlah'];
                            $keluar = 0;
                            $saldo += $masuk;
                        } else {
                            $masuk = 0;
                            $keluar = $t['jumlah'];
                            $saldo -= $keluar;
                        }
                    @endphp
                    <tr>
                        <td class="text-end">{{ isset($t['tgl']) ? tanggal($t['tgl']) : '-' }}</td>
                        <td class="text-end">{{ number_format($masuk, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ number_format($keluar, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ number_format($saldo, 0) }}
                            {{ $kategori == 'sbw' ? '(GR)' : $t['satuan'] }}</td>
                        <td class="text-end">{{ $t['kode_lot'] }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            @else
                @php
                    $saldo2 = 0;
                @endphp
                @foreach ($sbw as $s)
                    @php
                        $saldo2 += ($s['ket'] == 'masuk' ? $s['gr'] : 0) - ($s['ket'] == 'masuk' ? 0 : $s['gr']);
                    @endphp
                    <tr>
                        <td class="text-end align-middle">{{ tanggal($s['tgl']) }} </td>
                        <td class="text-end align-middle">{{ $s['ket'] == 'masuk' ? number_format($s['gr'], 0) : 0 }}
                            GR</td>
                        <td class="text-end align-middle">{{ $s['ket'] == 'masuk' ? 0 : number_format($s['gr'], 0) }}
                            GR</td>
                        <td class="text-end align-middle">{{ number_format($saldo2, 0) }} GR</td>
                        <td class="text-end align-middle">{{ $s['no_invoice'] }}</td>
                        <td style="height: 40px">
                            @php
                                $nama = $s['nama'];
                                $pegawai = App\Models\DataPegawai::where('nama', $nama)->first();
                            @endphp
                            @if (empty($pegawai))
                            @else
                                <x-ttd-barcode size="40" :id_pegawai="$pegawai->karyawan_id_dari_api" />
                            @endif
                            {{-- {{ $s['name'] }} --}}
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
            <table class="table table-xs table-bordered border-dark">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd($ttdJabatan)" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            ({{ $ttdJabatan }})
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
