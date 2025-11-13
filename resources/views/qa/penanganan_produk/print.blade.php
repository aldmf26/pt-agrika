<x-hccp-print :title="$title" :dok="$dok">

    <style>
        table {
            font-family: 'arial';
        }

        .form-table {
            width: 100%;
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 11px;
        }

        .form-table td {
            padding: 8px 5px;
            vertical-align: top;
        }

        .form-table tr {
            border-bottom: 1px solid #000;
        }

        .no-col {
            width: 30px;
            text-align: center;
        }

        .label-col {
            width: 150px;
        }

        .colon-col {
            width: 20px;
        }

        .value-col {
            border-bottom: 1px solid #000;
            min-height: 25px;
        }

        .penanganan-row {
            vertical-align: top;
        }

        .penanganan-content {
            padding: 0;
        }

        .penanganan-line {
            border-bottom: 1px solid #000;
            min-height: 25px;
            padding: 3px 0;
            line-height: 1.8;
        }

        .penanganan-line:last-child {
            border-bottom: none;
        }

        .signature-table {
            border-collapse: collapse;
            font-size: 11px;
        }

        .signature-table th,
        .signature-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .signature-space {
            height: 80px;
            vertical-align: middle;
        }

        .date-text {
            text-align: right;
            margin: 10px 0;
            font-size: 11px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <table class="form-table">
                <!-- Row 1: Tanggal Kejadian -->
                <tr>
                    <td class="no-col">1.</td>
                    <td class="label-col">Tanggal Kejadian</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">{{ tanggal($datas->tgl_kejadian) }}</td>
                </tr>

                <!-- Row 2: Sumber/Penyebab -->
                <tr>
                    <td class="no-col">2.</td>
                    <td class="label-col">Sumber/Penyebab</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">{{ $datas->sumber_penyebab }}</td>
                </tr>

                <!-- Row 3: Nama Produk -->
                <tr>
                    <td class="no-col">3.</td>
                    <td class="label-col">Nama Produk</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">{{ ucfirst(strtolower($datas->rwb->grade->nama)) }}</td>
                </tr>

                <!-- Row 4: Kode Produksi -->
                <tr>
                    <td class="no-col">4.</td>
                    <td class="label-col">Kode Produksi</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">{{ $datas->kode_produksi }}</td>
                </tr>

                <!-- Row 5: Jumlah Produk -->
                <tr>
                    <td class="no-col">5.</td>
                    <td class="label-col">Jumlah Produk</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">{{ $datas->jumlah_produk }} GR</td>
                </tr>

                <!-- Row 6: Status -->
                <tr>
                    <td class="no-col">6.</td>
                    <td class="label-col">Status</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">
                        {!! strtolower($datas->status) != 'hold' ? '<s>Hold</s>' : 'Hold' !!} /
                        {!! strtolower($datas->status) != 'reject' ? '<s>Reject</s>' : 'Reject' !!} /
                        {!! strtolower($datas->status) != 'rework' ? '<s>Rework</s>' : 'Rework' !!}
                    </td>
                    {{-- <td class="value-col">{{ $datas->status }}</td> --}}
                </tr>

                <!-- Row 7: Penanganan -->
                <tr class="penanganan-row">
                    <td class="no-col">7.</td>
                    <td class="label-col">Penanganan</td>
                    <td class="colon-col">:</td>
                    <td class="penanganan-content">
                        @php
                            $lines = explode("\n", $datas->penanganan);
                            $totalLines = max(count($lines), 10); // Minimal 10 garis
                        @endphp
                        @for ($i = 0; $i < $totalLines; $i++)
                            <div class="penanganan-line">
                                {{ $i < count($lines) ? trim($lines[$i]) : '' }}&nbsp;
                            </div>
                        @endfor
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <span class="float-end text-end table-xs">Tanggal : {{ tanggal($datas->created_at) }} </span>
    <br>

    <div class="mt-2 row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="25%">Dibuat Oleh:</th>
                        <th class="text-center" width="25%">Diketahui Oleh:</th>
                        <th class="text-center" width="25%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('Kepala QC')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('Kepala Lab & FSTL')" />
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <x-ttd-barcode :id_pegawai="whereTtd('Kepala direktur')" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            (KEPALA QC)
                        </td>
                        <td class="text-center align-middle">
                            (Kepala Lab & FSTL)
                        </td>
                        <td class="text-center align-middle">
                            (KEPALA DIREKTUR)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
