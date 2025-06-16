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
}
