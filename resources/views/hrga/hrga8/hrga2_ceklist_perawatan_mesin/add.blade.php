<x-app-layout :title="$title">
    <form action="{{ route('hrga8.2.store') }}" method="POST">
        @csrf
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
                        <td>
                            <input type="date" class="form-control" name="tgl" min="{{ $min }}"
                                max="{{ $max }}" value="{{ $checklist2->tgl ?? '' }}">
                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                        </td>
                    </tr>
                </table>

                <hr>

            </div>
            <div class="card-body">
                <div class="row" x-data="{ rows: {{ json_encode($checklist) }} }" x-init="$nextTick(() => initSelect2())">
                    <div class="col-lg-2">
                        <label for="">Kriteria pemeriksaan</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Metode</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Hasil pemeriksaan</label>
                    </div>
                    <div class="col-lg-3">
                        <label for="">Status</label>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Keterangan</label>
                    </div>
                    <template x-for="(row, index) in rows" :key="row.id">
                        <div class="row mb-2">
                            <div class="col-lg-2">
                                <input type="text" class="form-control" :value="row.kriteria_pemeriksaan"
                                    name="kriteria_pemeriksaan[]">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" :value="row.metode ?? 'Visual'"
                                    name="metode[]">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" :value="row.hasil_pemeriksaan ?? 'OK'"
                                    name="hasil_pemeriksaan[]">
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control"
                                    :value="row.status ?? 'Tidak membutuhkan perbaikan, dapat digunakan kembali'"
                                    name="status[]">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="keterangan[]" :value="row.keterangan">
                            </div>
                            <div class="col-lg-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger" @click="rows.splice(index, 1)"
                                    x-show="rows.length > 1">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                    </template>
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary mt-2 btn-block"
                            @click="rows.push({ id: Date.now() }); $nextTick(() => initSelect2())">
                            <i class="fas fa-plus"></i> Tambah baris
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-end">save</button>
                <a href="{{ route('hrga8.1.index') }}" class="btn btn-secondary float-end me-2">cancel</a>
            </div>
        </div>
    </form>
</x-app-layout>
