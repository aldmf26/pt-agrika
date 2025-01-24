<?php

namespace App\Http\Controllers\Hrga\Hrga10PenerimaanTamu;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use App\Services\TtdUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hrga1VisitorHealthForm extends Controller
{
    public function index()
    {
        $datas = Tamu::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Hrga 10.1 VISITOR HEALTH MONITORING FORM',
            'datas' => $datas
        ];
        return view('hrga.hrga10.hrga1_visitor_healt.index', $data);
    }

    public function tamu()
    {
        $data = [
            'title' => 'Hrga 10.1 VISITOR HEALTH MONITORING FORM'
        ];
        return view('hrga.hrga10.hrga1_visitor_healt.tamu', $data);
    }

    public function storeTamu(Request $r, TtdUploadService $service)
    {
        try {
            DB::beginTransaction();

            $existingRecord = Tamu::where([['date', $r->date],['name', $r->name]])
                ->first();
            if (!$existingRecord) {
                $visitorSignaturePath = $service->store($r->visitor_signature, 'visitor_signature');
                $recipientSignaturePath = $service->store($r->recipient_signature, 'recipient_signature');

                Tamu::create([
                    'date' => $r->date,
                    'name' => $r->name,
                    'time_in' => $r->time_in,
                    'time_out' => $r->time_out,
                    'purpose' => $r->purpose,
                    'flu' => $r->flu,
                    'cough' => $r->cough,
                    'diare' => $r->diare,
                    'fever' => $r->fever,
                    'sore_throat' => $r->sore_throat,
                    'difficulty_breathing' => $r->difficulty_breathing,
                    'area_covid' => $r->area_covid,
                    'penderita_covid' => $r->penderita_covid,
                    'visitor_signature' => $visitorSignaturePath,
                    'recipient_signature' => $recipientSignaturePath,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('sukses', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function print(Request $r)
    {
        $checkedValues = explode(',', $r->checked);
        $datas = Tamu::whereIn('id', $checkedValues)->get();

        $data = [
            'title' => 'HASIL EVALUASI KARYAWAN BARU',
            'dok' => 'Dok.No.: FRM.HRGA.01.03, Rev.00',
            'datas' => $datas
        ];
        return view('hrga.hrga10.hrga1_visitor_healt.print', $data);
    }
}
