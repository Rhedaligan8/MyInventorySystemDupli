<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect(to: "/");
        }
    }
}
