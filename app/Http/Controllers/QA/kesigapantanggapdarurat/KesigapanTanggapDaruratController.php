<?php

namespace App\Http\Controllers\qa\kesigapantanggapdarurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesigapanTanggapDaruratController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Kesigapan Dan Tanggap Darurat',
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->orderBy('id', 'desc')->get(),

        ];
        return view('qa.kesigapantanggapdarurat.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kesigapan Dan Tanggap Darurat',
            'lokasi' => DB::table('lokasi')->get(),
        ];
        return view('qa.kesigapantanggapdarurat.create', $data);
    }

    public function store(Request $request)
    {
        $detailID = DB::table('kesigapan_tanggap_darurat')->insertGetId(
            [
                'tgl' => $request->tgl,
                'jenis_insiden' => $request->jenis_insiden,
                'lokasi' => $request->lokasi1,
                'penyebab' => $request->penyebab,
                'akibat' => $request->akibat,
                'dari_jam' => $request->dari_jam,
                'sampai_jam' => $request->sampai_jam,
                'kejadian' => $request->kejadian,
            ]
        );

        for ($i = 0; $i < count($request->lokasi2); $i++) {
            $data = [
                'kesigapan_id' => $detailID,
                'lokasi' => $request->lokasi2[$i],
                'cedera' => $request->cedera[$i],
                'meninggal' => $request->meninggal[$i],
                'infrastruktur' => $request->infrastruktur[$i],
                'produk' => $request->produk[$i],
                'potensi_bahaya' => $request->potensi_bahaya[$i],
                'tindakan' => $request->tindakan[$i],
                'pic' => $request->pic[$i],
            ];
            DB::table('detail_kesigapan_tanggap_darurat')->insert($data);
        }

        return redirect(route('qa.kesigapan.1.index'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function edit(Request $r)
    {
        $data = [
            'title' => 'Edit Data Kesigapan Dan Tanggap Darurat',
            'lokasi' => DB::table('lokasi')->get(),
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->where('id', $r->id)->first(),
            'detail' => DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $r->id)->get(),
        ];
        return view('qa.kesigapantanggapdarurat.edit', $data);
    }

    public function update(Request $request)
    {

        DB::table('kesigapan_tanggap_darurat')->where('id', $request->id)->update(
            [
                'tgl' => $request->tgl,
                'jenis_insiden' => $request->jenis_insiden,
                'lokasi' => $request->lokasi1,
                'penyebab' => $request->penyebab,
                'akibat' => $request->akibat,
                'dari_jam' => $request->dari_jam,
                'sampai_jam' => $request->sampai_jam,
                'kejadian' => $request->kejadian,
            ]
        );



        DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $request->id)->delete();
        for ($i = 0; $i < count($request->lokasi2); $i++) {
            $data = [
                'kesigapan_id' => $request->id,
                'lokasi' => $request->lokasi2[$i],
                'cedera' => $request->cedera[$i],
                'meninggal' => $request->meninggal[$i],
                'infrastruktur' => $request->infrastruktur[$i],
                'produk' => $request->produk[$i],
                'potensi_bahaya' => $request->potensi_bahaya[$i],
                'tindakan' => $request->tindakan[$i],
                'pic' => $request->pic[$i],
            ];
            DB::table('detail_kesigapan_tanggap_darurat')->insert($data);
        }

        return redirect(route('qa.kesigapan.1.index'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function print(Request $r)
    {
        $data = [
            'title' => 'Print Data Kesigapan Dan Tanggap Darurat',
            'kesigapan' => DB::table('kesigapan_tanggap_darurat')->where('id', $r->id)->first(),
            'detail' => DB::table('detail_kesigapan_tanggap_darurat')->where('kesigapan_id', $r->id)->get(),
        ];
        return view('qa.kesigapantanggapdarurat.print', $data);
    }
    // ------------------------ tim

    public function tim()
    {
        $tim = DB::table('tim_darurat')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Emergency Preparedness dan Response Team',
            'tim' => $tim,

        ];
        return view('qa.kesigapantanggapdarurat.tim.index', $data);
    }

    public function tim_store(Request $r)
    {
        DB::table('tim_darurat')->insert(
            [
                'name' => $r->name,
                'title' => $r->title,
                'hp' => $r->hp,
            ]
        );
        return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
    }

    public function tim_update($id, Request $r)
    {
        DB::table('tim_darurat')->where('id', $id)->update(
            [
                'name' => $r->name,
                'title' => $r->title,
                'hp' => $r->hp,
            ]
        );
        return redirect(route('qa.kesigapan.2.tim'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function tim_delete($id)
    {
        DB::table('tim_darurat')->where('id', $id)->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }

    public function tim_print(Request $r)
    {
        $data = [
            'tim' => DB::table('tim_darurat')->get(),
        ];
        return view('qa.kesigapantanggapdarurat.tim_print', $data);
    }

    // ------------------------ emergency

    public function emergency()
    {
        $emergency = DB::table('emergency_darurat')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Emergency Preparedness dan Response Team',
            'datas' => $emergency,

        ];
        return view('qa.kesigapantanggapdarurat.emergency.index', $data);
    }

    public function emergency_store(Request $r)
    {
        DB::table('emergency_darurat')->insert(
            [
                'name' => $r->name,
                'title' => $r->title,
                'hp' => $r->hp,
            ]
        );
        return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
    }

    public function emergency_update($id, Request $r)
    {
        DB::table('emergency_darurat')->where('id', $id)->update(
            [
                'name' => $r->name,
                'title' => $r->title,
                'hp' => $r->hp,
            ]
        );
        return redirect(route('qa.kesigapan.2.emergency'))->with('sukses', 'Data Berhasil Disimpan');
    }

    public function emergency_delete($id)
    {
        DB::table('emergency_darurat')->where('id', $id)->delete();
        return redirect()->back()->with('sukses', 'Data Berhasil Dihapus');
    }

    public function emergency_print(Request $r)
    {
        $data = [
            'datas' => DB::table('emergency_darurat')->get(),
        ];
        return view('qa.kesigapantanggapdarurat.emergency_print', $data);
    }

    // ------------------------ contingency

    public function contingency_plan()
    {
        $contingency_plan = DB::table('emergency_darurat as a')
            ->leftJoin('contingency_plan_darurat as b', 'a.id', '=', 'b.cases')
            ->selectRaw("a.id, a.cases, b.responsibility, b.preparedness, b.response, b.related_documents")
            ->get();
        $data = [
            'title' => 'contingency Plan Situation',
            'datas' => $contingency_plan,

        ];
        return view('qa.kesigapantanggapdarurat.contingency_plan.index', $data);
    }


    public function contingency_plan_update($id, Request $r)
    {
        $existing = DB::table('contingency_plan_darurat')->where('cases', $id)->first();
        if ($existing) {
            DB::table('contingency_plan_darurat')->where('cases', $id)->update(
                [
                    'responsibility' => $r->responsibility,
                    'preparedness' => $r->preparedness,
                    'response' => $r->response,
                    'related_documents' => $r->related_documents,
                ]
            );
        } else {
            DB::table('contingency_plan_darurat')->insert(
                [
                    'cases' => $id,
                    'responsibility' => $r->responsibility,
                    'preparedness' => $r->preparedness,
                    'response' => $r->response,
                    'related_documents' => $r->related_documents,
                ]
            );
        }
        return redirect()->back()->with('sukses', 'Data Berhasil Disimpan');
    }

    public function contingency_plan_print(Request $r)
    {
        $contingency_plan = DB::table('emergency_darurat as a')
            ->leftJoin('contingency_plan_darurat as b', 'a.id', '=', 'b.cases')
            ->selectRaw("a.id, a.cases, b.responsibility, b.preparedness, b.response, b.related_documents")
            ->get();

        $data = [
            'datas' => $contingency_plan,
        ];
        return view('qa.kesigapantanggapdarurat.contingency_plan_print', $data);
    }
}
