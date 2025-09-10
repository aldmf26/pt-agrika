<?php

use Carbon\Carbon;

if (!function_exists('tanggal')) {
    function tanggal($tgl)
    {
        $date = explode("-", $tgl);

        $bln  = $date[1];

        $bulanArray = [
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Agust',
            '09' => 'Sept',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
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
if (!function_exists('jenisProduk')) {
    function jenisProduk()
    {
        return [
            'lainnya' => 'Sbw',
            'barang' => 'Barang',
            'kemasan' => 'Kemasan',
            'jasa' => 'Jasa',
        ];
    }
}
if (!function_exists('sumBk')) {
    function sumBk($kategori, $data)
    {
        return array_sum(array_column($kategori, $data));
    }
}

if (!function_exists('dataDariBulan')) {
    function dataDariBulan()
    {
        return [
            'bulan' => 7,
            'tahun' => 2025,
        ];
    }
}

if (!function_exists('divisiAudit')) {
    function divisiAudit()
    {
        return [
            'bk',
            'cabut',
            'cetak',
            'steam',
            'qa',
            'purchasing',
            'it',
            'ekspedisi',
            'hrga',
        ];
    }
}
