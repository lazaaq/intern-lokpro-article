<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use App\Models\{
    User,
    JobseekerDetail,
    JobseekerAddress,
};
use Illuminate\Support\Facades\File;

class JobseekerProfileController extends Controller
{
    private $nav_tree = "jobseeker-profile";

    public function index(Request $req)
    {
        $jobseeker = User::find(Auth::user()->id);
        $provinces = DB::table('provinces')->get();

        $dt = DB::table('jobseeker_details')
            ->join('cities', 'cities.id', '=', 'jobseeker_details.city_id')
            ->join('provinces', 'provinces.id', '=', 'cities.province_id')
            ->select('jobseeker_details.*', 'cities.id as id_cities', 'cities.name as name_city', 'cities.province_id', 'provinces.id as id_province', 'provinces.name as name_province')
            ->where('jobseeker_details.jobseeker_id', '=', Auth::user()->id)
            ->first();

        $data = [
            'nav_tree' => $this->nav_tree,
            'jobseeker' => $jobseeker,
            'provinces' => $provinces,
            'dt'    => $dt
        ];

        return view("backend.pages.jobseeker.profile.index", $data);
    }

    public function city(Request $req)
    {
        $province_id = $req->province_id;
        $data['city'] = DB::table('cities')->where('province_id', '=', $province_id)->get();
        return view("backend.pages.jobseeker.profile.city", $data);
    }

    public function degree(Request $request)
    {
        $messages = [
            'required' => ':attribute is required',
        ];

        $validator = Validator::make($request->all(), [
            'degree' => 'required',
            'institution_name' => 'required',
            'graduation_year' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $db = new JobseekerDetail();
            $db->where('jobseeker_id', '=', user()->id)->update([
                'degree' => $request->degree,
                'institution_name' => $request->institution_name,
                'graduation_year' => $request->graduation_year
            ]);
            return redirect()->back()->with('success', 'Update successful!');
        }
    }

    public function updatePersonalInfo(Request $request)
    {
        $messages = [
            'required' => ':attribute is required',
        ];

        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address_description' => 'required',
            'province' => 'required',
            'city' => 'required',
            'profile_picture' => 'required|image'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $filename = $request->file('profile_picture')->hashName();
            $jobseeker = User::find(Auth::user()->id);
            $jobseeker->name = $request->input('fullname');
            $jobseeker->save();

            if (isset($jobseeker->jobseekerDetail)) {
                File::delete('backend/images/faces/' . jobseeker()->profile_picture);
                $logo = $request->file('profile_picture')->move('backend/images/faces', $filename);
                $jobseeker_detail = JobseekerDetail::where('jobseeker_id', '=', $jobseeker->id)
                    ->update([
                        'bio' => $request->input('bio'),
                        'gender' => $request->input('gender'),
                        'date_of_birth' => $request->input('date_of_birth'),
                        'phone_number' => $request->input('phone_number'),
                        'profile_picture' => $logo->getFilename(),
                        'city_id' => $request->input('city'),
                    ]);
            } else {
                $logo = $request->file('profile_picture')->move('backend/images/faces', $filename);
                $jobseeker_detail = JobseekerDetail::create([
                    'jobseeker_id' => $jobseeker->id,
                    'bio' => $request->input('bio'),
                    'gender' => $request->input('gender'),
                    'date_of_birth' => $request->input('date_of_birth'),
                    'phone_number' => $request->input('phone_number'),
                    'profile_picture' => $logo->getFilename(),
                    'city_id' => $request->input('city'),
                ]);
            }

            if (isset($jobseeker->jobseekerAddress)) {
                $jobseeker_address = JobseekerAddress::where('jobseeker_id', '=', $jobseeker->id)
                    ->update([
                        'province_id' => $request->input('province'),
                        'city_id' => $request->input('city'),
                        'address_description' => $request->input('address_description'),
                    ]);
            } else {
                $jobseeker_address = JobseekerAddress::create([
                    'jobseeker_id' => $jobseeker->id,
                    'province_id' => $request->input('province'),
                    'city_id' => $request->input('city'),
                    'address_description' => $request->input('address_description'),
                ]);
            }

            return redirect()->back()->with('success', 'Update successful!');
        }
    }

    public function updateEducationInfo(Request $request)
    {
        $messages = [
            'required' => ':attribute is required',
        ];

        $validator = Validator::make($request->all(), [], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
        }
    }

    public function checkCities(Request $request)
    {
        $cities = DB::table('cities')
            ->where('province_id', '=', $request->province_id)
            ->select(['*'])
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'cities' => $cities,
            ],
        ], Response::HTTP_OK);
    }
}
