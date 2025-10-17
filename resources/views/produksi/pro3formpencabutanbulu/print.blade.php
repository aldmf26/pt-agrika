<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
    <style>
        .cop_judul {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;

        }

        .shapes {
            border: 1px solid black;
            border-radius: 10px;
        }

        .cop_text {
            font-size: 12px;
            text-align: left;
            font-weight: normal;
            margin-top: 100px;

        }

        .dhead {
            background-color: #C0C0C0 !important;
        }

        .bg-black {
            background-color: black !important;
        }

        .border_atas {
            border-top: 1px solid black;
        }

        .border_bawah {
            border-bottom: 1px solid black;
        }

        .border_kanan {
            border-right: 1px solid black;
            padding-right: 6px;
        }

        .border_kiri {
            border-left: 1px solid black;
            padding-left: 6px;
        }

        .cop_bawah {
            margin-top: 0;
            /* Hilangkan jarak atas paragraf kedua */
            font-style: italic;
            font-size: 14px;
            font-weight: normal
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #41464b !important;
        }

        .table th,
        .table td {

            font-size: 15px;
        }

        .table-tes th,
        .table-tes td {

            font-size: 15px;
        }

        /* td {
            font-size: 12px
        }

        th {
            font-size: 12px
        } */

        .table-bawah th,
        .table-bawah td {
            border: 1px solid black;
            padding: 0.5rem;
            vertical-align: middle;
            text-align: center;
            white-space: nowrap;
            /* ⬅️ ini agar tidak membungkus teks */
        }

        thead th {
            text-transform: capitalize;
        }

        .print {
            display: none;
        }
    </style>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .print {
                display: inline !important;
            }

            .input {
                display: none !important;
            }
        }
    </style>


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-2 mt-4">
                <img style="width: 80px" src="{{ asset('img/logo.jpeg') }}" alt="">
            </div>
            <div class="col-6"></div>
            <div class="col-4 mt-4">
                <p class="" style="font-size: 10px">No Dok : FRM.PRO.01.03, Rev 00</p>
            </div>
            <div class="col-12 ">
                <p class="cop_judul">FORM PENCUCIAN AWAL, PENCABUTAN BULU & PENGERINGAN 1</p>
                <p class="cop_bawah text-center">Feather removal and Drying 1 Report</p>
            </div> --}}
            {{-- <div class="col-10">
                <table class="table-tes">
                    <tr>
                        <td>Hari/Tanggal <br> <span class="fst-italic">date</span> &nbsp;</td>
                        <td width="2%">: </td>
                        <td class="align-middle">&nbsp; {{ tanggal($tgl) }}</td>
                    </tr>
                    <tr>
                        <td>Regu &nbsp;<br> <span class="fst-italic">Team</span> </td>
                        <td width="2%">:</td>

                        <td class="align-middle"> &nbsp;{{ $pengawas }}</td>
                    </tr>
                </table>
            </div> --}}
            <div class="col-lg-12 ">

                <table class=" " style="font-size: 11px" width="100%">
                    <thead>

                        <tr>
                            <th class="align-top"><img style="width: 100px" src="{{ asset('img/logo.jpeg') }}"
                                    alt=""></th>
                            <th colspan="18">
                                <p class="cop_judul mt-3">FORM PENCUCIAN AWAL, PENCABUTAN BULU & PENGERINGAN 1</p>
                                <p class="cop_bawah text-center">Feather removal and Drying 1 Report</p>
                            </th>
                            <th class="align-top text-end text-nowrap">
                                <p class="float-end me-2 fw-normal" style="font-size: 14px; ">Dok.No.:
                                    FRM.PROS.01.02, Rev 00</p>
                            </th>

                        </tr>
                        <tr>
                            <td>Regu &nbsp;<br> <span class="fst-italic">Team</span> </td>

                            <td class="align-middle"> &nbsp;:{{ ucwords(strtolower($pengawas)) }}</td>
                            <td colspan="18"><button class="btn btn-primary float-end no-print"
                                    onclick="window.print()">Print</button></td>
                        </tr>

                        <tr class="table-bawah">
                            <th class=" align-middle text-center" rowspan="3">No</th>
                            <th rowspan="3" class=" align-middle text-center">Nama <br>Operator Cuci & <br> Cabut
                                <br><span class="fst-italic fw-lighter">Wash & removal Operator <br> name</span>
                            </th>
                            <th rowspan="3" class=" align-middle text-center">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot code</span> </th>
                            <th rowspan="3" class=" align-middle text-center">No Box</th>

                            <th rowspan="3" class=" align-middle text-center">Jenis<br> <span
                                    class="fst-italic fw-lighter">
                                    type</span>
                            </th>
                            <th rowspan="3" class=" align-middle text-center">Tanggal <br> terima</th>
                            <th class="text-center" colspan="2">Jumlah <br> diserahkan <br>
                                <span class="fst-italic fw-lighter">Quantity</span>
                            </th>
                            <th class="text-center" colspan="2">Kembali <br> <span
                                    class="fst-italic fw-lighter">Retur</span>
                            </th>
                            <th rowspan="3" class=" align-middle text-center">Tanggal <br> selesai</th>
                            <th class="text-center" colspan="4">Hasil Pencabutan & Drying
                                <br> <span class="fst-italic fw-lighter">Inspection results</span>
                            </th>
                            <th rowspan="3" class=" align-middle text-center">Waktu <br> mulai <br> drying</th>
                            <th rowspan="3" class=" align-middle text-center">Waktu <br> selesai <br> drying</th>
                            <th rowspan="3" class=" align-middle text-center">% Susut <br> (max susut <br> 30%)</th>
                            <th rowspan="3" class=" align-middle text-center">Ok/ <br> Not Ok</th>
                            <th rowspan="3" class=" align-middle text-center">Keterangan<br> <span
                                    class="fst-italic fw-lighter">Remarks</span>
                            </th>
                        </tr>
                        <tr class="table-bawah">
                            <th rowspan="2" class="text-center align-middle">Pcs</th>
                            <th rowspan="2" class="text-center align-middle">Gr</th>
                            <th rowspan="2" class="text-center align-middle">Pcs</th>
                            <th rowspan="2" class="text-center align-middle">Gr</th>
                            <th colspan="2" class="text-center align-middle">Ok</th>
                            <th colspan="2" class="text-center align-middle">Not Ok</th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center align-middle">Pcs</th>
                            <th class="text-center align-middle">Gr</th>
                            <th class="text-center align-middle">Pcs</th>
                            <th class="text-center align-middle">Gr</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cabut as $c)
                            @php
                                $sbw = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->where('nm_partai', 'like', '%' . $c['nm_partai'] . '%')
                                    ->first();

                                $edit = DB::table('form_pros_01_02_edit')
                                    ->where('no_box', $c['no_box'])
                                    ->where('tgl', $c['tgl'])
                                    ->first();

                            @endphp
                            <tr class="table-bawah">
                                <td class="text-end">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ ucwords(strtolower($c['nm_anak'])) }}</td>
                                <td class="text-end">{{ $sbw->no_invoice }}</td>
                                <td class="text-end">{{ $c['no_box'] }}</td>
                                <td class="text-start">{{ strtoupper($sbw->nama) }}</td>
                                <td class="text-end">{{ tanggal($c['tgl']) }}</td>
                                <td class="text-end">{{ number_format($c['pcs'], 0) }}</td>
                                <td class="text-end">{{ number_format($c['gr'], 0) }}</td>
                                <td class="text-end">0</td>
                                <td class="text-end">0</td>
                                <td class="text-end">{{ tanggal($c['tgl']) }}</td>
                                @php

                                    $gr_akhir = $c['pcs'] == 0 ? $c['gr_akhir'] : $c['gr_akhir'] / $c['pcs'];
                                    $gr_ok =
                                        $c['pcs'] == 0 ? $c['gr_akhir'] : $gr_akhir * ($c['pcs'] - $c['pcs_not_ok']);
                                    $gr_not_ok = $gr_akhir * $c['pcs_not_ok'];
                                @endphp
                                <td class="text-end">{{ number_format($c['pcs'] - $c['pcs_not_ok'], 0) }}</td>
                                <td class="text-end">{{ number_format($gr_ok, 0) }} </td>

                                <td class="text-end">{{ number_format($c['pcs_not_ok'], 0) }}</td>
                                <td class="text-end">{{ number_format($gr_not_ok, 0) }}</td>
                                <td class="text-end">
                                    <input type="time" class="form-control no-print form-edit"
                                        style="font-size: 12px" name="waktu_mulai_drying"
                                        data-no_box="{{ $c['no_box'] }}" data-tgl="{{ $c['tgl'] }}"
                                        value="{{ empty($edit) ? '17:00' : $edit->waktu_mulai_drying }}">

                                    <span class="print print-mulai">
                                        {{ $edit && $edit->waktu_mulai_drying ? date('h:i A', strtotime($edit->waktu_mulai_drying)) : '05:00 PM' }}
                                    </span>


                                <td class="text-end">
                                    <input type="time" class="form-control no-print form-edit"
                                        style="font-size: 12px" name="waktu_selesai_drying"
                                        data-no_box="{{ $c['no_box'] }}" data-tgl="{{ $c['tgl'] }}"
                                        value="{{ empty($edit) ? '05:00' : $edit->waktu_selesai_drying }}">
                                    <span class="print print-selesai">
                                        {{ $edit && $edit->waktu_selesai_drying ? date('h:i A', strtotime($edit->waktu_selesai_drying)) : '05:00 PM' }}
                                    </span>
                                </td>

                                <td class="text-end">{{ number_format((1 - $c['gr_akhir'] / $c['gr']) * 100, 0) }}
                                    %
                                </td>
                                <td class="text-start">
                                    @php
                                        $susut = (1 - $c['gr_akhir'] / $c['gr']) * 100;
                                    @endphp
                                    @if ($susut < 31)
                                        OK
                                    @else
                                        NOT OK
                                    @endif
                                </td>
                                <td class="text-start">
                                    @if ($susut >= 31)
                                        <input type="text" class="form-control no-print form-edit"
                                            style="font-size: 12px" name="keterangan"
                                            data-no_box="{{ $c['no_box'] }}" data-tgl="{{ $c['tgl'] }}"
                                            value="{{ empty($edit) ? 'Susut Melebihi Batas Standar Karena Banyak Pasir' : $edit->keterangan }}">
                                        <span class="print print-keterangan">
                                            {{ $edit && $edit->keterangan ? $edit->keterangan : 'Susut melebihi batas standar karena banyak pasir' }}
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="20">&nbsp;</th>
                        </tr>
                        <tr class="table-bawah">

                            <th style="border: none" colspan="15"></th>
                            <th class="text-center" colspan="3">Dibuat Oleh:</th>
                            <th class="text-center" colspan="2">Diperiksa Oleh:</th>
                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="15"></th>
                            <td colspan="3" style="height: 80px" class="text-center align-middle"><span
                                    style="opacity: 0.5;">(Ttd & Nama)</span></td>
                            <td colspan="2" style="height: 80px" class="text-center align-middle"><span
                                    style="opacity: 0.5;">(Ttd & Nama)</span></td>
                        </tr>
                        <tr class="table-bawah">
                            <th style="border: none" colspan="15"></th>
                            <td colspan="3" class="text-center align-middle">
                                (STAFF CABUT)
                            </td>
                            <td colspan="2" class="text-center align-middle">
                                (KA. CABUT)
                            </td>
                        </tr>

                    </tfoot>

                </table>
            </div>



        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script>
        window.print();
    </script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // === 1️⃣ Auto save input ke server pakai AJAX ===
            $('.form-edit').on('change', function() {
                let input = $(this);
                let no_box = input.data('no_box');
                let tgl = input.data('tgl');
                let row = input.closest('tr');

                // ambil semua field di baris itu
                let waktu_mulai_drying = row.find('input[name="waktu_mulai_drying"]').val();
                let waktu_selesai_drying = row.find('input[name="waktu_selesai_drying"]').val();
                let keterangan = row.find('input[name="keterangan"]').val();


                row.find('span.print-keterangan').text(keterangan || '');

                let spanMulai = row.find('span.print-mulai');
                if (waktu_mulai_drying) {
                    let [jam, menit] = waktu_mulai_drying.split(':').map(Number);
                    let start = new Date(0, 0, 0, jam, menit);
                    let ampm = start.getHours() >= 12 ? 'PM' : 'AM';
                    let jam12 = start.getHours() % 12 || 12;
                    jam12 = String(jam12).padStart(2, '0');
                    let formatted = `${jam12}:${String(menit).padStart(2, '0')} ${ampm}`;
                    spanMulai.text(formatted);
                }
                let spanSelesai = row.find('span.print-selesai');
                if (waktu_selesai_drying) {
                    let [jam, menit] = waktu_selesai_drying.split(':').map(Number);
                    let start = new Date(0, 0, 0, jam, menit);
                    let ampm = start.getHours() >= 12 ? 'PM' : 'AM';
                    let jam12 = start.getHours() % 12 || 12;
                    jam12 = String(jam12).padStart(2, '0');
                    let formatted = `${jam12}:${String(menit).padStart(2, '0')} ${ampm}`;
                    spanSelesai.text(formatted);
                }

                $.ajax({
                    url: "{{ route('produksi.3.edit') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_box: no_box,
                        tgl: tgl,
                        waktu_mulai_drying: waktu_mulai_drying,
                        waktu_selesai_drying: waktu_selesai_drying,
                        keterangan: keterangan,
                    },
                    success: function(res) {
                        console.log("Saved", res);
                        input.css('border', '2px solid green');
                        setTimeout(() => input.css('border', ''), 1000);
                    },
                    error: function(err) {
                        console.error(err);
                        input.css('border', '2px solid red');
                    }
                });
            });

            // === 2️⃣ Sembunyikan input saat print, ubah jadi teks ===
            let replaced = [];

            window.addEventListener("beforeprint", function() {
                replaced = []; // reset
                $('.form-edit').each(function() {
                    let val = $(this).val();
                    let span = $('<span>')
                        .text(val || '-')
                        .attr('class', $(this).attr('class'))
                        .css({
                            'font-size': $(this).css('font-size'),
                            'display': 'inline-block',
                            'min-width': '70px'
                        });
                    $(this).after(span);
                    replaced.push({
                        input: $(this),
                        span: span
                    });
                    $(this).hide();
                });
            });

            // === 3️⃣ Setelah print, tampilkan kembali inputnya ===
            window.addEventListener("afterprint", function() {
                replaced.forEach(function(pair) {
                    pair.input.show();
                    pair.span.remove();
                });
            });

            // === 4️⃣ Jalankan print otomatis setelah halaman siap ===

        });
    </script>



    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
