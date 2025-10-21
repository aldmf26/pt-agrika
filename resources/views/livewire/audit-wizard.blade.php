<div>
    <div class="d-flex justify-content-between mb-2 align-items-center">

        <div>
            <h5 class="fw-bold text-success">Audit : {{ strtoupper($departemenAsli) }} </h5>

            <div class="input-group mb-3">
                <label class="input-group-text" for="tanggal">Tanggal</label>
                <input type="number" class="form-control" id="tanggal" wire:model.live="tanggalValue" min="1"
                    max="31" style="width: 100px">
                <span class="input-group-text">{{ $namaBulan }} {{ $tahun }}</span>
                <span class="text-muted text-warning text-sm mt-3 ms-2"><em>Tanggal bisa diubah</em></span>
            </div>
        </div>

        <div>
            <a href="{{ route('ia.1.print_audit_departemen', ['id' => $id, 'departemen' => $departemen, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                target="_blank" class="btn btn-sm btn-primary float-end mb-2"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
    <div x-data="{ showKet: true }" class="mb-3">
        <button class="btn btn-xs btn-info float-end mb-3" type="button" @click="showKet = !showKet"><i
                class="fas fa-info-circle"></i> Keterangan</button>

        <div x-show="!showKet">

            <div class="mt-3 table-xs">
                Hasil penilaian digunakan untuk menentukan tingkat kelayakan sarana produksi pangan berdasarkan
                penyimpangan
                menggunakan standar sebagai berikut :
            </div>

            {{-- tambahkan table disini --}}
            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered border-dark table-xs table-hover mt-3">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center align-middle">Tingkat</th>
                                <th colspan="4" class="text-center">Jumlah Penyimpangan</th>
                            </tr>
                            <tr>
                                <th class="text-center">Minor <br> (MIN)</th>
                                <th class="text-center">Major <br>(MAJ)</th>
                                <th class="text-center">Serius <br>(SR)</th>
                                <th class="text-center">Kritis <br> (KT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>A (Baik sekali)</td>
                                <td class="text-end">0 - 6</td>
                                <td class="text-end">0 - 5</td>
                                <td class="text-end">0</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <td>B (Baik)</td>
                                <td class="text-end">≥ 7</td>
                                <td class="text-end">6-10</td>
                                <td class="text-end">1-2</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <td>Atau</td>
                                <td class="text-end">tb</td>
                                <td class="text-end">≥ 11</td>
                                <td class="text-end">0</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <td>C (Kurang)</td>
                                <td class="text-end">tb</td>
                                <td class="text-end">≥ 11</td>
                                <td class="text-end">3-4</td>
                                <td class="text-end">0</td>
                            </tr>
                            <tr>
                                <td>D (Jelek)</td>
                                <td class="text-end">tb</td>
                                <td class="text-end">tb</td>
                                <td class="text-end">≥ 5</td>
                                <td class="text-end">≥ 1</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-6">
                    <table class="table table-bordered border-dark table-xs table-hover mt-3">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center" style="text-transform: none">Hasil dan Penilaian
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><b>1. Penyimpangan (Deficiency)</b></td>
                            </tr>
                            <tr>
                                <td>a. Penyimpangan Minor</td>
                                <td>Penyimpangan</td>
                            </tr>
                            <tr>
                                <td>b. Penyimpangan Major</td>
                                <td>Penyimpangan</td>
                            </tr>
                            <tr>
                                <td>c. Penyimpangan Serius</td>
                                <td>Penyimpangan</td>
                            </tr>
                            <tr>
                                <td>d. Penyimpangan Kritis</td>
                                <td>Penyimpangan</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>2. Tingkat (Rating) Unit Pengolahan</b></td>
                            </tr>
                            <tr>
                                <td>A (Baik Sekali)</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>B (Baik)</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>C (Kurang)</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>D (Jelek)</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <table class="mt-3 table table-bordered border-dark table-xs">
                <tr>
                    <th>Kode</th>
                    <th>Kepanjangan</th>
                    <th>Makna Umum</th>
                </tr>
                <tr>
                    <td>MIN</td>
                    <td>Minor</td>
                    <td>Temuan kecil. Tidak berdampak langsung terhadap mutu/keselamatan produk, tapi tetap perlu
                        diperbaiki.
                    </td>
                </tr>
                <tr>
                    <td>MAJ</td>
                    <td>Major</td>
                    <td>Temuan besar. Berisiko terhadap mutu, keselamatan, atau kepatuhan regulasi. Harus segera
                        ditindaklanjuti.</td>
                </tr>
                <tr>
                    <td>SR</td>
                    <td>Serius</td>
                    <td>Temuan serius. Bisa menyebabkan kerusakan sistem, pencemaran, atau pelanggaran hukum. Perlu
                        tindakan
                        korektif segera dan menyeluruh.</td>
                </tr>
                <tr>
                    <td>KT</td>
                    <td>Kritis</td>
                    <td>Temuan kritis. Sangat berbahaya atau fatal. Bisa menyebabkan produk tidak aman, pencemaran
                        berat,
                        atau
                        pelanggaran berat. Harus dihentikan dan diperbaiki segera.</td>
                </tr>
                <tr>
                    <td>OK</td>
                    <td>Oke</td>
                    <td>Tidak ada temuan. Sudah sesuai standar dan prosedur. Tidak perlu tindakan korektif.</td>
                </tr>
            </table>
        </div>
    </div>
    <table class="table table-bordered table-sm table-hover border-dark">
        <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
            <tr>
                <th>Aspek yang Dinilai</th>
                <th>MIN</th>
                <th>MAJ</th>
                <th>SR</th>
                <th>KT</th>
                <th>OK</th>
                <th>Keterangan / <br> Tindakan Koreksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($headings as $heading)
                <tr>
                    <td colspan="7" class="bg-primary text-black">{{ $heading->nama }}</td>
                </tr>
                @foreach ($heading->subHeadings as $sub)
                    @if ($sub->nama)
                        <tr>
                            <td colspan="7" class="bg-info text-white">{{ $sub->nama }}</td>
                        </tr>
                    @endif
                    @foreach ($sub->pertanyaan as $pertanyaan)
                        <tr>
                            <td>{{ $pertanyaan->nomor_urutan }}. {{ $pertanyaan->teks }}</td>
                            <td>
                                <input type="checkbox" wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.min"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.maj"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.sr"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.kt"
                                    value="1">
                            </td>
                            <td>
                                <input type="checkbox" wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.ok"
                                    value="1">
                            </td>
                            <td>
                                <textarea class="form-control" rows="3"
                                    wire:model.change="hasilChecklist.{{ $pertanyaan->id }}.keterangan"></textarea>
                            </td>
                        </tr>
                    @endforeach
                    @if ($sub->total)
                        <tr>
                            <td colspan="7" class="bg-light">Total: {{ $sub->total->total }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

    <button wire:click="finish" type="button" class="btn btn-md btn-block btn-outline-primary">Selesai <i
            class="fas fa-check"></i></button>

</div>
