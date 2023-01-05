<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\comment;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.home.index', [
            "jobs" => Lamaran::all()
        ]);
    }

    public function jobs()
    {
        return view('frontend.jobs.jobs', [
            "jobs" => Lamaran::all()
        ]);
    }

    public function detailsJob($id)
    {
        $data = [
            "job" => Lamaran::find($id)
        ];

        return view('frontend.jobs.detail', $data);
    }

    public function articel()
    {
        $data = [
            "artikels" => artikel::all(),
        ];
        return view('frontend.articel.articel', $data);
    }

    public function detailsArticel(artikel $artikel)
    {
        //mengambil data artikel sebelumnya dan artikel setelahnya (berdasarkan id)
        if($artikel->id != 1) {
            $artikel_sebelumnya = artikel::find($artikel->id - 1);
        }
        if ($artikel->id != artikel::count()) {
            $artikel_setelahnya = artikel::find($artikel->id + 1);
        }
        //mengambil komentar
        $komentar = comment::where('artikel_id', $artikel->id)->get();
        //latest post
        $latest_post = DB::table('artikels')->latest()->limit(5)->get();


        $data = [
            "artikel" => $artikel,
            "artikel_sebelumnya" => $artikel_sebelumnya ?? null,
            "artikel_setelahnya" => $artikel_setelahnya ?? null,
            "komentars" => $komentar,
            "latest_post" => $latest_post
        ];
        return view('frontend.articel.detail', $data);
    }
}
