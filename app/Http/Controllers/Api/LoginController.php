<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        /*$result = Auth::attempt([
            'username' => $request->post('username'),
            'password' => $request->post('password'),
        ]);
        if (!$result) {
            return [
                'error' => __('Invalid username or password.'),
            ];
        }*/
        $user = User::where('username', $request->post('username'))->first();
        if (!$user) {
            return [
                'error' => __('Invalid username or password.'),
            ];
        }

        if (!Hash::check($request->post('password'), $user->password)) {
            return [
                'error' => __('Invalid username or password.'),
            ];
        }

        //$user = Auth::user();
        if (!$user->api_token) {
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();
        }
        
        // Require add to $fillable
        /*$user->update([
            'api_token' => $token,
        ]);*/

        return [
            'api_token' => $user->api_token,
        ];
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();

        return [
            'message' => 'Ok',
        ];
    }
}
