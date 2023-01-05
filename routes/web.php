<?php

use App\Http\Controllers\company\DashboardController;
use App\Http\Controllers\company\ProfilController;
use App\Http\Controllers\PostingLowonganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\company\JobController;
use App\Http\Controllers\FrontendController;

use App\Http\Controllers\Jobseeker\{
    JobseekerDashboardController,
    JobseekerProfileController,
    MyApplicationController,
    VacanciController,
};
//use App\Http\Controllers\PostingLowonganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [FrontendController::class, 'index']);
Route::get('/jobs', [FrontendController::class, 'jobs']);
Route::get('/jobs/detail/{post:id}', [FrontendController::class, 'detailsJob']);
Route::get('/articel', [FrontendController::class, 'articel']);
Route::get('/articel/{artikel:id}', [FrontendController::class, 'detailsArticel']);

Route::group(['middleware' => 'auth'], function () {
    Route::middleware('role:company')->group(function () {
        // for dashboard company
        Route::get('/company/dashboard', [DashboardController::class, 'index'])->name('company.dashboard');

        // for profile company
        Route::get('/company/Management', [ProfilController::class, 'index']);
        Route::get('/company/profile', [ProfilController::class, 'index']);
        Route::post('/company/profile', [ProfilController::class, 'edit']);
        Route::post('/company/sosmed', [ProfilController::class, 'sosmed']);
        Route::post('/company/email', [ProfilController::class, 'email']);
        Route::post('/company/contact', [ProfilController::class, 'contact']);
        Route::post('/company/logo', [ProfilController::class, 'logo']);
        //for job company
        Route::resource('/company/job', JobController::class);
        Route::get('/company/job/{lamaran}/pelamar', [JobController::class, 'pelamar_index']);
        Route::get('/company/job/{lamaran}/pelamar/{pelamar}', [JobController::class, 'pelamar_show']);
        // Route::resource('/company/lowongan', PostingLowonganController::class);
        Route::get('/company/See_All_Job', [JobController::class, 'index']);
        Route::get('/company/Post_Job', [JobController::class, 'post']);
        Route::post('/company/Post_Job', [JobController::class, 'save_post']);
        Route::get('/company/job_detail', [JobController::class, 'job_detail']);
        Route::resource('/company/lowongan', PostingLowonganController::class);
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::middleware('role:jobseeker')->group(function () {
        // for lowongan jobseeker
        Route::view('jobseeker/job_vacanci', 'backend/jobseeker/job_vacanci', ['nav_tree' => '']);
        Route::get('/jobseeker/job_detail', [VacanciController::class, 'detail_job']);
        Route::post('/jobseeker/job_detail', [VacanciController::class, 'save_pelamar']);
        Route::get('/jobseeker/waiting_for_confirmate', [MyApplicationController::class, 'belum']);
        Route::get('/jobseeker/confirmed', [MyApplicationController::class, 'sudah']);
        Route::post('/jobseeker/detail', [MyApplicationController::class, 'detail']);
        Route::get('/jobseeker/rejected', [MyApplicationController::class, 'ditolak']);
        Route::post('/jobseeker/cities', [JobseekerProfileController::class, 'city']);
        Route::post('/jobseeker/degree', [JobseekerProfileController::class, 'degree']);

        // untuk dashboard
        Route::get('/jobseeker/dashboard', [JobseekerDashboardController::class, 'index'])->name('jobseeker.dashboard');
        Route::post('/jobseeker/dashboard', [JobseekerDashboardController::class, 'postArtikel']);
        Route::get('/jobseeker/koment', [JobseekerDashboardController::class, 'apiArtikel']);
        Route::get('/jobseeker/koments', [JobseekerDashboardController::class, 'apiKomentar']);
        Route::get('/jobseeker/comment', [JobseekerDashboardController::class, 'addComment']);
        Route::get('/jobseeker/artikel_delete', [JobseekerDashboardController::class, 'artikel_delete']);
    });
});

Route::group(['prefix' => 'jobseeker', 'middleware' => 'auth', 'role' => 'jobseeker'], function () {

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [
            JobseekerProfileController::class, 'index'
        ])->name('jobseeker.profile.index');
        Route::post('/update-personal-info', [
            JobseekerProfileController::class, 'updatePersonalInfo'
        ])->name('jobseeker.profile.update-personal-info');
    });
});

// BACKEND LANA
Route::middleware('auth')->group(function () {
    //    Route::resource('/lowongan', PostingLowonganController::class);
});
