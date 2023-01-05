<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobseeker\{
    JobseekerProfileController,
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'jobseeker', 'middleware' => 'api'], function () {

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/check-cities', [
            JobseekerProfileController::class, 'checkCities'
        ])->name('api.jobseeker.profile.check-cities');
    });

});
