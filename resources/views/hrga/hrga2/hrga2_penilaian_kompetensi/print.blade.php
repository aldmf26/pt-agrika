<div class="employee-record" style="page-break-after: always;">
    <x-hccp-print :title="$title" :dok="$dok">
        <style>
            * {
                font-size: 10px;
            }
        </style>
        <div class="row">
            <div class="col-lg-4">
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $datas->nama_karyawan }}</td>
                    </tr>
                    <tr>
                        <td>Div / Dept</td>
                        <th>:</th>
                        <td>{{ $datas->departemen }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <th>:</th>
                        <td>{{ $datas->karyawan->posisi }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <table class="table">
                    <tr>
                        <td>Tgl Masuk Kerja</td>
                        <td>:</td>
                        <td>{{ tanggal($datas->karyawan->tgl_masuk) }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Berakhirnya Masa Percobaan</td>
                        <td>:</td>
                        <td>
                            @php
                                $tgl = new DateTime($datas->karyawan->tgl_masuk);
                                $tgl->modify('+3 month');

                            @endphp
                            {{ tanggal($tgl->format('Y-m-d')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th>:</th>
                        <td>{{ ucwords($datas->karyawan->status) }} </td>
                    </tr>

                </table>
            </div>
        </div>

        <span>I. Penilaian Kompetensi</span>
        <div class="row">
            <div class="col-7">
                <table class="table table-bordered text-center border-dark align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Standard Kompetensi</th>
                            <th class="text-center">Aktual</th>
                            <th class="text-center">Tidak Lanjut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $masterKompetensi = [
                                1 => 'Menguasai pekerjaan di divisinya',
                                2 => 'Tidak pernah melakukan kecerobohan dalam pekerjaannya',
                                3 => 'Telah mendapat training HACCP, GMP, CCP',
                            ];
                            $kompetensiData = $datas->kompetensi->keyBy('kompetensi') ?? collect();
                        @endphp
                        @foreach ($masterKompetensi as $no => $komp)
                            @php
                                $kompData = $kompetensiData->get(
                                    $komp,
                                    (object) ['aktual' => false, 'tidak_lanjut' => false],
                                );
                            @endphp
                            <tr>
                                <td class="text-end">{{ $no }}</td>
                                <td align="left">{{ $komp }}</td>
                                <td class="text-center">{{ $kompData->aktual ? '√' : '' }}</td>
                                <td class="text-center">{{ $kompData->tidak_lanjut ? '√' : '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <span>II. CATATAN KEHADIRAN</span>

        <table class="table table-bordered border-dark  align-middle">
            <thead class="" style="text-align: center;">
                <tr>
                    <th class="dhead text-center align-middle" rowspan="3">No</th>
                    <th class="dhead text-center align-middle" rowspan="3">Keterangan</th>
                    <th class="dhead text-center" colspan="24">Bulan</th>
                    <th class="dhead align-middle text-center" rowspan="3" colspan="2">Total</th>
                </tr>
                <tr>
                    <!-- Angka bulan -->
                    <th class="dhead text-center" colspan="2">1</th>
                    <th class="dhead text-center" colspan="2">2</th>
                    <th class="dhead text-center" colspan="2">3</th>
                    <th class="dhead text-center" colspan="2">4</th>
                    <th class="dhead text-center" colspan="2">5</th>
                    <th class="dhead text-center" colspan="2">6</th>
                    <th class="dhead text-center" colspan="2">7</th>
                    <th class="dhead text-center" colspan="2">8</th>
                    <th class="dhead text-center" colspan="2">9</th>
                    <th class="dhead text-center" colspan="2">10</th>
                    <th class="dhead text-center" colspan="2">11</th>
                    <th class="dhead text-center" colspan="2">12</th>
                </tr>
                <tr>
                    <!-- Sub-baris untuk Hari dan Jam -->
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                    <th class="dhead text-center">Hari</th>
                    <th class="dhead text-center">Jam</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $keteranganKehadiran = ['Terlambat', 'Sakit', 'Tanpa Keterangan', 'Izin'];
                    $kehadiranData = $datas->kehadiran->groupBy('keterangan') ?? collect();
                    $grandTotalHari = 0;
                    $cekCabut = ['Staf Cabut', 'Staf Molding/perapian'];
                @endphp
                @foreach ($keteranganKehadiran as $index => $ket)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td align="left">{{ $ket }}</td>
                        @php $totalHariKet = 0; @endphp
                        @for ($bulan = 1; $bulan <= 12; $bulan++)
                            @php
                                $hadir =
                                    $kehadiranData->get($ket, collect())->firstWhere('bulan', $bulan) ??
                                    (object) ['hari' => 0, 'jam' => 0];
                                $hariValue = $hadir->hari ?? 0;
                                $jamValue = $hadir->jam ?? 0;
                                if (in_array($datas->karyawan->posisi ?? '', $cekCabut)) {
                                    $absenCabut =
                                        ($absen['total_per_bulan'][$bulan] ?? 0) > 26
                                            ? 0
                                            : (($absen['total_per_bulan'][$bulan] ?? 0) == 0
                                                ? 0
                                                : 26 - ($absen['total_per_bulan'][$bulan] ?? 0));
                                    $hariValue = $absenCabut == 0 ? 0 : $absenCabut;
                                    $jamValue = $absenCabut == 0 ? 0 : number_format($absenCabut * 8, 0);
                                    $totalHariKet += $absenCabut;
                                } else {
                                    $totalHariKet += $hariValue;
                                }
                            @endphp
                            <td class="text-end">{{ $hariValue }}</td>
                            <td class="text-end">{{ $jamValue }}</td>
                        @endfor
                        <td class="text-end">{{ $totalHariKet }}</td>
                        <td class="text-end">{{ number_format($totalHariKet * 8, 0) }}</td>
                    </tr>
                    @php $grandTotalHari += $totalHariKet; @endphp
                @endforeach
            </tbody>
            <tfoot class="">
                <tr>
                    <th colspan="6" class="text-center">Penilaian :</th>
                    <th colspan="20" class="text-center">Grand Total</th>
                    <th class="text-center">{{ $grandTotalHari }}</th>
                    <th class="text-center">{{ number_format($grandTotalHari * 8, 0) }}</th>
                </tr>
                <tr>
                    <th colspan="6">
                        <table width='100%'>
                            <tr>
                                <td>Baik Sekali</td>
                                <td>= Grand Total < 3 Hari</td>
                            </tr>
                            <tr>
                                <td>Baik </td>
                                <td>= Grand Total 4 - 7 Hari</td>
                            </tr>
                            <tr>
                                <td>Cukup </td>
                                <td>= Grand Total 8 - 12 Hari </td>
                            </tr>
                            <tr>
                                <td>Kurang </td>
                                <td>= Grand Total > 12 Hari </td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td>= 1 Hari = 8 Jam</td>

                            </tr>
                        </table>
                    </th>
                    <td colspan="22" class="align-middle">
                        @php
                            if ($grandTotalHari < 3) {
                                $nilai = 'Baik Sekali';
                            } elseif ($grandTotalHari >= 3 && $grandTotalHari <= 7) {
                                $nilai = 'Baik';
                            } elseif ($grandTotalHari > 7 && $grandTotalHari <= 12) {
                                $nilai = 'Cukup';
                            } else {
                                $nilai = 'Kurang';
                            }

                            $opsi = ['Baik Sekali', 'Baik', 'Cukup', 'Kurang'];
                        @endphp

                        Nilai catatan kehadiran :
                        @foreach ($opsi as $o)
                            @if ($o === $nilai)
                                {{ $o }}
                            @else
                                <s>{{ $o }}</s>
                            @endif

                            @if (!$loop->last)
                                /
                            @endif
                        @endforeach

                    </td>
                </tr>
            </tfoot>
        </table>


    </x-hccp-print>
</div>
<br>
<x-hccp-print :title="$title" :dok="$dok">
    <h6>III. SURAT PERINGATAN YANG DITERIMA</h6>
    <hr />

    <ol style="line-height: 2">

        @php
            $keterangans = $datas->suratPeringatan
                ? array_map('trim', explode('; ', $datas->suratPeringatan->keterangan ?? ''))
                : [];
        @endphp
        <table width="100%">
            <tr>
                <td width="140">1. Surat peringatan I, karena</td>
                <td width="20">:</td>
                <td>{{ !empty($keterangans[0]) ? $keterangans[0] : 'tidak pernah……………………………………………………………………………………………………………………………………………………………………………………………….' }}
                </td>
            </tr>
            <tr>
                <td>2. Surat peringatan II, karena</td>
                <td>:</td>
                <td>{{ !empty($keterangans[1]) ? $keterangans[1] : 'tidak pernah……………………………………………………………………………………………………………………………………………………………………………………………….' }}
                </td>
            </tr>
            <tr>
                <td>3. Surat peringatan III, karena</td>
                <td>:</td>
                <td>{{ !empty($keterangans[2]) ? $keterangans[2] : 'tidak pernah……………………………………………………………………………………………………………………………………………………………………………………………….' }}
                </td>
            </tr>
        </table>



    </ol>

    <div class="row">
        <div class="col-5">
            <h6>IV. PENILAIAN</h6>
            <div class="row">
                <div class="col-8">
                    <table class="table table-bordered border-dark">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Parameter</th>
                                <th class="text-center">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $parameters =
                                    $datas->parameter->map(fn($p) => [$p->parameter, $p->nilai])->toArray() ?? [];
                                $total = array_sum(array_column($parameters, 1));
                            @endphp
                            @foreach ($parameters as $index => $param)
                                <tr>
                                    <td class="text-end">{{ $index + 1 }}</td>
                                    <td>{{ ucwords($param[0]) }}</td>
                                    <td class="text-end">{{ $param[1] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2" class="text-center">TOTAL</th>
                                <th class="text-end">{{ number_format($total, 0) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th colspan="2" class="text-center">Keterangan :</th>
                        </tr>
                        <tr>
                            <td>Baik sekali </td>
                            <td>86 - 100</td>
                        </tr>
                        <tr>
                            <td>Baik</td>
                            <td>70 - 85</td>
                        </tr>
                        <tr>
                            <td>Cukup</td>
                            <td>60 - 69</td>
                        </tr>
                        <tr>
                            <td>Kurang</td>
                            <td>
                                < 60</td>
                        </tr>
                    </table>

                    <table class="table table-bordered border-dark">
                        <tr>
                            <td>SP : Surat peringatan</td>
                        </tr>
                        <tr>
                            <td>SP I = 10 </td>
                        </tr>
                        <tr>
                            <td>SP II = 20</td>
                        </tr>
                        <tr>
                            <td>SP III = 40</td>
                        </tr>
                    </table>

                    <div class="d-flex p-2 border border-dark">
                        <div class="m-auto">
                            Nilai =
                        </div>
                        <div class="m-auto" style="line-height: 1">
                            <p>Total Nilai - SP</p>
                            <hr>
                            <p>Total Parameter</p>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <div class="col-7">
            <h6 class="mb-5">V. REKOMENDASI</h6>
            @php
                $totalParameter = count(
                    array_filter($parameters, function ($v) {
                        return $v !== 0;
                    }),
                );

                $totalSp1 = !empty($keterangans[0]) ? 10 : 0;
                $totalSp2 = !empty($keterangans[1]) ? 20 : 0;
                $totalSp3 = !empty($keterangans[2]) ? 40 : 0;
                $totalSp = $totalSp1 + $totalSp2 + $totalSp3;

                $aktual = ($total - $totalSp) / $totalParameter;
            @endphp
            <p>Aktual Nilai :
                <b>{{ number_format($aktual ?? 0, 1) }}</b>
            </p>
            <table width="60%">
                <tr>
                    <td width="60">Kesimpulan :</td>
                    <td>{{ $datas->kategori_nilai }}. {!! !empty($datas->rekomendasi)
                        ? $datas->rekomendasi
                        : "<span class='text-danger fst-italic'>rekomendasi belum diisi</span>" !!}
                    </td>
                </tr>
            </table>
            {{-- <p>Kesimpulan : Ybs dinilai cakap / baik dalam menjalankan performanya.
                Ybs bisa dilanjut kontrak /
                kerjasama dengan <br> perusahaan. Dipertimbangkan untuk mendapatkan kontrak yang panjang</p> --}}
        </div>
        <div class="col-lg-12">
            <div class="row mt-5">
                <div class="col-3"></div>
                <div class="col-9">
                    <table class="table table-bordered border-dark" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                                <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                                <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="height: 70px" class="align-middle text-center">
                                    <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                </td>
                                <td style="height: 70px" class="align-middle text-center">
                                    <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                </td>
                                <td style="height: 70px" class="align-middle text-center">
                                    <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">(STAFF HRGA)</td>
                                <td class="text-center">(KA. HRGA)</td>
                                <td class="text-center">(OPERATIONAL MANAGER)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-hccp-print>

<style>
    @media print {
        .employee-record {
            page-break-after: always;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* Pastikan halaman terakhir tidak memiliki page break */
        .employee-record:last-child {
            page-break-after: avoid;
        }

        /* Memastikan konten tidak terpotong */
        table {
            page-break-inside: avoid;
        }

        /* Mengatur margin halaman */
        @page {
            margin: 2cm;
        }
    }
</style>
