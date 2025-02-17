<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Log;
use App\Models\User;
use Livewire\WithPagination;

class UserLogs extends Component
{
    use WithPagination;

    public $check = "from child";
    public $user_id;

    public $username;
    public $name;
    public $searchString = '';
    public $itemPerPage = 10;
    public $totalLogs;

    public $orderByString = 'created_at';
    public $orderBySort = 'desc';

    public $searchBy = "description";

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

    public function backToDashboard()
    {
        return redirect()->route('dashboard');
    }
    public function backToManageProfile()
    {
        return redirect()->route("manage-user", ['username' => $this->username]);
    }

    public function mount($username)
    {
        $user = User::firstWhere('username', $username);
        if (!$user) {
            abort(404);
        }
        $this->username = $username;
        $this->name = $user->name;
        $this->user_id = $user->id;
        $this->totalLogs = Log::where("user_id", $user->id)->count();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('scrollToTop');
        return view('livewire.user-logs', [
            'logs' => Log::where($this->searchBy, 'like', $this->searchString . '%')->where("user_id", $this->user_id)->orderBy($this->orderByString, $this->orderBySort)->paginate($this->itemPerPage)
        ]);

    }

}
