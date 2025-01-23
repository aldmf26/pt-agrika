<?php

namespace App\Http\Controllers\Hrga\Hrga1PenerimaanKaryawanBaru;

use App\Http\Controllers\Controller;
use App\Models\DataPegawai;
use App\Services\DataPegawaiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga3HasilEvaluasiKaryawanBaru extends Controller
{
    public function index(DataPegawaiService $dataPegawaiService)
    {
        $dataPegawaiService->download();

        $datas = $this->getQuery();
        $data = [
            'title' => 'Hrga 1.3 hasil evaluasi karyawan baru',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga3_hasil_evaluasi_karyawan_baru.index', $data);
    }

    public static function getQuery($value = null)
    {
        $where = is_array($value) ? "id in (".implode(',', $value).") and" : '';
        
        $datas =  DB::select("SELECT 
                id,
                nama,
                tgl_lahir,
                jenis_kelamin,
                posisi,
                tgl_masuk,
                CASE 
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
                    THEN '1'
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) 
                    THEN '3'
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                    THEN '6'
                    ELSE 'Karyawan Tetap'
                END as status_karyawan,
                CASE
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                    THEN DATEDIFF(DATE_ADD(tgl_masuk, INTERVAL 1 MONTH), CURDATE())
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                    THEN DATEDIFF(DATE_ADD(tgl_masuk, INTERVAL 3 MONTH), CURDATE())
                    WHEN tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    THEN DATEDIFF(DATE_ADD(tgl_masuk, INTERVAL 6 MONTH), CURDATE())
                    ELSE 0
                END as sisa_hari_sesuai_masa_percobaan
                FROM data_pegawais
                WHERE $where tgl_masuk >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH);"
                    );
           return  $datas;
    }

    public function print(Request $r)
    {
        $checkedValues = explode(',', $r->checked);
        $datas = $this->getQuery($checkedValues);

        $data = [
            'title' => 'HASIL EVALUASI KARYAWAN BARU',
            'dok' => 'Dok.No.: FRM.HRGA.01.03, Rev.00',
            'datas' => $datas
        ];
        return view('hrga.hrga1.hrga3_hasil_evaluasi_karyawan_baru.print', $data);
    }
}
