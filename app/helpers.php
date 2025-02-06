<?php

use Carbon\Carbon;

if (!function_exists('tanggal')) {
    function tanggal($tgl)
    {
        $date = explode("-", $tgl);

        $bln  = $date[1];

        switch ($bln) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
        }
        $tanggal = $date[2];
        $tahun   = $date[0];

        $strTanggal = "$tanggal $bulan $tahun";
        return $strTanggal;
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