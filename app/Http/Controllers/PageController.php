<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function viewLoginPage()
    {
        return view('livewire.login');
    }

    public function viewDashboardPage()
    {
        return view('livewire.dashboard');
    }
}
