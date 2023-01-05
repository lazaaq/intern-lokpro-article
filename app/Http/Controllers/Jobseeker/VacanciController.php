<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacanciController extends Controller
{

    public function detail_job(Request $req)
    {

        $data = [
            'title' => 'All job page',
            'nav_tree' => '',
            'lm' => lamaran($req->id)
        ];

        return view("backend/jobseeker/job_detail", $data);
    }

    public function save_pelamar(Request $req)
    {

        // untuk membatasi user mendaftar 2 kali pada 1 lowongan
        if (pelamar()->where('pelamar_id', '=', user()->id)->where('lamaran_id', '=', $req->lamaran_id)->count() > 0) {
            return redirect('/jobseeker/job_detail?id=' . $req->lamaran_id)->with('gagal', "Can't apply 2 times in 1 job");
        }

        $pelamar = new Pelamar();
        $req->validate([
            'ktp_number' => 'required|max:16|min:16',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'document' => 'required|mimes:pdf',
        ]);


        $filename = $req->file('document')->hashName();
        $logo = $req->file('document')->move('backend/document/jobseker', $filename);

        $pelamar->pelamar_id = user()->id;
        $pelamar->lamaran_id = $req->lamaran_id;
        $pelamar->ktp_number = $req->ktp_number;
        $pelamar->place_of_birth = $req->place_of_birth;
        $pelamar->date_of_birth = $req->date_of_birth;
        $pelamar->address = $req->address;
        $pelamar->phone_number = $req->phone_number;
        $pelamar->gender = $req->gender;
        $pelamar->religion = $req->religion;
        $pelamar->marital_status = $req->marital_status;
        $pelamar->document = $filename;
        $pelamar->status = 'menunggu';
        $pelamar->save();

        return redirect('/jobseeker/waiting_for_confirmate')->with('berhasil', 'Successfully applied for a job');
    }
}
