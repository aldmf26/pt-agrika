<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermohonanKaryawan extends Model
{
    public $table = 'permohonan_karyawans';
    public $guarded = [];
    public static function dapatkan($id = null)
    {
        $func = $id ? "selectOne" : "select";
        $where = $id ? "WHERE a.id = $id" : "";

        return DB::$func("SELECT 
            a.id,
            b.divisi as jabatan,
            b.id as id_divisi,
            b.uraian_kerja,
            IF(a.jenis_kelamin = 'L','Laki-laki','Perempuan') as jenis_kelamin,
            MONTH(a.tgl_masuk) as bulan,
            CONCAT(a.tgl_masuk) as tgl_masuk,
            CONCAT(a.tgl_lahir) as tgl_lahir,
            TIMESTAMPDIFF(YEAR, a.tgl_lahir, a.tgl_masuk) as umur,
            CONCAT(a.status) as status,
            date_sub(a.tgl_masuk, interval floor(14+7) day) as tgl_dibutuhkan, 
            DATE_SUB(a.tgl_masuk, INTERVAL 31 DAY) AS tgl_input,
            COUNT(*) AS jumlah
        FROM data_pegawais AS a
        LEFT JOIN divisis AS b ON a.divisi_id = b.id
        $where
        GROUP BY b.divisi, MONTH(a.tgl_masuk), a.jenis_kelamin
        HAVING tgl_dibutuhkan IS NOT NULL");
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }
}
