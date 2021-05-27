<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function handleLogin(LoginRequest $request)
    {

        $checkUser = Auth::attempt($request->validated());
        if (!$checkUser) {

            alert()->error('Oups', 'Check your credentials')->persistent(true);
            return redirect()->back();
        }
        $authenticatedUser = Auth::user();
        return redirect()->route('showHome');

    }

    public function handleLogout()
    {

        Auth::logout();
        return redirect()->back();
    }

}
