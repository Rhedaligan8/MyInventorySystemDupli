<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class UsersTab extends Component
{
    use WithPagination;
    public $searchString = '';
    public $itemPerPage = 10;
    public $totalUsers;

    public $orderByString = 'created_at';
    public $orderBySort = 'desc';

    public $searchBy = "name";

    public function mount()
    {
        $this->totalUsers = User::count();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            $this->totalUsers = User::count();
            $this->dispatchBrowserEvent('showNotification', ['title' => 'Delete Successful', 'message' => 'User was deleted successfully', 'type' => 'success']);
        }
    }

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
        // return view('livewire.users-tab', [
        //     'users' => User::where($this->searchBy, 'like', $this->searchString . '%')->orderBy($this->orderByString, $this->orderBySort)->paginate($this->itemPerPage)
        // ]);

        return view('livewire.users-tab', [
            'users' => DB::table('equipmentinventory.user')
                ->join('infosys.employee', 'equipmentinventory.user.user_id', '=', 'infosys.employee.employee_id')->paginate()
        ]);




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

    public function createNewUser()
    {
        return redirect()->route('create-user');
    }
}

