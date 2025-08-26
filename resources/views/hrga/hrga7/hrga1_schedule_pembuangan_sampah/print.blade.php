<x-hccp-print :title="$title" :dok="$dok">
    @php
        // Daftar jenis limbah yang valid
        $validLimbah = ['Organik', 'Non Organik'];
    @endphp

    Jenis Limbah:
    @foreach ($validLimbah as $limbah)
        @if (strtolower($jenis_limbah) !== strtolower($limbah))
            <s>{{ $limbah }}</s>
        @else
            {{ $limbah }}
        @endif
        @if (!$loop->last)
            /
        @endif
    @endforeach
    <br>
    Bulan : {{ $nm_bulan }}


    <div class="row">

        <div class="col-sm-12 col-lg-12">
            <table class="table table-bordered border-dark table-sm" style="font-size: 10px;">
                <thead>
                    @if ($kategori == 'terjadwal')
                        <tr>
                            <th class="text-end align-middle">TANGGAL</th>
                            <th class=" align-middle">JAM CHECKLIST</th>
                            <th class=" align-middle">CHECKLIST (✓)</th>
                            <th class=" align-middle">PARAF <br> PETUGAS</th>
                            <th class=" align-middle">KETERANGAN</th>
                        </tr>
                    @else
                        <tr>
                            <th class="text-end align-middle">TANGGAL</th>
                            <th class=" align-middle">JAM</th>
                            <th class=" align-middle">BERAT</th>
                            <th class=" align-middle">PARAF <br> PETUGAS</th>
                            <th class=" align-middle">KETERANGAN</th>
                        </tr>
                    @endif

                </thead>
                <tbody>
                    @foreach ($pembuangan as $p)
                        @if ($kategori == 'terjadwal')
                            <tr>
                                <td class="text-end">{{ date('d', strtotime($p->tgl)) }}</td>
                                <td>{{ date('h:i A', strtotime($p->jam_cek)) }}</td>
                                <td>
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
                                <td class="text-end">{{ date('d', strtotime($p->tgl)) }}</td>
                                <td>{{ date('h:i A', strtotime($p->jam_cek)) }}</td>
                                <td>
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
        <div class="col-sm-6 col-lg-4">
            <span>Ket : </span> <br>
            <span>
                @if ($kategori == 'terjadwal')
                    Jika sampah organik / non organik tidak diangkut maka dipastikan tidak tercecer dan mengundang
                    hama
                @else
                    Bulu akan dikumpulkan terlebih dahulu, akan dibakar jika sudah benar-benar kering. Pembakaran
                    dlakukan setiap jam 17.00 wita.
                @endif

            </span>
        </div>
        <div class="col-sm-6 col-lg-4">
            <table style="border: 1px solid black; border-collapse: collapse; width: 100%; margin-top: 10px;">
                <tr>
                    <td style="border: 1px solid black; text-align: center;">Diperiksa Oleh:</td>
                    <td style="border: 1px solid black; text-align: center;">Diketahui Oleh:</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; text-align: center; height: 80px; vertical-align: bottom;">[SPV.
                        GA-IR]</td>
                    <td style="border: 1px solid black; text-align: center; vertical-align: bottom;">[KA.HRGA]</td>
                </tr>
            </table>
        </div>
    </div>

    </x-theme.hccp_print>
