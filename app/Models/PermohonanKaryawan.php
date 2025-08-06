<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermohonanKaryawan extends Model
{
    public $table = 'permohonan_karyawans';
    public $guarded = [];

    public function getAlasanPenambahanAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDiajukanOlehAttribute($value)
    {
        return ucfirst($value);
    }

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
            CONCAT(a.tgl_masuk) as countTgl_masuk,
            a.tgl_masuk as tgl_masuk,
            CONCAT(a.tgl_lahir) as tgl_lahir,
            TIMESTAMPDIFF(YEAR, a.tgl_lahir, a.tgl_masuk) as umur,
            CONCAT(a.status) as status,
            -- tgl_dibutuhkan diacak antara 5-10 hari sebelum tgl_masuk
            DATE_SUB(a.tgl_masuk, INTERVAL (FLOOR(5 + (RAND(a.id) * 6))) DAY) as tgl_dibutuhkan,
            DATE_SUB(DATE_SUB(a.tgl_masuk, INTERVAL (FLOOR(5 + (RAND(a.id) * 6))) DAY), INTERVAL 1 DAY) AS tgl_input,
            COUNT(*) AS jumlah
        FROM data_pegawais AS a
        LEFT JOIN divisis AS b ON a.divisi_id = b.id
        $where
        GROUP BY a.tgl_masuk, a.divisi_id
        ");
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id');
    }
}
