<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function viewLoginPage()
    {
        return view('pages.login');
    }

    public function viewDashboardPage()
    {
        return view('livewire.dashboard');
    }

    public function viewManageUserPage($username)
    {
        return view('pages.manage-user', ['username' => $username]);
    }

    public function viewUserLogsPage($username)
    {
        return view('pages.user-logs', data: ['username' => $username]);
    }

    public function viewCreateUser()
    {
        return view('pages.create-user');
    }
}
