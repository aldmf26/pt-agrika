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
            font-size: 12px;
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
            font-size: 10px;
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

            font-size: 10px;
        }

        .table-tes th,
        .table-tes td {

            font-size: 10px;
        }

        .table-bawah th,
        .table-bawah td {
            border: 1px solid black;
            padding: 0.5rem;
            vertical-align: middle;

            white-space: nowrap;
            /* ⬅️ ini agar tidak membungkus teks */
        }

        thead th {
            text-transform: capitalize;
        }

        .print {
            display: none;
        }



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
            <div class="col-lg-12 mb-3">
                <table class=" " style="font-size: 11px" width="100%">
                    <thead>

                        <tr>
                            <th class="align-top"><img style="width: 80px" src="{{ asset('img/logo.jpeg') }}"
                                    alt=""></th>
                            <th colspan="11">
                                <p class="cop_judul mt-3">FORM PENCUCIAN NITRIT (CCP 1)</p>
                                <p class="cop_bawah text-center">Material cleaning and washing CCP 1</p>
                            </th>
                            <th class="align-top text-end text-nowrap">
                                <p class="float-end me-2 fw-normal" style="font-size: 12px; ">Dok.No.: FRM.PROS.01.03,
                                    Rev.00</p>
                            </th>

                        </tr>
                        <tr>
                            <td>Hari/Tanggal &nbsp;<br> <span class="fst-italic">Date</span> </td>
                            <td class="align-middle"> &nbsp;:{{ tanggal($tgl) }}</td>
                            <td>Regu &nbsp;<br> <span class="fst-italic">Team</span> </td>
                            <td class="align-middle" colspan="3"> &nbsp;:{{ $nama_regu }}</td>
                        </tr>

                        <tr class="table-bawah">
                            <th class="text-center align-middle" rowspan="2">No</th>
                            <th class=" align-middle text-center" rowspan="2">Nama Operator Cabut <br> <span
                                    class="fst-italic fw-lighter">Operator
                                    name</span></th>
                            <th class=" align-middle text-center" rowspan="2">Kode Batch/Lot <br> <span
                                    class="fst-italic fw-lighter">Batch/Lot
                                    code</span></th>
                            <th rowspan="3" class=" align-middle text-center">Jenis<br> <span
                                    class="fst-italic fw-lighter">
                                    type</span>
                            </th>
                            <th class=" align-middle text-center" rowspan="2">No Box</th>
                            <th class="text-center  " colspan="2">Jumlah <br> <span
                                    class="fst-italic fw-lighter">Quantity</span>
                            </th>
                            <th class="text-center " colspan="2">Jam Cuci <br> <span
                                    class="fst-italic fw-lighter">Washing
                                    time</span></th>
                            <th class=" align-middle text-center" rowspan="2">Total Waktu <br> <span
                                    class="fst-italic fw-lighter">Time</span></th>
                            <th class=" align-middle text-center" rowspan="2">Waktu Cuci Per Pcs <br> <span
                                    class="fst-italic fw-lighter">(30 detik/s)</span></th>
                            <th class=" align-middle text-center" rowspan="2">Nama Operator Pencucian <br> CCP 1<br>
                                <span class="fst-italic fw-lighter">Cleaner name CCP 1</span>
                            </th>
                            <th class=" align-middle text-center" rowspan="2">Keterangan<br> <span
                                    class="fst-italic fw-lighter">Remarks</span></th>
                        </tr>
                        <tr class="table-bawah">
                            <th class="text-center">Pcs</th>
                            <th class="text-center">Gr</th>
                            <th class="text-center">Awal/Mulai</th>
                            <th class="text-center">Akhir/Stop</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        @foreach ($pencucian as $c)
                            @php

                                $sbw = DB::table('sbw_kotor')
                                    ->leftJoin('grade_sbw_kotor', 'sbw_kotor.grade_id', '=', 'grade_sbw_kotor.id')
                                    ->where('nm_partai', 'like', '%' . $c['nm_partai'] . '%')
                                    ->first();

                                $namaAnak = strtolower($c['nm_anak']);
                                if (!isset($counterNamaAnak[$namaAnak])) {
                                    $counterNamaAnak[$namaAnak] = 0;
                                }
                                $counterNamaAnak[$namaAnak]++;

                                $pcs = (int) ($c['pcs'] == 0 ? round($c['gr'] / 6, 0) : $c['pcs']);

                                $edit = DB::table('form_pros_01_03_edit')
                                    ->where('no_box', $c['no_box'])
                                    ->where('tgl', $tgl)
                                    ->first();

                                $defaultHour = 14 + ($counterNamaAnak[$namaAnak] - 1);

                                if ($nama_regu == 'Nurul Huda' || $nama_regu == 'Siti Patimah') {
                                    // Jam 14:00
                                    $defaultJamMulai = sprintf('%02d:00', $defaultHour);
                                } elseif ($nama_regu == 'Erna' || $nama_regu == 'Norjanah') {
                                    // Jam 14:30
                                    $defaultJamMulai = sprintf('%02d:30', $defaultHour);
                                } else {
                                    // === INI YANG KAKAK MINTA (JAM 15:00) ===

                                    // Opsi A: Jika ingin otomatis ikut urutan (15:00, 16:00, dst)
                                    // Kita tambah 1 karena basis defaultHour adalah 14
                                    $defaultJamMulai = sprintf('%02d:00', $defaultHour + 1);

                                    // Opsi B: Jika ingin SELALU jam 15:00 (mati/hardcode) tidak peduli jumlah box
                                    // $defaultJamMulai = '15:00';
                                }

                                // "14:00"

                                // Ambil nilai jam mulai (bisa "17:00", "17:00:00", atau datetime)
                                $rawJamMulai =
                                    $edit && !empty($edit->waktu_mulai) ? $edit->waktu_mulai : $defaultJamMulai;

                                // Gunakan Carbon::parse() agar fleksibel terhadap berbagai format
                                try {
                                    $startTime = Carbon::parse($rawJamMulai);
                                } catch (\Exception $e) {
                                    // fallback ke default jika parse gagal
                                    $startTime = Carbon::createFromFormat('H:i', $defaultJamMulai);
                                }

                                // Hitung endTime: tambah minutes = pcs (sesuai logikamu)
                                $endTime = $startTime->copy()->addMinutes($pcs);
                                $diffInMinutes = $startTime->diffInMinutes($endTime);

                                // Untuk output ke value input (format 24h H:i)
                                $startValue = $startTime->format('H:i'); // dipakai di <input type="time">
                                $endValue = $endTime->format('H:i');
                            @endphp

                            <tr class="table-bawah">
                                <td class="text-end">{{ $loop->iteration }}</td>
                                <td class="">{{ ucwords(strtolower($c['nm_anak'])) }}</td>
                                <td class="text-end">{{ $sbw->no_invoice ?? '-' }}</td>
                                <td class="text-start">{{ $sbw->nama ?? '-' }}</td>
                                <td class="text-end">{{ $c['no_box'] }}</td>
                                <td class="text-end">{{ number_format($c['pcs'], 0) }}</td>
                                <td class="text-end">{{ number_format($c['gr'], 0) }}</td>

                                {{-- Jam mulai --}}
                                <td class="text-center">
                                    <input type="time" class="form-control no-print form-edit"
                                        style="font-size: 10px" value="{{ $startTime->format('H:i') }}"
                                        data-no_box="{{ $c['no_box'] }}" data-tgl="{{ $tgl }}"
                                        name="waktu_mulai">
                                    <span class="print print-mulai">{{ $startTime->format('h:i A') }}</span>
                                </td>

                                {{-- Jam akhir otomatis --}}
                                <td class="text-center">
                                    <span class="print-only">{{ $endTime->format('h:i A') }}</span>
                                    <input type="hidden" name="waktu_selesai" value="{{ $endTime->format('H:i') }}">
                                </td>

                                <td class="text-end">{{ $diffInMinutes }} menit</td>
                                <td class="text-end">30</td>
                                <td>{{ $nama_regu }}</td>
                                <td class="text-start">
                                    <input type="text" class="form-control no-print form-edit" name="keterangan"
                                        data-no_box="{{ $c['no_box'] }}" data-tgl="{{ $c['tgl'] }}"
                                        value="{{ $edit->keterangan ?? '' }}">
                                    <span class="print print-keterangan">{{ $edit->keterangan ?? '' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>



                    </tbody>


                </table>
            </div>
            <div class="col-7"></div>
            <div class="col-5">
                <table class="table table-bordered" style="font-size: 11px">
                    <thead>
                        <tr>
                            <th class="text-center" width="33.33%">Dibuat Oleh:</th>
                            <th class="text-center" width="33.33%">Diperiksa Oleh:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="pengawasTtd($nama_regu)->karyawan_id_dari_api" />
                                @php
                                    $pegawai = App\Models\DataPegawai::where('nama', $nama_regu)

                                        ->whereNotIn('posisi', ['staff cabut', 'staff cetak', 'kepala qc'])
                                        ->first();
                                @endphp
                            </td>
                            <td style="height: 80px" class="text-center align-middle">
                                <x-ttd-barcode :id_pegawai="whereTtd('KEPALA CABUT')" />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">
                                ({{ strtoupper($pegawai->posisi) }})
                            </td>
                            <td class="text-center align-middle">
                                (KEPALA CABUT)
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>



        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('.form-edit').on('change', function() {
            let input = $(this);
            let no_box = input.data('no_box');
            let tgl = input.data('tgl');
            let row = input.closest('tr');

            // ambil semua field di baris itu
            let waktu_mulai = row.find('input[name="waktu_mulai"]').val();
            let pcs = parseInt(row.find('td:nth-child(5)').text().replace(/\D/g, '')) || 0;
            let waktu_selesai_input = row.find('input[name="waktu_selesai"]');
            let waktu_selesai_print = row.find('.print-only');

            let keterangan = row.find('input[name="keterangan"]').val();

            // === 🔹 update span.print keterangan ===
            if (input.attr('name') === 'keterangan') {
                row.find('span.print-keterangan').text(keterangan || '');
            }

            // === 🔹 Update span.print (jam mulai) secara real-time ===
            let spanMulai = row.find('span.print-mulai');
            if (waktu_mulai) {
                let [jam, menit] = waktu_mulai.split(':').map(Number);
                let start = new Date(0, 0, 0, jam, menit);
                let ampm = start.getHours() >= 12 ? 'PM' : 'AM';
                let jam12 = start.getHours() % 12 || 12;
                jam12 = String(jam12).padStart(2, '0');
                let formatted = `${jam12}:${String(menit).padStart(2, '0')} ${ampm}`;
                spanMulai.text(formatted);
            }

            // === 🔹 Hitung waktu selesai otomatis ===
            if (waktu_mulai && pcs > 0) {
                let [jam, menit] = waktu_mulai.split(':').map(Number);
                let start = new Date(0, 0, 0, jam, menit);
                start.setMinutes(start.getMinutes() + pcs);

                let hh = String(start.getHours()).padStart(2, '0');
                let mm = String(start.getMinutes()).padStart(2, '0');
                let waktu_selesai = `${hh}:${mm}`;
                waktu_selesai_input.val(waktu_selesai);

                // tampilkan di print-only (AM/PM)
                let ampm = start.getHours() >= 12 ? 'PM' : 'AM';
                let jam12 = start.getHours() % 12 || 12;
                jam12 = String(jam12).padStart(2, '0');
                waktu_selesai_print.text(`${jam12}:${mm} ${ampm}`);
            }

            // === 🔹 Simpan ke server via AJAX ===
            $.ajax({
                url: "{{ route('produksi.4.edit') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_box: no_box,
                    tgl: tgl,
                    waktu_mulai: waktu_mulai,
                    waktu_selesai: waktu_selesai_input.val(),
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
