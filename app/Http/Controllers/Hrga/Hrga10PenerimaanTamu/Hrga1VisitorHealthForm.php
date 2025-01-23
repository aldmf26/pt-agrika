<?php

namespace App\Http\Controllers\Hrga\Hrga10PenerimaanTamu;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Hrga1VisitorHealthForm extends Controller
{
    public function index()
    {
        $datas = Tamu::orderBy('created_at', 'desc')->get();
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
    protected function storeSignature($signature, $prefix)
    {
        // Decode Base64
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $image = base64_decode($signature);

        // Generate unique filename
        $fileName = $prefix . '_' . time() . '.png';

        // Path untuk menyimpan file
        $filePath = 'signatures/' . $fileName;

        // Simpan file ke storage
        Storage::disk('public')->put($filePath, $image);
        return $filePath; // Kembalikan path untuk disimpan ke database
    }
    
    public function storeTamu(Request $r)
    {
        try {
            DB::beginTransaction();

            $existingRecord = Tamu::where([['date', $r->date],['name', $r->name]])
                ->first();

            if (!$existingRecord) {
                $visitorSignaturePath = $this->storeSignature($r->visitor_signature, 'visitor_signature');
                $recipientSignaturePath = $this->storeSignature($r->recipient_signature, 'recipient_signature');

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
