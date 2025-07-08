<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermohonanKaryawan extends Model
{
    public $table = 'permohonan_karyawan';

    public static function dapatkan($id = null)
    {
        $func = $id ? "selectOne" : "select";
        $where = $id ? "WHERE a.id = $id" : "";

        return DB::$func("SELECT 
                a.id,
                b.divisi as jabatan,
                a.jenis_kelamin,
                month(a.tgl_masuk) as bulan,
                concat(a.tgl_masuk) as tgl_masuk,
                concat(a.tgl_lahir) as tgl_lahir,
                TIMESTAMPDIFF(YEAR, a.tgl_lahir, a.tgl_masuk) as umur,
                concat(a.status) as status,
                date_sub(a.tgl_masuk, interval floor(14+7) day) as tgl_dibutuhkan, 
                date_sub(a.tgl_masuk, interval floor(24+7) day) as tgl_input, 
                count(*) as jumlah FROM `data_pegawais` as a
            LEFT JOIN divisis as b on a.divisi_id = b.id
            $where
            GROUP BY b.divisi,month(a.tgl_masuk),a.jenis_kelamin 
            having tgl_dibutuhkan is not null");
    }
}
