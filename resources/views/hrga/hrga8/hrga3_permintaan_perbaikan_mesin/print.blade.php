<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-12">
            <table width="100%" style="padding: 70px; font-size: 11px">
                <tr>
                    <td width="50%">Nama Mesin Proses Produksi</td>
                    <td width="2%">:</td>
                    <td>{{ $permintaan->item_mesin->nama_mesin }}</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td>{{ $permintaan->item_mesin->lokasi->lokasi ?? '-' }}</td>
                </tr>
                {{-- <tr>
                        <td>No Mesin</td>
                        <td>:</td>
                        <td>{{ $permintaan->item_mesin->no_identifikasi }}</td>
                    </tr> --}}
                <tr>
                    <td>Deadline</td>
                    <td>:</td>
                    <td>{{ tanggal($permintaan->deadline) }}</td>
                </tr>
                <tr>
                    <td>Diajukan oleh Bagian</td>
                    <td>:</td>
                    <td>{{ $permintaan->diajukan_oleh }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Deskripsi Masalah</td>
                    <td class="fw-bold">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="height: 60px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                        {{ $permintaan->deskripsi_masalah }}
                    </td>
                </tr>

            </table>
        </div>

        <div class="col-12 mt-3">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" colspan="2" width="33.33%">Diajukan Oleh:</th>

                        <th class="text-center" colspan="2" width="33.33%">Diterima Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 60px" colspan="2" class="align-middle text-center"> <span
                                style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>

                        <td style="height: 60px" colspan="2" class="align-middle text-center"> <span
                                style="opacity: 0.5;">(Ttd
                                &
                                Nama)</span></td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="2">(.................................) <br>Diisi Oleh User
                        </td>
                        @php
                            $ttd = $permintaan->item_mesin->kategori == 'mesin' ? 'KA. MAINTENANCE' : 'Ka. IT';
                        @endphp
                        <td class="text-center" colspan="2">({{ $ttd }})</td>
                    </tr>
                    <tr>
                        <td class="text-start" width="4%" style="border-right:none">Tanggal </td>
                        <td style="border-left:none">: {{ tanggal($permintaan->tanggal) }}</td>
                        <td class="text-start" width="4%" style="border-right:none">Tanggal </td>
                        <td style="border-left:none">: {{ tanggal($permintaan->tanggal) }}</td>
                    </tr>
                    <tr>
                        <td class="text-start" style="border-right:none">Pukul
                        </td>
                        <td class="text-start" style="border-left:none">
                            : {{ date('h:i A', strtotime($permintaan->waktu)) }}

                        </td>
                        <td class="text-start" style="border-right:none">Pukul
                        </td>
                        <td class="text-start" style="border-left:none">
                            : {{ date('h:i A', strtotime($permintaan->waktu)) }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>







        <div class="col-12 mt-4">
            <table width="100%" style="font-size: 11px">
                <tr>
                    <td width="50%" class="fw-bold">Detail Perbaikan yang Dilakukan</td>
                    <td width="2%" class="fw-bold">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="height: 60px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                        {{ $permintaan->detail_perbaikan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td width="50%" class="fw-bold">Serah Terima Hasil Perbaikan:</td>
                    <td width="2%" class="fw-bold">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td width="50%" class="fw-bold">Verifikasi User:</td>
                    <td width="2%" class="fw-bold">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="height: 90px; border: 1px solid black; border-radius: 10px; vertical-align: middle; text-align: center">
                        {{ $permintaan->verifikasi_user ?? '-' }}
                    </td>
                </tr>

            </table>
        </div>



        <div class="col-12 mt-2">
            <table width="100%" border="1" class=" table table-bordered border-dark" style="font-size: 11px">
                <tr>
                    <th class=" text-center" colspan="2">Diserahkan Oleh:</th>
                    <th class=" text-center" colspan="2">Diterima Oleh User:</th>
                </tr>
                <tr>
                    <td style="height: 60px" class="align-middle text-center" colspan="2">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>

                    <td style="height: 60px" class="align-middle text-center" colspan="2">
                        <span style="opacity: 0.5;">(Ttd & Nama)</span>
                    </td>

                </tr>
                <tr>
                    <td class="text-center" colspan="2">({{ $ttd }})</td>
                    <td class="text-center" colspan="2">(.................................) <br>Diisi Oleh User</td>
                </tr>
                @php
                    $update = date('Y-m-d', strtotime($permintaan->updated_at));
                @endphp
                <tr>
                    <td class="text-start" width="4%" style="border-right:none">Tanggal </td>
                    <td style="border-left:none">: {{ tanggal($update) }}</td>
                    <td class="text-start" width="4%" style="border-right:none">Tanggal </td>
                    <td style="border-left:none">: {{ tanggal($update) }}</td>
                </tr>
                <tr>
                    <td class="text-start" style="border-right:none">Pukul
                    </td>
                    <td class="text-start" style="border-left:none">
                        : {{ date('h:i A', strtotime($permintaan->updated_at)) }}

                    </td>
                    <td class="text-start" style="border-right:none">Pukul
                    </td>
                    <td class="text-start" style="border-left:none">
                        : {{ date('h:i A', strtotime($permintaan->updated_at)) }}

                    </td>
                </tr>
            </table>
        </div>

    </div>
</x-hccp-print>
