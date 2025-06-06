<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Frame;

class HomeController extends Controller
{
    public function index()
    {

        $frames_qty_active = Frame::where('situation_id', 1)->get()->count();
        $frames_qty_inative = Frame::where('situation_id', 2)->get()->count();
        $loggedInUser = Auth::user();
        return view('home.home', [
            'loggedInUser' => $loggedInUser,
            'frames_qty_active' => $frames_qty_active,
            'frames_qty_inative' => $frames_qty_inative,
        ]);
    }
}
