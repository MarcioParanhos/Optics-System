<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DailyCashierController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();
        return view('daily_cashiers.daily_cashiers_show', [
            'loggedInUser' => $loggedInUser,
        ]);
    }
}
