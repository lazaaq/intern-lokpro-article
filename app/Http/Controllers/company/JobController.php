<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'All job page'
        ];

        return view("backend/company/job_index", $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Post page'
        ];

        return view("backend/company/job_create", $data);
    }

    public function store(Request $req)
    {
        $req->validate([
            'job_position' => 'required',
            'job_nature' => 'required',
            'salary_range' => 'required',
            'job_location' => 'required',
            'job_description' => 'required'
        ]);

        $lamaran = new Lamaran();
        $lamaran->company_id = user()->id;
        $lamaran->job_position = $req->job_position;
        $lamaran->job_nature = $req->job_nature;
        $lamaran->salary_range = $req->salary_range;
        $lamaran->job_location = $req->job_location;
        $lamaran->job_description = $req->job_description;
        $lamaran->save();

        return redirect('/company/job/create')->with('berhasil', 'Successfully insert data');
    }
    public function show($id)
    {
        $data = [
            'job' => Lamaran::find($id)
        ];

        return view('backend/company/job_show', $data);
    }
    public function edit($id)
    {
        $data = [
            'job' => Lamaran::find($id)
        ];

        return view('backend/company/job_edit', $data);
    }
    public function update(Request $req, $id)
    {
        $validated = $req->validate([
            'job_position' => 'required',
            'salary_range' => 'required',
            'job_location' => 'required',
            'job_description' => 'required'
        ]);

        $lamaran = Lamaran::find($id);
        $lamaran->update($validated);
        return redirect('/company/job/' . $id)->with('berhasil', 'Successfully change data');
    }
    public function destroy(Request $req, $id)
    {
        $lamaran = Lamaran::find($id);
        $lamaran->delete();
        return redirect('/company/job')->with('berhasil', 'Successfully remove data');
    }

    public function pelamar_index(Lamaran $lamaran, Request $req)
    {
        if (isset($req->status)) {
            $pelamar = new Pelamar();
            $pelamar->where('id', '=', $lamaran->id)->update([
                'status' => $req->status,
            ]);
            return redirect("/company/job/" . $lamaran->id . '/pelamar');
        }
        $data = [
            'lamaran' => $lamaran,
            'pelamars' => Pelamar::where('lamaran_id', $lamaran->id)->get()
        ];

        return view('backend/company/pelamar_index', $data);
    }

    public function pelamar_show(Lamaran $lamaran, Pelamar $pelamar)
    {
        $data = compact('lamaran', 'pelamar');

        return view('backend/company/pelamar_show', $data);
    }

    public function job_detail(Request $req)
    {

        if ($req->status == 2 || $req->status == 3) {
            $pelamar = new Pelamar();
            $req->status == 2 ? $st = 'ditolak' : $st = 'sudah';
            $pelamar->where('id', '=', $req->id_pelamar)->update([
                'status' => $st,
            ]);
            return redirect('/company/job_detail/?id=' . $req->id)->with('berhasil', 'Status update successfully');
        }

        if ($req->status == 'menunggu') {
            $plr = pelamar()->where('status', '=', 'menunggu')->where('company_id', '=', user()->id)->where('lamaran_id', '=', $req->id)->get();
        } elseif ($req->status == 'sudah') {
            $plr = pelamar()->where('status', '=', 'sudah')->where('company_id', '=', user()->id)->where('lamaran_id', '=', $req->id)->get();
        } elseif ($req->status == 'ditolak') {
            $plr = pelamar()->where('status', '=', 'ditolak')->where('company_id', '=', user()->id)->where('lamaran_id', '=', $req->id)->get();
        } else {
            $plr = pelamar()->where('company_id', '=', user()->id)->where('lamaran_id', '=', $req->id)->get();
        }

        $data = [
            'title' => 'Job Detail Page',
            'lm' => lamaran($req->id),
            'plr' => $plr,
            'id'    => $req->id,
            'status'    =>  $req->status
        ];

        return view("backend/company/job_detail", $data);
    }
}
