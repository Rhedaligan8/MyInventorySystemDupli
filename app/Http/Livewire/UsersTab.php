<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersTab extends Component
{
    use WithPagination;
    public $searchString = '';
    public $searchBy = "lastname";
    public $totalUsers;
    public $itemPerPage = 10;

    public $orderByString = 'date_created';
    public $orderBySort = 'desc';

    // edit user variables
    public $user_id, $username, $status, $role;

    protected $rules = [
        'username' => 'required|min:8|max:60|unique:user',
    ];

    protected $messages = [
        'username.required' => '*Username is required.',
        'username.max' => '*Username is too long.',
        'username.mim' => '*Username must be at least 8 characters.',
        'username.unique' => '*Username is already taken.',
    ];

    public function modifyUser()
    {
        $this->validate();
        $this->skipRender();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            $this->totalUsers = User::count();
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Delete Successful', 'message' => 'User was deleted successfully', 'type' => 'success']);
        }
    }

    public function refreshTable(): void
    {
        $this->resetPage();
    }

    public function searchFilter()
    {
        $this->refreshTable();
    }

    public function clearSearchString()
    {
        $this->searchString = "";
        $this->refreshTable();
    }

    public function redirectToManageUser($username)
    {
        return redirect()->route("manage-user", ['username' => $username]);
    }

    public function openEditUser($modal_name, $user_id)
    {
        // $user = User::find($user_id);
        // $this->user_id = $user->user_id;
        // $this->username = $user->username;
        // $this->status = $user->status;
        // $this->role = $user->role;
        // $this->dispatchBrowserEvent('openModal', ['name' => $modal_name]);

        $this->emit('openEditUser', $user_id);
    }

    public function closeEditUser($modal_name)
    {
        $this->user_id = '';
        $this->username = '';
        $this->status = '';
        $this->role = '';
        $this->dispatchBrowserEvent('closeModal', ['name' => $modal_name]);
        return $this->skipRender();
    }

    // setters

    public function setOrderBy($field)
    {
        $this->orderByString = $field;
    }

    public function setOrderBySort()
    {
        if ($this->orderBySort == "asc") {

            $this->orderBySort = "desc";
        } elseif ($this->orderBySort == "desc") {
            $this->orderBySort = "asc";

        }
    }

    public function getUsersProperty()
    {
        return DB::connection('mysql')
            ->table('user')
            ->join('infosys.employee', 'user.employee_id', '=', 'infosys.employee.employee_id')
            ->select('user.*', 'infosys.employee.firstname', 'infosys.employee.lastname')
            ->where($this->searchBy, 'like', $this->searchString . '%')
            ->orderBy($this->orderByString, $this->orderBySort)
            ->paginate($this->itemPerPage);
    }
    // system default methods

    public function createNewUser()
    {
        return redirect()->route('create-user');
    }

    public function updatedOrderBySort()
    {
        $this->refreshTable();
    }

    public function updatedOrderByString()
    {
        $this->refreshTable();
    }

    public function updatedItemPerPage()
    {
        $this->refreshTable();
    }

    public function updatedSearchBy()
    {
        $this->refreshTable();
    }

    public function mount()
    {
        $this->totalUsers = User::count();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('scrollToTop');

        return view('livewire.users-tab', ['users' => $this->users]);
    }
}