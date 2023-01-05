<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view("backend/dashboard", $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile page'
        ];

        return view("backend/profile", $data);
    }
}
