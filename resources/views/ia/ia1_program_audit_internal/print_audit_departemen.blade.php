<x-hccp-print :title="$title" :dok="$dok">
    <table class="mt-5">
        <tbody>
            <tr>
                <th>Departemen</th>
                <th>:</th>
                <th>{{ ucwords(strtolower($departemen)) }}</th>
            </tr>
            <tr>
                <th>Waktu Audit Internal</th>
                <th>:</th>
                <th>{{ date('d-m-Y', strtotime($program->created_at)) }}</th>
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

    <table class="table table-bordered border-dark table-sm table-hover">
        <thead style="">
            <tr>
                <th class="align-middle">No</th>
                <th class="align-middle">Aspek yang Dinilai</th>
                <th class="align-middle">MIN</th>
                <th class="align-middle">MAJ</th>
                <th class="align-middle">SR</th>
                <th class="align-middle">KT</th>
                <th class="align-middle">OK</th>
                <th class="align-middle">Keterangan / <br> Tindakan Koreksi</th>
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
                            <td class="text-center">{{ $pertanyaan->nomor_urutan }}</td>
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
            <table class="table table-bordered border-dark table-sm table-hover mt-3">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center align-middle">Tingkat</th>
                        <th colspan="4" class="text-center">Jumlah Penyimpangan</th>
                    </tr>
                    <tr>
                        <th class="text-end">Minor <br> (MIN)</th>
                        <th class="text-end">Major <br>(MAJ)</th>
                        <th class="text-end">Serius <br>(SR)</th>
                        <th class="text-end">Kritis <br> (KT)</th>
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
            Ket :
            <table>
                <tr>
                    <td class="text-start h6">MIN</td>
                    <td>:</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td class="text-start h6">MAJ</td>
                    <td>:</td>
                    <td>Major</td>
                </tr>
                <tr>
                    <td class="text-start h6">SR</td>
                    <td>:</td>
                    <td>Serius</td>
                </tr>
                <tr>
                    <td class="text-start h6">KT</td>
                    <td>:</td>
                    <td>Kritis</td>
                </tr>
                <tr>
                    <td class="text-start h6">OK</td>
                    <td>:</td>
                    <td>Tidak ada temuan</td>
                </tr>
                <tr>
                    <td class="text-start h6">TB</td>
                    <td>:</td>
                    <td>Tidak berlaku</td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered border-dark table-sm table-hover mt-3">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">HASIL DAN PENILAIAN</th>
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
        <div class="col-1">
            <table class="" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Auditor,</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center"> (……………………..)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-1">
            <table class="" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Auditee,</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px"></td>
                    </tr>
                    <tr>
                        <td class="text-center"> (……………………..)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @for ($i = 0; $i < 10; $i++)
            <div class="col-1">
                <table class="" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px"></td>
                        </tr>
                        <tr>
                            <td class="text-center"> (……………………..)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endfor

    </div>

</x-hccp-print>
