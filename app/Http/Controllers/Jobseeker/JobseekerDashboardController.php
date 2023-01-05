<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\artikel;
use App\Models\comment;
use App\Models\like_artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobseekerDashboardController extends Controller
{
    private $nav_tree = "jobseeker-dashboard";

    public function index(Request $req)
    {
        $tas = new artikel();
        // dd($tas->get());
        // untuk fitur comment
        $comment = new comment();
        $like = new like_artikel;
        if (isset($req->suka)) {
            $dt_like = $like->where('user_id', '=', user()->id)->where('artikel_id', '=', $req->suka)->count();
            if ($dt_like > 0) {
                $like->where('user_id', '=', user()->id)->delete();
            } else {
                $like->artikel_id = $req->suka;
                $like->user_id = user()->id;
                $like->save();
            }
            return json_encode($like->where('artikel_id', '=', $req->suka)->where('artikel_id', '=', $req->suka)->count());
        }

        // untuk fitur like
        $like = new like_artikel;
        if (isset($req->suka)) {
            $dt_like = $like->where('user_id', '=', user()->id)->where('artikel_id', '=', $req->suka)->count();
            if ($dt_like > 0) {
                $like->where('user_id', '=', user()->id)->delete();
            } else {
                $like->artikel_id = $req->suka;
                $like->user_id = user()->id;
                $like->save();
            }
            return json_encode($like->where('artikel_id', '=', $req->suka)->where('artikel_id', '=', $req->suka)->count());
        }
        // untuk menampilkan data semua dan 1 saja
        if (isset($req->me) && $req->me == 1) {
            $artikel = DB::table('artikels')
                ->join('users', 'users.id', '=', 'artikels.user_id')
                ->join('jobseeker_details', 'jobseeker_details.jobseeker_id', '=', 'users.id')
                ->where('users.id', '=', user()->id)
                ->select('jobseeker_details.*', 'users.id as id_user', 'users.role', 'users.name', 'users.email', 'users.password', 'artikels.id as id_artikel', 'artikels.subject', 'artikels.description', 'artikels.foto_video', 'artikels.user_id')
                ->orderByDesc('artikels.id');
        } else {
            $artikel = DB::table('artikels')
                ->join('users', 'users.id', '=', 'artikels.user_id')
                ->join('jobseeker_details', 'jobseeker_details.jobseeker_id', '=', 'users.id')
                ->select('jobseeker_details.*', 'users.id as id_user', 'users.role', 'users.name', 'users.email', 'users.password', 'artikels.id as id_artikel', 'artikels.subject', 'artikels.description', 'artikels.foto_video', 'artikels.user_id')
                ->orderByDesc('artikels.id');
        }
        $data = [
            'nav_tree' => $this->nav_tree,
            'like' => $like,
            'comment' => $comment,
            'artikel' => $artikel->get()
        ];

        return view("backend.pages.jobseeker.dashboard", $data);
    }

    public function postArtikel(Request $req)
    {
        $foto_video = $req->foto_video->move('backend/images/artikel', $req->foto_video->hashName());
        $foto_video = $foto_video->getFilename();
        $artikel = new artikel();
        $artikel->subject = $req->subject;
        $artikel->description = $req->description;
        $artikel->foto_video = $foto_video;
        $artikel->user_id = user()->id;
        $artikel->save();
        return redirect()->back();
    }

    public function apiArtikel(Request $req)
    {
        $artikel = new artikel();
        $artikel_id = $req->data_koment;
        $result = $artikel
            ->join('users', 'users.id', '=', 'artikels.user_id')
            ->join('jobseeker_details', 'jobseeker_details.jobseeker_id', '=', 'users.id')
            ->where('artikels.id', '=', $artikel_id)
            ->select('users.*', 'artikels.*', 'jobseeker_details.*', 'users.id as id_user', 'artikels.id as id_artikel', 'jobseeker_details.id as id_jobseeker')
            ->first();
        return json_encode($result);
    }

    public function apiKomentar(Request $req)
    {
        $comment = new comment();
        $artikel = new artikel();
        $artikel_id = $req->data_koment;
        if ($comment->where('artikel_id', '=', $artikel_id)->count() > 0) {
            $result = $comment
                ->join('artikels', 'comments.artikel_id', '=', 'artikels.id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->join('jobseeker_details', 'jobseeker_details.jobseeker_id', '=', 'users.id')
                ->where('artikels.id', '=', $artikel_id)
                ->select('users.*', 'artikels.*', 'jobseeker_details.*', 'users.id as id_user', 'artikels.id as id_artikel', 'jobseeker_details.id as id_jobseeker', 'comments.*', 'comments.id as id_comments')
                ->orderByDesc('comments.id')
                ->get();
        } else {
            $result = [null];
        }
        return json_encode($result);
    }

    public function addComment(Request $req)
    {
        $comment = new comment();
        $komentar = $req->komentar;
        $id_artikel = $req->id_komentar;
        $comment->artikel_id = $id_artikel;
        $comment->user_id = user()->id;
        $comment->comment = $komentar;
        $comment->save();
        return true;
    }

    public function artikel_delete(Request $req)
    {
        $artikel = new artikel();
        $comment = new comment();
        $like = new like_artikel();

        $artikel->where('id', '=', $req->id)->delete();

        if ($comment->where('artikel_id', '=', $req->id)->count() > 0) {
            $comment->where('artikel_id', '=', $req->id)->delete();
        }

        if ($like->where('artikel_id', '=', $req->id)->count() > 0) {
            $like->where('artikel_id', '=', $req->id)->delete();
        }

        return redirect()->back();
    }
}
