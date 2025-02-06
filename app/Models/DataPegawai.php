<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataPegawai extends Model
{
    protected $guarded = [];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public static function hasilEvaluasi($value = null)
    {
        $where = is_array($value) ? "a.karyawan_id_dari_api in (".implode(',', $value).") and" : '';
        
        $datas =  DB::select("SELECT 
                a.id,
                a.nama,
                a.tgl_lahir,
                a.jenis_kelamin,
                a.posisi,
                a.karyawan_id_dari_api as id_karyawan,
                a.tgl_masuk,
                b.divisi,
                CASE 
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
                    THEN '1'
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) 
                    THEN '3'
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                    THEN '6'
                    ELSE 'Karyawan Tetap'
                END as status_karyawan,
                CASE
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 1 MONTH), CURDATE())
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 3 MONTH), CURDATE())
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 6 MONTH), CURDATE())
                    ELSE 0
                END as sisa_hari_sesuai_masa_percobaan
                FROM data_pegawais as a
                LEFT JOIN divisis as b on a.divisi_id = b.id
                WHERE $where a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH);"
                    );
           return  $datas;
    }
    public static function oneHasilEvaluasi($id = null)
    {
        $where = $id ? "a.karyawan_id_dari_api = $id AND" : '';
        
        $datas = DB::selectOne("SELECT 
                a.id,
                a.nama,
                a.tgl_lahir,
                a.jenis_kelamin,
                a.posisi,
                a.karyawan_id_dari_api as id_karyawan,
                a.tgl_masuk,
                b.divisi,
                CASE 
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
                    THEN '1'
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) 
                    THEN '3'
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                    THEN '6'
                    ELSE 'Karyawan Tetap'
                END as status_karyawan,
                CASE
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 1 MONTH), CURDATE())
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 3 MONTH), CURDATE())
                    WHEN a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    THEN DATEDIFF(DATE_ADD(a.tgl_masuk, INTERVAL 6 MONTH), CURDATE())
                    ELSE 0
                END as sisa_hari_sesuai_masa_percobaan
                FROM data_pegawais as a
                LEFT JOIN divisis as b on a.divisi_id = b.id
                WHERE $where a.tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH);"
        );
        return $datas;
    }
}
