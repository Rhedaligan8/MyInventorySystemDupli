<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ModifyUser extends Component
{
    public $user_id, $username, $status, $role;
    public $isOpen = false; // Track modal state

    protected $listeners = ['openEditUser']; // Listen for events from the table component

    protected $rules = [
        'username' => 'required|min:8|max:60|unique:user,username,{{user_id}},user_id',
    ];

    public function openEditUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $this->user_id = $user->user_id;
            $this->username = $user->username;
            $this->status = $user->status;
            $this->role = $user->role;
            $this->isOpen = true;
        }
    }

    public function modifyUser()
    {
        $this->validate();

        $user = User::find($this->user_id);
        if ($user) {
            $user->username = $this->username;
            $user->status = $this->status;
            $user->role = $this->role;
            $user->save();
        }

        // Emit event to table component to refresh data
        $this->emit('refreshUsers');

        // Keep modal open and show success message
        $this->dispatchBrowserEvent('showNotification', [
            'title' => 'User Updated',
            'message' => 'User details updated successfully.',
            'type' => 'success'
        ]);
    }

    public function closeModal()
    {
        $this->reset(); // Reset fields
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modify-user');
    }
}
