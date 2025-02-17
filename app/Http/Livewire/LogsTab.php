<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Log;
use App\Models\User;
use Livewire\WithPagination;

class LogsTab extends Component
{
    use WithPagination;

    public $check = "from child";
    public $user_id;

    public $username;
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

    public function goToUserLogs($username)
    {
        return redirect()->route('user-logs', ['username' => $this->username]);
    }

    public function mount()
    {
        $this->totalLogs = Log::count();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('scrollToTop');
        return view('livewire.logs-tab', [
            'logs' => Log::with('user')->join('users', 'logs.user_id', '=', 'users.id')->select('logs.*', 'users.name', 'users.username')->where('logs.' . $this->searchBy, 'like', $this->searchString . '%')->orderBy($this->orderByString, $this->orderBySort)->paginate($this->itemPerPage)
        ]);
    }
}
