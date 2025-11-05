<x-hccp-print :title="$title" :dok="$dok">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .cop_judul {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 15px;
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

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 7px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .header-info table {
            width: 100%;
        }

        .header-info td {
            padding: 3px;
        }

        .print {
            display: none;
            /* disembunyikan saat layar biasa */
        }

        .input {
            font-size: 8px
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
    <div class="row">

        <div class="header-info col-lg-12">

            <table style="font-size: 10px">
                <tr>
                    <td colspan="2">BERI TANDA (&#10004;) UNTUK TIAP KOLOM YANG SESUAI STANDAR DAN TANDA (&#10008;)
                        UNTUK TIAP
                        KOLOM
                        YANG
                        TIDAK SESUAI STANDAR</td>
                </tr>
                <tr>
                    <td width="15%">Kendaraan Milik </td>
                    <td>: Internal / <span class="text-decoration-line-through">Ekspedisi</span></td>

                </tr>
                <tr>
                    <td>Nomor Kendaraan </td>
                    <td>: DA 1850 I</td>

                </tr>
                <tr>
                    <td>Pengemudi</td>
                    <td>: Maulidan</td>
                </tr>

            </table>
        </div>


    </div>
    <table class="table table-bordered">
        <tr>
            <td colspan="2">Tanggal</td>
            @php
                $jumlahData = count($checklist);
                $maxKolom = 9;
            @endphp

            @foreach ($checklist as $c)
                <td class="text-end align-middle" width="8%" colspan="2">{{ tanggal($c['tgl']) }}
                </td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" width="8%" colspan="2"></td>
            @endfor

        </tr>
        <tr>
            <td colspan="2">Jam Penataan Di mobil</td>


            @foreach ($checklist as $c)
                @php
                    $jam = DB::table('checklist_kendaraan_fg')->where('tgl', $c['tgl'])->first();
                @endphp
                <td class="text-end align-middle" width="8%" colspan="2">
                    <input type="time" name="jam_pengantaran[]"
                        value="{{ empty($jam->jam_pengantaran) ? '14:00' : $jam->jam_pengantaran }}"
                        class="form-control input jam_pengantaran" tgl="{{ $c['tgl'] }}">


                    <span class="print jam_update" data-tgl="{{ $c['tgl'] }}">
                        {{ empty($jam->jam_pengantaran)
                            ? date('h:i A', strtotime('14:00:00'))
                            : date('h:i A', strtotime($jam->jam_pengantaran)) }}
                    </span>

                </td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" width="8%" colspan="2"></td>
            @endfor
        </tr>
        <tr>
            <td colspan="2">Tujuan / Ekspedisi</td>
            @foreach ($checklist as $c)
                <td class="text-end align-middle" width="8%" colspan="2">HK / Garuda Kargo</td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" width="8%" colspan="2"></td>
            @endfor
        </tr>
        <tr>
            <td colspan="100"></td>
        </tr>
        <tr>
            <th class="text-center">No</th>
            <th>Kondisi Kendaraan</th>


            @foreach ($checklist as $c)
                <th class="text-center">WH</th>
                <th class="text-center">QA</th>
            @endforeach
            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <th class="text-center">WH</th>
                <th class="text-center">QA</th>
            @endfor



        </tr>
        @foreach ($kondisi as $k)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class=" text-nowrap">{{ $k->kondisi }}</td>
                @foreach ($checklist as $c)
                    <td class="text-center">&#10004;</td>
                    <td class="text-center">&#10004;</td>
                @endforeach

                @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                @endfor

            </tr>
        @endforeach
        <tr>
            <td></td>
            <th>KEPUTUSAN DIPAKAI : Ya (Y) atau TIDAK (T)</th>
            @foreach ($checklist as $c)
                <td class="text-center" colspan="2">YA</td>
            @endforeach

            @for ($i = 0; $i < $maxKolom - $jumlahData; $i++)
                <td class="text-center" colspan="2"></td>
            @endfor

        </tr>
        <tr>
            <td></td>
            <th class="align-middle" style="font-size: 12px !important">Paraf Pemeriksa</th>
            @for ($i = 0; $i < $maxKolom; $i++)
                <td class="text-center" style="height: 30px"></td>
                <td class="text-center" style="height: 30px"></td>
            @endfor

        </tr>


    </table>

    <span style="font-size: 7px">
        NOTE : JIKA KONDISI KENDARAAN MEMENUHI SEMUA KETENTUAN TERSEBUT DIATAS DAN KEPUTUSANNYA DIPAKAI MAKA BERIKAN
        TANDA <b>(&#10004;)</b>
        DAN TANDA <b>(&#10008;)</b> JIKA KENDARAAN TERNYATA TIDAK
        DAPAT DIPAKAI / DITOLAK
        LIHAT DETAIL KETERANGAN SETIAP KETENTUAN KONDISI KENDARAAN
    </span>
    <div>
        <table width="100%">
            <tr>
                <th width="60%" style="border: 1px solid black; " class="align-top">
                    KOMENTAR:
                    {{-- {{ $checklist->komentar }} --}}
                </th>
                <td width="25%">

                </td>
                <td style="width: 15%">
                    <table class="border-dark table table-bordered" style="font-size: 11px">
                        <thead>
                            <tr>
                                <th class="text-center" width="33.33%">Dibuat Oleh:</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="height: 45px" class="align-middle text-center">
                                    <span style="opacity: 0.5;">(Ttd & Nama)</span>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center">(KEPALA EKSPEDISI & EKSPORT)</td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.jam_pengantaran').change(function(e) {
                e.preventDefault();
                var tgl = $(this).attr('tgl');
                var jam = $(this).val(); // contoh: 14:00

                $.ajax({
                    type: "GET",
                    url: "/update-jam-kedatangan",
                    data: {
                        tgl: tgl,
                        jam: jam,
                        kategori: 'jam_pengantaran',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                            // ubah ke format 12 jam
                            var jamFormatted = formatJam12(jam);
                            $('.jam_update[data-tgl="' + tgl + '"]').text(jamFormatted);
                        } else {
                            alert('Gagal update.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });
            });

            // fungsi ubah dari 24 jam ke 12 jam (ex: 14:00 → 02:00 PM)
            function formatJam12(time24) {
                if (!time24) return '';
                var [hour, minute] = time24.split(':');
                hour = parseInt(hour, 10);
                var ampm = hour >= 12 ? 'PM' : 'AM';
                hour = hour % 12 || 12;
                return `${String(hour).padStart(2, '0')}:${minute} ${ampm}`;
            }


            // $('.no_kendaraan').keyup(function(e) {
            //     alert('dsa')
            // });
            $('.no_kendaraan').keyup(function(e) {
                e.preventDefault();

                var partai = $(this).attr('partai');
                var no_kendaraan = $(this).val();
                $.ajax({
                    type: "Get",
                    url: "/update-jam-kedatangan",
                    data: {
                        partai: partai,
                        no_kendaraan: no_kendaraan,
                        kategori: 'no_kendaraan',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                        } else {
                            alert('Gagal update.');
                        }
                        $('.no_kendaraan_update[data-partai="' + partai + '"]').text(
                            no_kendaraan);

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });

            });
            $('.driver').keyup(function(e) {
                e.preventDefault();

                var partai = $(this).attr('partai');
                var driver = $(this).val();

                $('.driver_update[data-partai="' + partai + '"]').text(driver);
                $.ajax({
                    type: "Get",
                    url: "/update-jam-kedatangan",
                    data: {
                        partai: partai,
                        driver: driver,
                        kategori: 'driver',
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log('Jam kedatangan berhasil diperbarui.');
                        } else {
                            alert('Gagal update.');
                        }

                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });

            });
        });
    </script>

</x-hccp-print>
