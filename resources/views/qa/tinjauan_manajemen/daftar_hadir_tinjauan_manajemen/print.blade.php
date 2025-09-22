<x-hccp-print title="DAFTAR HADIR TINJAUAN MANAJEMEN" dok="Dok.No.: FRM.QA.04.02, Rev.00">
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
            <table class="table table-bordered table-xs border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Divisi</th>
                        <th class="text-center">Tanda Tangan</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agenda as $p)
                        <tr>
                            <td class="text-end">{{ $loop->iteration }}</td>
                            <td class="">{{ ucwords(strtolower($p->nama)) }}</td>
                            <td class="">{{ $p->posisi }}</td>
                            <td class=""></td>
                            <td class=""></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <table class="table table-bordered border-dark" style="font-size: 11px">
                <thead>
                    <tr>
                        <th class="text-center" width="25%">Dibuat Oleh:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 80px" class="text-center align-middle">
                            <span style="opacity: 0.5;">(Ttd & Nama)</span>
                        </td>
                    </tr>
                    <tr>

                        <td class="text-center align-middle">
                            (FSTL)
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
</x-hccp-print>
