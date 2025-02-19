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

    protected $listeners = ['refreshUsers' => 'refreshTable'];

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

    public function openEditUser($user_id)
    {

        $this->emit('openEditUser', $user_id);
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

    public function createNewUser()
    {
        return redirect()->route('create-user');
    }

    // system default methods

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