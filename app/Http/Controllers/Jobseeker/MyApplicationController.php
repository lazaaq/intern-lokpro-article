<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Pelamar;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyApplicationController extends Controller
{
    public function belum()
    {
        $data = [
            'title' => 'Waiting for confirmate',
            'nav_tree' => '',
            'pelamar' => pelamar()->where('pelamars.status', '=', 'menunggu')->where('pelamars.pelamar_id', '=', user()->id)->get()
        ];

        return view("backend/jobseeker/belum_dikonfirmasi", $data);
    }

    public function sudah(Request $req)
    {
        $data = [
            'title' => 'Confirmed',
            'nav_tree' => '',
            'pelamar' => pelamar()->where('pelamars.status', '=', 'sudah')->where('pelamars.pelamar_id', '=', user()->id)->get()
        ];

        return view("backend/jobseeker/sudah_dikonfirmasi", $data);
    }

    public function ditolak()
    {
        $data = [
            'title' => 'Rejected',
            'nav_tree' => '',
            'pelamar' => pelamar()->where('pelamars.status', '=', 'ditolak')->where('pelamars.pelamar_id', '=', user()->id)->get()
        ];

        return view("backend/jobseeker/lamaran_ditolak", $data);
    }

    public function detail(Request $req)
    {
        $detail = pelamars()->where('pelamars.status', '=', $req->status)->where('pelamars.pelamar_id', '=', user()->id)->where('pelamars.id', '=', $req->detail)->first();
        return json_encode($detail);
    }
}
