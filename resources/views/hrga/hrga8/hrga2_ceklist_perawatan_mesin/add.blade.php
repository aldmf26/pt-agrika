<x-app-layout :title="$title">
    <div class="card">
        <div class="card-header">
            <table>
                <tr>
                    <td>Nama mesin</td>
                    <td width="1%">:</td>
                    <td>{{ $mesin->item->nama_mesin }}</td>
                </tr>
                <tr>
                    <td>Merk</td>
                    <td width="1%">:</td>
                    <td>{{ $mesin->item->merek }}</td>
                </tr>
                <tr>
                    <td>No mesin</td>
                    <td width="1%">:</td>
                    <td>{{ $mesin->item->no_identifikasi }}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td width="1%">:</td>
                    <td>{{ $mesin->item->lokasi->lokasi }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td width="1%">:</td>
                    @php
                        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
                        $lastDay = cal_days_in_month(CAL_GREGORIAN, (int) $bulan, (int) $tahun);
                        $min = $tahun . '-' . $bulan . '-01';
                        $max = $tahun . '-' . $bulan . '-' . $lastDay;
                    @endphp
                    <td><input type="date" class="form-control" min="{{ $min }}" max="{{ $max }}">
                    </td>
                </tr>
            </table>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
