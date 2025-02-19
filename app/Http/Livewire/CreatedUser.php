<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreatedUser extends Component
{

    public $name;
    public $username;
    public $role = "staff";
    public $status = "active";

    protected $rules = [
        "username" => "required|max:50|min:8|unique:users|regex:/^\S*$/",
        "role" => "required",
        "status" => "required",
    ];

    protected $messages = [
        "name.required" => "*Name is required.",
        "name.max" => "*Name is too long.",
        "username.required" => "*Password is required.",
        "username.max" => "*Username is too long.",
        "username.min" => "*Username must be at least 8 characters.",
        "username.unique" => "*Username is already taken.",
        "username.regex" => "*Username must not contain any spaces.",
    ];

    public function createUser()
    {
        $this->name = trim($this->name);
        $this->username = trim($this->username);

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'role' => $this->role,
            'status' => $this->status,
            'password' => Hash::make($this->username . "-password")
        ]);

        if ($user) {
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Create new user success', 'message' => 'A new user was added to the database successfully', 'type' => 'success']);
            $log = new Log(['description' => "User logged in."]);
            Auth::user()->logs()->save($log);

            $this->name = "";
            $this->username = "";
            $this->role = "staff";
            $this->status = "active";
        } else {
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Create new user error', 'message' => 'A new user was not added to the database.', 'type' => 'error']);
        }
    }

    public function backToDashboard()
    {
        return redirect()->route('dashboard');
    }

    public function render()
    {
        if (Auth::user()->role == 1) {
            return view('livewire.created-user');
        }
        return redirect()->route("dashboard");
    }
}
