<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $loggedInUser = Auth::user();
        return view('home.home', [
            'loggedInUser' => $loggedInUser,
        ]);
    }
}
