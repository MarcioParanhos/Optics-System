<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Models
use App\Models\Brand;

class FrameController extends Controller
{
    public function index() {
        
        $brands = Brand::all();
        $loggedInUser = Auth::user();
        return view('frames.show_frames', [
            'loggedInUser' => $loggedInUser,
            'brands' => $brands,
        ]);
    }
}