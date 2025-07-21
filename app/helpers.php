<?php

use Carbon\Carbon;

if (!function_exists('tanggal')) {
    function tanggal($tgl)
    {
        $date = explode("-", $tgl);

        $bln  = $date[1];

        $bulanArray = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $bulan = $bulanArray[$bln] ?? '';

        $tanggal = $date[2];
        $tahun   = $date[0];

        $strTanggal = "$tanggal $bulan $tahun";
        return $strTanggal;
    }
}

if (!function_exists('ddmmyyy_')) {
    function ddmmyyy($tgl)
    {
        $date = explode("-", $tgl);
        return "{$date[2]}-{$date[1]}-{$date[0]}";
    }
}

if (!function_exists('jam')) {
    function jam($jam)
    {
        $jam = Carbon::parse($jam)->format('h:i A');
        return $jam;
    }
}
if (!function_exists('umur')) {
    function umur($tgl)
    {
        $tgl = Carbon::parse($tgl)->age;
        return $tgl;
    }
}
if (!function_exists('formatTglGaji')) {
    function formatTglGaji($bulan, $tahun)
    {
        return date('M Y', strtotime($tahun . '-' . $bulan . '-01'));
    }
}