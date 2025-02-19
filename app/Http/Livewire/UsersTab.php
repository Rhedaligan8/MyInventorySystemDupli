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

    public function render()
    {
        $this->dispatchBrowserEvent('scrollToTop');

        return view('livewire.users-tab', [
            'users' => DB::connection('mysql')->table('user')
                ->join('infosys.employee', 'user.employee_id', '=', 'infosys.employee.employee_id')
                ->select('user.*', 'infosys.employee.firstname', 'infosys.employee.lastname')->where(
                    $this->searchBy,
                    'like',
                    $this->searchString . '%'
                )->orderBy($this->orderByString, $this->orderBySort)
                ->paginate($this->itemPerPage)
        ]);
    }

    public function mount()
    {
        $this->totalUsers = User::count();
    }
}

