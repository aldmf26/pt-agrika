<?php

namespace App\Http\Controllers;

use App\Models\JawabanSurvey;
use App\Models\KesimpulanSurvey;
use App\Models\PertanyaanSurvey;
use App\Models\RespondenSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionerController extends Controller
{
    public function index(Request $r)
    {
        $kategori = $r->kategori ?? 'questioner';

        if ($kategori == 'questioner') {
            $pertanyaan = PertanyaanSurvey::orderBy('no_pertanyaan')->get();
        } elseif ($kategori == 'survey') {
            $pertanyaan = PertanyaanSurvey::orderBy('no_pertanyaan')->get();
            $responden = RespondenSurvey::with('jawaban.pertanyaan')->get();
            $jawaban = JawabanSurvey::with('pertanyaan')->get();
        } elseif ($kategori == 'final') {
            $responden = RespondenSurvey::with('jawaban.pertanyaan')->get();
            $jawaban = JawabanSurvey::with('pertanyaan')->get();
            $total_score = $jawaban->avg('nilai') / 5;
            $grade = $total_score > 0.8 ? 'A' : ($total_score > 0.6 ? 'B' : 'C');
            $scores = [];
            foreach (['KOMITMEN MANAGEMENT', 'TEAMWORK', 'PEMBERDAYAAN', 'KONTROL', 'KOORDINASI', 'KONSISTENSI', 'KEPEDULIAN', 'KOMUNIKASI', 'TARGET'] as $dim) {
                $qNos = PertanyaanSurvey::where('sub_kategori', $dim)->pluck('no_pertanyaan');
                $scores[$dim] = $jawaban->whereIn('pertanyaan.no_pertanyaan', $qNos)->avg('nilai') / 5;
            }
        }


        $data = [
            'title' => 'Questioner',
            'kategori' => $kategori,
            'pertanyaan' => $pertanyaan ?? '',
            'responden' => $responden ?? '',
            'jawaban' => $jawaban ?? '',
            'total_score' => $total_score ?? '',
            'grade' => $grade ?? '',
            'scores' => $scores ?? ''
        ];

        return view('qa.questioner.index', $data);
    }

    public function store(Request $request)
    {
        KesimpulanSurvey::where('tgl', date('Y-m-d'))->delete();
        KesimpulanSurvey::create([
            'tgl' => date('Y-m-d'),
            'kesimpulan' => $request->kesimpulan,
            'admin' => auth()->user()->name,
        ]);

        return redirect()->route('qa.questioner.index', ['kategori' => 'survey'])->with('sukses', 'Kesimpulan berhasil disimpan!')->with('category', 'survey');
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
