<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeSbwCOntroller extends Controller
{
    function grade_sbw(Request $r)
    {
        $grade = DB::table('grade_sbw_kotor')->get();
        $response = [
            'status' => 'success',
            'message' => 'Data Sarang berhasil diambil',
            'data' => [
                'grade' => $grade
            ],
        ];
        return response()->json($response);
    }
    function detail_grade_sbw(Request $r)
    {
        $grade = DB::table('grade_sbw_kotor')->where('id', $r->id)->first();
        $response = [
            'status' => 'success',
            'message' => 'Data Sarang berhasil diambil',
            'data' => [
                'grade' => $grade
            ],
        ];
        return response()->json($response);
    }
    function rumah_walet(Request $r)
    {
        $rumah_walet = DB::table('rumah_walet')->get();
        $response = [
            'status' => 'success',
            'message' => 'Data Sarang berhasil diambil',
            'data' => [
                'rumah_walet' => $rumah_walet
            ],
        ];
        return response()->json($response);
    }
}
