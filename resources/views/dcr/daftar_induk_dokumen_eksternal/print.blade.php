<x-hccp-print :title="$title" :dok="$dok">
    <div class="row">

        <div class="col-lg-12">
            <table class="table table-bordered border-dark" style="font-size: 10px">
                <thead>
                    <tr>
                        <th class="text-center dhead align-middle">No</th>
                        <th class="text-center dhead align-middle">Judul Dokumen</th>
                        <th class="text-center dhead align-middle">No Dokumen</th>
                        <th class="text-center dhead align-middle">Peninjauan terakhir <br> (setahun sekali)</th>
                        <th class="text-center dhead align-middle">Status Berlaku (Berlaku/ Tidak Berlaku)</th>


                    </tr>

                </thead>
                <tbody>
                    @foreach ($daftar as $d)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td>{{ $d->judul_dokumen }}</td>
                            <td>{{ $d->no_dokumen }}</td>
                            <td class="text-end">
                                {{ empty($d->peninjauan_terakhir) ? '-' : tanggal($d->peninjauan_terakhir) }}</td>
                            <td class="text-start">{{ $d->status }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>
        <div class="col-6" style="font-size: 10px">
            <p>Catatan :</p>
            <ol>
                <li>
                    Format yang berasal dari luar perusahaan, maka tidak dipertimbangkan untuk diberi identitas
                    penomoran pengendalian dokumen, mengingat bentuk format tersebut menjadi kewenangan pihak lain dalam
                    perubahannya.

                </li>
                <li>
                    Penggunaan format yang berasal dari pihak luar, tetap mengacu kepada ketentuan yang telah
                    dikeluarkan oleh sumber pembuatnya.

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
