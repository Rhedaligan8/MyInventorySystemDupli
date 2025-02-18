<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Log;


class LoginForm extends Component
{

    public $username, $password;

    protected $rules = [
        "username" => "required",
        "password" => "required"
    ];

    protected $messages = [
        "username.required" => "*Username is required.",
        "password.required" => "*Password is required."
    ];

    public function login()
    {

        $this->username = trim($this->username);
        $this->password = trim($this->password);
        $this->validate();

        $user = User::where("username", $this->username)->first();

        // check username
        if (!$user) {
            $this->addError("username", "*Username does not exists.");
            return;
        }
        // check password if it has user
        if (!Hash::check($this->password, $user->password)) {
            $this->addError("password", "*Password incorrect.");
            return;
        } else {
            Auth::login($user);
            redirect()->intended("dashboard");
        }
    }

    public function render()
    {
        return view('livewire.login_form');
    }

}
