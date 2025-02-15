<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class UserController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            $log = new Log(['description' => "User logged out."]);
            Auth::user()->logs()->save($log);
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect(to: "/");
        }
    }
}
