<?php

namespace App\Livewire\Admin\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public string $search = '';
    public int $paginateNumber = 10;

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $query = User::withCount('orders')->latest();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('firstname', 'like', '%'.$this->search.'%')
                  ->orWhere('lastname', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        $title = 'Delete User!';
        $text = "Are you sure you want to delete this user?";
        confirmDelete($title, $text);

        return view('livewire.admin.tables.users-table', [
            'users' => $query->paginate($this->paginateNumber),
        ]);
    }
}
