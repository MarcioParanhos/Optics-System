<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index () {
        
        $loggedInUser = Auth::user();
        $users = User::where('situation', 'Active')->get();

        return view('users.show_users', [
            'loggedInUser' => $loggedInUser,
            'users' => $users,
        ]);
    }
}
