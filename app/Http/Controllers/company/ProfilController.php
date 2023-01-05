<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Data_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Profile page',
            'sosmed' => explode('|', user()->sosmed)
        ];
        return view("backend/company/profile", $data);
    }

    public function edit(Request $req)
    {
        // validasi edit profile
        $req->validate([
            'name' => 'required',
            'job_location' => 'required',
            'jumlah_pekerja' => 'required',
            'company_location' => 'required',
            'company_culture' => 'required'
        ]);

        // update to users table
        $user = new user();
        $user->where('id', '=', user()->id)->update([
            'name' => $req->name
        ]);

        // update to data_users table
        $dtuser = new Data_user();
        $dtuser->where('user_id', '=', user()->id)->update([
            'job_location' => $req->job_location,
            'jumlah_pekerja' => $req->jumlah_pekerja,
            'company_location' => $req->company_location,
            'company_culture' => $req->company_culture
        ]);

        return redirect('/company/profile')->with('berhasil', 'Successfully updated data');
    }

    public function sosmed(Request $req)
    {
        // update sosmed
        $val = [$req->facebook, $req->instagram, $req->twitter];
        $sosmed = implode('|', $val);
        $dtuser = new Data_user();
        $dtuser->where('user_id', '=', user()->id)->update([
            'sosmed' => $sosmed,
        ]);


        return redirect('/company/profile')->with('berhasil', 'Successfully updated sosmed');
    }

    public function contact(Request $req)
    {
        // cek password
        $req->validate([
            'old_password' => 'required',
            'new_password' => 'string|required|min:8'
        ]);


        // cek old password
        if (!Hash::check($req->old_password, user()->password)) {
            return redirect('/company/profile')->with('gagal', 'Failed update password! Old password wrong');
        }

        // update password
        $user = new User();
        $user->where('id', '=', user()->id)->update([
            'password' => Hash::make($req->new_password),
        ]);
        return redirect('/company/profile')->with('berhasil', 'Successfully updated password');
    }

    public function email(Request $req)
    {
        $user = new User();
        // validasi email
        $req->validate([
            'email' => 'required|unique:users',
        ]);

        // update email
        $user->where('id', '=', user()->id)->update([
            'email' => $req->email,
        ]);

        return redirect('/company/profile')->with('berhasil', 'Successfully updated email');
    }

    public function logo(Request $req)
    {
        $dtuser = new Data_user();
        // validasi email
        $req->validate([
            'logo' => 'required|image',
        ]);

        $filename = $req->file('logo')->hashName();

        if ('default.jpg' != user()->logo) {
            File::delete('backend/images/logocompany/' . user()->logo);
        }
        $logo = $req->file('logo')->move('backend/images/logocompany', $filename);

        // update email
        $dtuser->where('user_id', '=', user()->id)->update([
            'logo' => $logo->getFilename(),
        ]);

        return redirect('/company/profile')->with('berhasil', 'Successfully updated email');
    }
}
