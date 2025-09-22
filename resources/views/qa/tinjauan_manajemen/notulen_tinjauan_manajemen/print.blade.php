<x-hccp-print title="NOTULEN TINJAUAN MANAJEMEN" dok="Dok.No.: FRM.QA.04.03, Rev.00">
    <div class="row">
        <div class="col-12">
            <table class="table-xs">
                <tr>
                    <td width="20%">Tanggal</td>

                    <td> : {{ tanggal($tanggal) }}</td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12">
            <br>
            <table class="table table-bordered table-xs border-dark">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class=" text-center align-middle">Agenda</th>
                        <th class=" text-center align-middle">Hasil Pembahasan</th>
                        <th class=" text-center align-middle">Action Plan</th>
                        <th class=" text-center align-middle">PIC</th>
                        <th class=" text-center align-middle" width="70">Due Date</th>
                        <th class=" text-center align-middle">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notulen as $n)
                        <tr>
                            <td class="align-middle text-end">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $n->agenda ?? '-' }}</td>
                            <td class="align-middle">{!! nl2br(e($n->hasil_pembahasan ?? '-')) !!}</td>
                            <td class="align-middle">{{ $n->action_plan ?? '-' }}</td>
                            <td class="align-middle">{{ $n->pic ?? '-' }}</td>
                            <td class="align-middle">{{ $n->duedate ?? '-' }}</td>
                            <td class="align-middle">{{ $n->status ?? '-' }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="25%">Dibuat Oleh:</th>
                        <th class="text-center" width="25%">Diketahui Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>

                        <td class="text-center align-middle">
                            (FSTL)
                        </td>
                        <td class="text-center align-middle">
                            (DIREKTUR UTAMA)
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-hccp-print>
