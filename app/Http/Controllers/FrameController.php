<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function index() {

        $loggedInUser = Auth::user();
        return view('frames.show_frames', [
            'loggedInUser' => $loggedInUser,
        ]);
    }
}