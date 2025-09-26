<?php

namespace App\Http\Controllers;

use App\Models\JawabanSurvey;
use App\Models\PertanyaanSurvey;
use App\Models\RespondenSurvey;
use Illuminate\Http\Request;

class QuestionerController extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'questioner';
        $pertanyaan = PertanyaanSurvey::get();
        $data = [
            'title' => 'Questioner',
            'kategori' => $kategori,
            'pertanyaan' => $pertanyaan,
        ];

        return view('qa.questioner.index', $data);
    }
    public function questioner()
    {
        $pertanyaan = PertanyaanSurvey::orderBy('no_pertanyaan')->get();
        return view('questioner', compact('pertanyaan'));
    }

    public function questioner_store(Request $request)
    {
        $responden = RespondenSurvey::create([
            'gender' => $request->gender,
            'bagian_pekerjaan' => $request->bagian_pekerjaan,
        ]);

        foreach ($request->jawaban as $pertanyaan_id => $nilai) {
            JawabanSurvey::create([
                'responden_id' => $responden->id,
                'pertanyaan_id' => $pertanyaan_id,
                'nilai' => $nilai,
            ]);
        }

        return redirect()->back()->with('sukses', 'Terima kasih telah mengisi kuesioner!');
    }
}
