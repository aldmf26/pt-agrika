<x-hccp-print :title="$title" :dok="$dok">
    <table class="mt-5 table-xs">
        <tbody>
            <tr>
                <th>Departemen</th>
                <th>:</th>
                <th>{{ ucwords(strtolower($departemen)) }}</th>
            </tr>
            <tr>
                <th>Waktu Audit Internal</th>
                <th>:</th>
                <th>{{ tanggal(date('Y-m-d', strtotime($program->created_at))) }}</th>
            </tr>
            <tr>
                <th>Nama Auditor</th>
                <th>:</th>
                <th>{{ $program->auditor }}</th>
            </tr>
            <tr>
                <th>Nama Auditee</th>
                <th>:</th>
                <th>{{ $program->audite }}</th>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered border-dark table-xs table-hover">
        <thead style="">
            <tr>
                <th class="align-middle text-center">No</th>
                <th class="align-middle text-center">Aspek yang Dinilai</th>
                <th class="align-middle text-center">MIN</th>
                <th class="align-middle text-center">MAJ</th>
                <th class="align-middle text-center">SR</th>
                <th class="align-middle text-center">KT</th>
                <th class="align-middle text-center">OK</th>
                <th class="align-middle text-center">Keterangan / <br> Tindakan Koreksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($headings as $heading)
                <tr>
                    <td></td>
                    <td colspan="7" class="ms-1 h6">{{ $heading->nama }}</td>
                </tr>
                @foreach ($heading->subHeadings as $sub)
                    @if ($sub->nama)
                        <tr>
                            <td></td>
                            <td colspan="7" class="bg-info text-white h6 ms-1">{{ $sub->nama }}</td>
                        </tr>
                    @endif
                    @foreach ($sub->pertanyaan as $pertanyaan)
                        <tr>
                            <td class="text-end">{{ $pertanyaan->nomor_urutan }}</td>
                            <td>{{ $pertanyaan->teks }}</td>
                            <td class="text-center">
                                {{ $hasilChecklist[$pertanyaan->id]['min'] ? '√' : '' }}
                            </td>
                            <td class="text-center">
                                {{ $hasilChecklist[$pertanyaan->id]['maj'] ? '√' : '' }}
                            </td>
                            <td class="text-center">
                                {{ $hasilChecklist[$pertanyaan->id]['sr'] ? '√' : '' }}
                            </td>
                            <td class="text-center">
                                {{ $hasilChecklist[$pertanyaan->id]['kt'] ? '√' : '' }}
                            </td>
                            <td class="text-center">
                                {{ $hasilChecklist[$pertanyaan->id]['ok'] ? '√' : '' }}
                            </td>
                            <td>
                                {{ $hasilChecklist[$pertanyaan->id]['keterangan'] ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                    @if ($sub->total)
                        <tr>
                            <td colspan="8" class="bg-light">Total: {{ $sub->total->total }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        Hasil penilaian digunakan untuk menentukan tingkat kelayakan sarana produksi pangan berdasarkan penyimpangan
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
                    {{-- <tr>
                        <td>Atau</td>
                        <td class="text-end">tb</td>
                        <td class="text-end">≥ 11</td>
                        <td class="text-end">0</td>
                        <td class="text-end">0</td>
                    </tr> --}}
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
            <span class="table-xs">Ket :</span>

            <table class="table-xs">
                <tr>
                    <td class="text-start">MIN</td>
                    <td>:</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td class="text-start">MAJ</td>
                    <td>:</td>
                    <td>Major</td>
                </tr>
                <tr>
                    <td class="text-start">SR</td>
                    <td>:</td>
                    <td>Serius</td>
                </tr>
                <tr>
                    <td class="text-start">KT</td>
                    <td>:</td>
                    <td>Kritis</td>
                </tr>
                <tr>
                    <td class="text-start">OK</td>
                    <td>:</td>
                    <td>Tidak ada temuan</td>
                </tr>
                <tr>
                    <td class="text-start">TB</td>
                    <td>:</td>
                    <td>Tidak berlaku</td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered border-dark table-xs table-hover mt-3">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center" style="text-transform: none">Hasil dan Penilaian</th>
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

    <div class="row mt-5">
        <div class="col-2">
            <table class="" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Auditor,</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="2">(.................................) <br>Diisi Oleh User
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-2">
            <table class="" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Auditee,</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="2">(.................................) <br>Diisi Oleh User
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @for ($i = 0; $i < 10; $i++)
            <div class="col-2">
                <table class="" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="text-center align-middle">
                                <span style="opacity: 0.5;">(Ttd & Nama)</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">(.................................) <br>Diisi Oleh
                                User
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endfor

    </div>

</x-hccp-print>
