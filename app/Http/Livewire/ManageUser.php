<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ManageUser extends Component
{
    public $user;
    public $user_id;
    public $name;
    public $username;
    public $role;
    public $status;
    public $created_at;
    public $updated_at;

    protected $rules = [
        "name" => "required|max:255",
        "username" => "required|max:255|min:8|unique:users|regex:/^\S*$/",
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
        "role.required" => "*Password is required.",
        "status.required" => "*Password is required.",
    ];

    public function updateUser()
    {
        // check if fields changed
        if ($this->user->name != $this->name || $this->user->username != $this->username || $this->user->role != $this->role || $this->user->status != $this->status) {
            $this->name = trim($this->name);
            $this->username = trim($this->username);
            $this->role = trim($this->role);
            $this->status = trim($this->status);

            $this->validate();

            $updatedUser = User::where("id", $this->user_id)->update([
                'name' => $this->name,
                'username' => $this->username,
                'role' => $this->role,
                'status' => $this->status,
            ]);

            if ($updatedUser) {
                $this->dispatchBrowserEvent('showNotification', ['title' => 'Update Successful', 'message' => 'User was updated successfully', 'type' => 'success']);
                $log = new Log([
                    'description' => "Updated a user -> old(Name: {$this->user->name} Username: {$this->user->username} Role: {$this->user->role} Status: {$this->user->status}) : new(Name: {$this->name} Username: {$this->username} Role: {$this->role} Status: {$this->status})"
                ]);
                Auth::user()->logs()->save($log);

                $user = User::firstWhere('username', $this->username);
                if ($user) {
                    $this->user = $user;
                    $this->updated_at = $user->updated_at;
                }
            } else {
                $this->dispatchBrowserEvent('showNotification', ['title' => 'Update failed', 'message' => 'User was updated', 'type' => 'error']);
            }
        }
    }

    public function resetPassword()
    {
        $isPasswordResetSuccess = User::where('id', $this->user_id)->update([
            'password' => Hash::make($this->user->username . "-password"),
        ]);

        if ($isPasswordResetSuccess) {
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Reset password success', 'message' => 'User password was changed', 'type' => 'success']);

            $log = new Log(['description' => "Reset password for " . $this->user->name]);
            Auth::user()->logs()->save($log);

            $user = User::firstWhere('id', $this->user_id);
            if ($user) {
                $this->user = $user;
                $this->updated_at = $user->updated_at;
            }
        } else {
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Reset password failed', 'message' => 'User password was not changed', 'type' => 'error']);
        }
    }

    public function backToDashboard()
    {
        return redirect()->route('dashboard');
    }

    public function goToUsersLogs()
    {
        return redirect()->route('user-logs', ['username' => $this->username]);
    }

    public function mount($username)
    {
        $user = User::firstWhere('username', $username);
        if ($user) {
            $this->user = $user;
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->username = $user->username;
            $this->role = $user->role;
            $this->status = $user->status;
            $this->created_at = Carbon::parse($user->created_at)->format("Y-m-d H:i:s");
            $this->updated_at = Carbon::parse($user->updated_at)->format("Y-m-d H:i:s");
        }
    }

    public function render()
    {
        return view('livewire.manage-user');
    }
}
