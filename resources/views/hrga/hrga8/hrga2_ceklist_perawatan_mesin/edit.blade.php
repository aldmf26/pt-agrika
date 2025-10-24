<x-app-layout :title="$title">

    <div class="card">
        <div class="card-header">
            <div class="col-4">
                <table class="table">
                    <tr>
                        <td>Lokasi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->lokasi->lantai ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td>Nama Mesin / Peralatan</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->nama_mesin) }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->jumlah) }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($mesin->lokasi->lokasi ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td>Frekuensi</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($perawatan->frekuensi_perawatan) }} Bulan</td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td width="1%">:</td>
                        <td>{{ ucwords($perawatan->penanggung_jawab) }}</td>
                    </tr>


                </table>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr style="text-transform: capitalize">
                        <th class="align-middle dhead text-center">No</th>
                        <th class="align-middle dhead text-center">Tanggal</th>
                        <th class="align-middle dhead text-center">Urutan Unit</th>
                        <th class="align-middle dhead text-center">Kriteria <br> pemeriksaan</th>
                        <th class="align-middle dhead text-center">Metode</th>
                        <th class="align-middle dhead text-center">Hasil Pemeriksaan</th>
                        <th class="align-middle dhead text-center">Status</th>
                        <th class="align-middle dhead text-center" width="15%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Hitung berapa kali kombinasi (tgl + mesin) muncul
                        $grouped = [];
                        foreach ($checklist as $item) {
                            $key = $item->tgl . '-' . $mesin->id;
                            if (!isset($grouped[$key])) {
                                $grouped[$key] = 0;
                            }
                            $grouped[$key]++;
                        }
                    @endphp

                    @php $printed = []; @endphp

                    @foreach ($checklist as $c)
                        @php $key = $c->tgl . '-' . $mesin->id; @endphp
                        <tr>
                            <td class="align-middle text-end">{{ $loop->iteration }}</td>
                            <td class="text-nowrap text-end align-middle">
                                {{ tanggal($c->tgl) }}
                                <input type="hidden" name="id[]" value="{{ $c->id }}">
                            </td>

                            {{-- Cek apakah kombinasi ini sudah dicetak --}}
                            @if (!in_array($key, $printed))
                                <td class="align-middle" rowspan="{{ $grouped[$key] }}">
                                    {{ $mesin->nama_mesin }}
                                    {{ empty($mesin->jumlah) || $mesin->jumlah == 1 ? '' : '1 sampai ' . $mesin->jumlah }}
                                </td>
                                @php $printed[] = $key; @endphp
                            @endif

                            <td class="align-middle">{{ $c->kriteria->kriteria }}</td>
                            <td class="align-middle">{{ $c->kriteria->metode }}</td>
                            <td class="align-middle">{{ $c->hasil_pemeriksaan }}</td>
                            <td class="align-middle">{{ $c->status }}</td>
                            <td class="align-middle">{{ $c->keterangan }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
