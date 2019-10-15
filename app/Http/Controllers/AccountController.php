<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function profile($username = null)
    {
        if (!$username) {
            if (!Auth::check()) {
                return route('login');
            }
            $username = Auth::user()->username;
        }
        $user = User::where('username', $username)->first();
        if (!$user) {
            abort(404);
        }
        return view('account.profile', [
            'user' => $user,
        ]);
    }
}
