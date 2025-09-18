<x-hccp-print :title="$title" :dok="$dok">





    <div class="row">
        @php
            $validLimbah = ['Organik', 'Non Organik'];

            // Tentukan mana yang harus dicoret berdasarkan kategori
            $limbahDicoret = strtolower($kategori) === 'terjadwal' ? 'Organik' : 'Non Organik';
        @endphp
        <div class="col-lg-12" style="font-size: 11px">
            Jenis Limbah:
            @foreach ($validLimbah as $limbah)
                @if (strtolower($limbah) === strtolower($limbahDicoret))
                    <s>{{ $limbah }}</s>
                @else
                    {{ $limbah }}
                @endif
                @if (!$loop->last)
                    /
                @endif
            @endforeach
            <br>
            {{-- Bulan : {{ $nm_bulan }} --}}
        </div>

        <div class="col-sm-12 col-lg-12">
            <table class="table table-bordered border-dark table-sm" style="font-size: 10px;">
                <thead>
                    @if ($kategori == 'terjadwal')
                        <tr>
                            <th class="text-center align-middle">Tanggal</th>
                            <th class=" align-middle text-center">Jam Checklist</th>
                            <th class=" align-middle text-center">Checklist (✓)</th>
                            <th class=" align-middle text-center">Paraf <br> Petugas</th>
                            <th class=" align-middle text-center">Keterangan</th>
                        </tr>
                    @else
                        <tr>
                            <th class="align-middle text-center">Tanggal</th>
                            <th class=" align-middle text-center">Jam</th>
                            <th class=" align-middle text-center">Berat</th>
                            <th class=" align-middle text-center">Paraf <br> Petugas</th>
                            <th class=" align-middle text-center">Keterangan</th>
                        </tr>
                    @endif

                </thead>
                <tbody>
                    @foreach ($pembuangan as $p)
                        @if ($kategori == 'terjadwal')
                            <tr>
                                <td class="text-end">{{ tanggal($p->tgl) }}</td>
                                <td class="text-end">{{ date('h:i A', strtotime($p->jam_cek)) }}</td>
                                <td class="text-center">
                                    @if ($p->tgl <= date('Y-m-d'))
                                        ✓
                                    @else
                                    @endif
                                </td>
                                <td></td>
                                <td>{{ $p->katerangan }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-end">{{ tanggal($p->tgl) }}</td>
                                <td class="text-end">{{ date('h:i A', strtotime($p->jam_cek)) }}</td>
                                <td class="text-end">
                                    {{ $p->berat }}
                                </td>
                                <td></td>
                                <td>{{ ucfirst(strtolower($p->katerangan)) }} </td>
                            </tr>
                        @endif
                    @endforeach



                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-lg-4" style="font-size: 9px">
            <span>Ket : </span> <br>
            <span>
                @if ($kategori == 'terjadwal')
                    Jika sampah organik / non organik tidak diangkut maka dipastikan tidak tercecer dan tidak mengundang
                    hama
                @else
                    Bulu akan dikumpulkan terlebih dahulu, akan dibakar jika sudah benar-benar kering. Pembakaran
                    dlakukan setiap jam 05.00 pm.
                @endif

            </span>
        </div>
        <div class="col-sm-6 col-lg-4">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                        <th class="text-center" width="33.33%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 60px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>

                        <td style="height: 60px" class="align-middle text-center"> <span style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">(STAFF HRGA)</td>
                        <td class="text-center">(KA. HRGA)</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    </x-theme.hccp_print>
