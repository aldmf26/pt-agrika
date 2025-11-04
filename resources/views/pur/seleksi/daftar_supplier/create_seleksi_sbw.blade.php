<x-app-layout :title="$title">
    <form action="{{ route('pur.seleksi.1.store_seleksi_sbw', $supplier) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <h6>Data Seleksi Supplier</h6>
                    @if ($seleksi)
                        <a target="_blank" href="{{ route('pur.seleksi.1.seleksi_sbw', $supplier) }}"
                            class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Cetak</a>
                    @endif
                </div>
                <table class="table table-lg border-dark">
                    <thead>
                        <tr>
                            <th>Jenis Supply</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <th>SBW</th>
                            <th>{{ $supplier->nama }}</th>
                            <th>{{ $supplier->alamat }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            @php
                                $tabs = [
                                    [
                                        'id' => 'produk',
                                        'title' => 'Informasi Produk',
                                    ],
                                    [
                                        'id' => 'manajemen',
                                        'title' => 'Informasi Manajemen',
                                    ],
                                    [
                                        'id' => 'pembayaran',
                                        'title' => 'Sistem Pembayaran',
                                    ],
                                    [
                                        'id' => 'sample',
                                        'title' => 'Sample',
                                    ],
                                    [
                                        'id' => 'lab',
                                        'title' => 'Departemen Lab',
                                    ],
                                    [
                                        'id' => 'penerimaan',
                                        'title' => 'Departemen Penerimaan',
                                    ],
                                    [
                                        'id' => 'hewan',
                                        'title' => 'Dokter Hewan',
                                    ],
                                ];
                            @endphp

                            @foreach ($tabs as $tab)
                                <button class="text-start nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="{{ $tab['id'] }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#{{ $tab['id'] }}" type="button" role="tab"
                                    aria-controls="{{ $tab['id'] }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $tab['title'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($tabs as $tab)
                                <div class="tab-pane {{ $loop->first ? 'show active' : '' }}" id="{{ $tab['id'] }}"
                                    role="tabpanel" aria-labelledby="{{ $tab['id'] }}-tab">

                                    <h5 class="mb-3">{{ $tab['title'] }}</h5>
                                    <hr>



                                    @switch($tab['id'])
                                        {{-- ======================= INFORMASI PRODUK ======================= --}}
                                        @case('produk')
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Material yang ditawarkan</label>
                                                        <textarea name="material_ditawarkan" class="form-control" rows="3">{!! $seleksi->material_ditawarkan ?? 'SBW Kotor' !!}</textarea>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="form-label">No Reg RWB</label>
                                                        <div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="reg_rwb"
                                                                    id="reg_rwb-ada" value="Ada (lampirkan)"
                                                                    {{ isset($seleksi) && $seleksi->reg_rwb == 'Ada (lampirkan)' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="reg_rwb-ada">Ada
                                                                    (lampirkan)
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="reg_rwb"
                                                                    id="reg_rwb-tidak-ada" value="Tidak Ada"
                                                                    {{ isset($seleksi) && $seleksi->reg_rwb == 'Tidak Ada' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="reg_rwb-tidak-ada">Tidak
                                                                    Ada</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="reg_rwb"
                                                                    id="reg_rwb-tidak-relevan" value="Tidak relevan"
                                                                    {{ isset($seleksi) && $seleksi->reg_rwb == 'Tidak relevan' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="reg_rwb-tidak-relevan">Tidak relevan</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Spesifikasi</label>
                                                        <textarea name="spesifikasi" class="form-control" rows="3">{!! $seleksi->spesifikasi ??
                                                            '1. Tidak ada jamur pink
                                                                                                                                                                                                                                                                                                                                                                                                                                                                2. Tidak boleh ada batu' !!}</textarea>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Estimasi Delivery (sejak PO diterima)</label>
                                                        <input name="estimasi_delivery" type="text" class="form-control"
                                                            value="{{ $seleksi->estimasi_delivery ?? '1 minggu' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @break

                                        {{-- ======================= INFORMASI MANAJEMEN ======================= --}}
                                        @case('manajemen')
                                            <div class="form-group mb-3">
                                                <label class="form-label">Sistem Manajemen yang telah diterapkan di perusahaan
                                                    anda</label>
                                                <div>
                                                    <div class="form-check">
                                                        <input
                                                            {{ (isset($seleksi) && $seleksi->sistem_manajemen == 'HACCP (Sedang menunggu sertifikat HACCP dari pabrik)') || !isset($seleksi) ? 'checked' : '' }}
                                                            type="radio" name="sistem_manajemen" class="form-check-input"
                                                            id="manajemen-haccp"
                                                            value="HACCP (Sedang menunggu sertifikat HACCP dari pabrik)">
                                                        <label class="form-check-label" for="manajemen-haccp">
                                                            HACCP (Sedang menunggu sertifikat HACCP dari pabrik)
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->sistem_manajemen == 'GMP' ? 'checked' : '' }}
                                                            type="radio" name="sistem_manajemen" class="form-check-input"
                                                            id="manajemen-gmp" value="GMP">
                                                        <label class="form-check-label" for="manajemen-gmp">GMP</label>
                                                    </div>

                                                    <div class="form-check" x-data="{ lainnya: false }"
                                                        @click.outside="lainnya = false">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->sistem_manajemen == 'Lainnya' ? 'checked' : '' }}
                                                            @click="lainnya = true" type="radio" name="sistem_manajemen"
                                                            class="form-check-input" id="manajemen_lainnya" value="Lainnya">
                                                        <label @click="lainnya = true" class="form-check-label"
                                                            for="manajemen_lainnya">Lainnya
                                                            (sebutkan)</label>
                                                        <input :class="{ 'd-none': !lainnya }" name="manajemen_lainnya"
                                                            type="text" class="form-control mt-2"
                                                            placeholder="Sebutkan jika lainnya"
                                                            value="{{ $seleksi->manajemen_lainnya ?? '' }}">
                                                    </div>

                                                    <div class="form-check">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->sistem_manajemen == 'Belum ada' ? 'checked' : '' }}
                                                            type="radio" name="sistem_manajemen" class="form-check-input"
                                                            id="manajemen-belum" value="Belum ada">
                                                        <label class="form-check-label" for="manajemen-belum">Belum
                                                            ada</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Profil perusahaan</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->profil_perusahaan == 'Ada' ? 'checked' : '' }}
                                                            type="radio" name="profil_perusahaan" class="form-check-input"
                                                            id="profil-perusahaan-ada" value="Ada">
                                                        <label class="form-check-label" for="profil-perusahaan-ada">Ada
                                                            (lampirkan)</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ (isset($seleksi) && $seleksi->profil_perusahaan == 'Tidak ada') || !isset($seleksi) ? 'checked' : '' }}
                                                            type="radio" name="profil_perusahaan" class="form-check-input"
                                                            id="profil-perusahaan-tidak-ada" value="Tidak ada">
                                                        <label class="form-check-label"
                                                            for="profil-perusahaan-tidak-ada">Tidak ada</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @break

                                        {{-- ======================= SISTEM PEMBAYARAN ======================= --}}
                                        @case('pembayaran')
                                            <div class="form-group mb-3">
                                                <label class="form-label">Lama jatuh tempo yang diizinkan</label>
                                                <input name="jatuh_tempo" type="text" class="form-control"
                                                    value="{{ $seleksi->jatuh_tempo ?? '3 Bulan / 90 Hari' }}">
                                            </div>
                                        @break

                                        {{-- ======================= SAMPLE ======================= --}}
                                        @case('sample')
                                            <div class="form-group mb-3">
                                                <textarea name="sample" class="form-control" rows="3">{!! $seleksi->sample ?? 'Jenis sample yang diberikan (jumlah): tidak tersedia sample a.' !!}</textarea>
                                            </div>
                                        @break

                                        {{-- ======================= DEPARTEMEN LAB ======================= --}}
                                        @case('lab')
                                            <div class="form-group mb-3">
                                                <label class="form-label">Hasil Pemeriksaan</label>
                                                <textarea name="hasil_pemeriksaan_lab" class="form-control" rows="3">{!! $seleksi->hasil_pemeriksaan_lab ??
                                                    '1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu
                                                                                                                                                                                                                                                                                                                                                                                                2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm)' !!}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Kesimpulan</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ (isset($seleksi) && $seleksi->lab_kesimpulan == 'Lulus Pengujian') || !isset($seleksi) ? 'checked' : '' }}
                                                            type="radio" name="lab_kesimpulan" class="form-check-input"
                                                            id="lab-lulus" value="Lulus Pengujian">
                                                        <label class="form-check-label" for="lab-lulus">Lulus
                                                            Pengujian</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->lab_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}
                                                            type="radio" name="lab_kesimpulan" class="form-check-input"
                                                            id="lab-tidak-lulus" value="Tidak Lulus Pengujian">
                                                        <label class="form-check-label" for="lab-tidak-lulus">Tidak Lulus
                                                            Pengujian</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @break

                                        {{-- ======================= DEPARTEMEN PENERIMAAN ======================= --}}
                                        @case('penerimaan')
                                            <div class="form-group mb-3">
                                                <label class="form-label">Hasil Pemeriksaan</label>
                                                <textarea name="hasil_pemeriksaan_penerimaan" class="form-control" rows="3">{!! $seleksi->hasil_pemeriksaan_penerimaan ??
                                                    '1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu' !!}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Kesimpulan</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ (isset($seleksi) && $seleksi->penerimaan_kesimpulan == 'Lulus Pengujian') || !isset($seleksi) ? 'checked' : '' }}
                                                            type="radio" name="penerimaan_kesimpulan"
                                                            class="form-check-input" id="penerimaan-lulus"
                                                            value="Lulus Pengujian">
                                                        <label class="form-check-label" for="penerimaan-lulus">Lulus
                                                            Pengujian</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->penerimaan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}
                                                            type="radio" name="penerimaan_kesimpulan"
                                                            class="form-check-input" id="penerimaan-tidak-lulus"
                                                            value="Tidak Lulus Pengujian">
                                                        <label class="form-check-label" for="penerimaan-tidak-lulus">Tidak
                                                            Lulus Pengujian</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @break

                                        @default
                                            {{-- ======================= DOKTER HEWAN ======================= --}}
                                            <div class="form-group mb-3">
                                                <label class="form-label">Hasil Pemeriksaan</label>
                                                <textarea name="hasil_pemeriksaan_hewan" class="form-control" rows="3">{!! $seleksi->hasil_pemeriksaan_hewan ??
                                                    '1. SBW sesuai dalam kondisi visual, tidak ada jamur pink, serta batu 2. SBW sesuai dengan kadar nitrite maksimal 50mg/l (ppm) sesuai yang dilaporkan bagian lab' !!}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Kesimpulan</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ (isset($seleksi) && $seleksi->hewan_kesimpulan == 'Lulus Pengujian') || !isset($seleksi) ? 'checked' : '' }}
                                                            type="radio" name="hewan_kesimpulan" class="form-check-input"
                                                            id="hewan-lulus" value="Lulus Pengujian">
                                                        <label class="form-check-label" for="hewan-lulus">Lulus
                                                            Pengujian</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            {{ isset($seleksi) && $seleksi->hewan_kesimpulan == 'Tidak Lulus Pengujian' ? 'checked' : '' }}
                                                            type="radio" name="hewan_kesimpulan" class="form-check-input"
                                                            id="hewan-tidak-lulus" value="Tidak Lulus Pengujian">
                                                        <label class="form-check-label" for="hewan-tidak-lulus">Tidak
                                                            Lulus Pengujian</label>
                                                    </div>
                                                </div>
                                            </div>
                                    @endswitch
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-block btn-primary float-end">Save</button>
            </div>
        </div>
    </form>

</x-app-layout>
