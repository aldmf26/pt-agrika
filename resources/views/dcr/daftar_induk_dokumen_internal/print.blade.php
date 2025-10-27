<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 9px">
                <thead>
                    <tr>
                        <th class="text-center dhead align-middle" rowspan="2">No</th>
                        <th class="text-center dhead align-middle" rowspan="2">Nama Divisi</th>
                        <th class="text-center dhead align-middle" rowspan="2">Pic</th>
                        <th class="text-center dhead align-middle" rowspan="2">Judul Dokumen</th>
                        <th class="text-center dhead align-middle" rowspan="2">No Dokumen</th>
                        <th class="text-center dhead align-middle" colspan="11">Revisi Terakhir Yang Berlaku</th>
                    </tr>
                    <tr>
                        <th class="text-center dhead align-middle">Rev.00</th>
                        <th class="text-center dhead align-middle">Rev.01</th>
                        <th class="text-center dhead align-middle">Alasan Perubahan</th>
                        <th class="text-center dhead align-middle">Rev.02</th>
                        <th class="text-center dhead align-middle">Alasan Perubahan</th>
                        <th class="text-center dhead align-middle">Rev.03</th>
                        <th class="text-center dhead align-middle">Alasan Perubahan</th>
                        <th class="text-center dhead align-middle">Rev.04</th>
                        <th class="text-center dhead align-middle">Alasan Perubahan</th>
                        <th class="text-center dhead align-middle">Rev.05</th>
                        <th class="text-center dhead align-middle">Alasan Perubahan</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftar as $d)
                        <tr>
                            <td class="text-end align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $d->nama_divisi }}</td>
                            <td class="align-middle">{{ $d->pic }}</td>
                            <td class="text-nowrap align-middle">{{ $d->judul }}</td>
                            <td class="text-nowrap align-middle">{{ $d->no_dokumen }}</td>
                            @php
                                $rev = date('Y-m-d', strtotime($d->updated_at));
                            @endphp
                            <td class="text-end text-nowrap align-middle">{{ tanggal($rev) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>
        <div class="col-6" style="font-size: 9px">
            <p>Catatan :</p>
            <ol>
                <li>
                    Format yang berasal dari luar perusahaan, maka tidak dipertimbangkan untuk diberi identitas
                    penomoran
                    pengendalian dokumen, mengingat bentuk format tersebut menjadi kewenangan pihak lain dalam
                    perubahannya.
                </li>
                <li>
                    Penggunaan format yang berasal dari pihak luar, tetap mengacu kepada ketentuan yang telah
                    dikeluarkan
                    oleh sumber pembuatnya.
                </li>
                <li>
                    Penandatanganan Daftar Induk Dokumen Internal ini juga sebagai tanda pengesahan format Kerja/ Form
                    yang terdaftar, namun terbatas hanya, dalam Daftar Induk Dokumen Internal ini.
                </li>

            </ol>

        </div>
        <div class="col-6">
            <table class="border-dark table table-bordered" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                        <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        <th class="text-center" width="33.33%">Disetujui Oleh:</th>
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
                        <td class="text-center">( STAFF HRGA )</td>
                        <td class="text-center">( KA. HRGA )</td>
                        <td class="text-center">( OPERATIONAL MANAGER )</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
