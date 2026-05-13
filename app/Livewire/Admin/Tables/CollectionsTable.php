<?php

namespace App\Livewire\Admin\Tables;

use App\Models\Collection;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionsTable extends Component
{
    use WithPagination;

    public string $search = '';

    public int $paginateNumber = 10;
    #[Locked]
    public string $sortField = 'name';

    #[Locked]
    public string $sortDirection = 'ASC';

    public array $sortableFields = ['name'];

    public function sortBy($sortField)
    {
        if (!in_array($sortField, $this->sortableFields)) {
            return;
        }

        $this->resetPage();

        if ($sortField === $this->sortField) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortDirection = 'ASC';
            $this->sortField = $sortField;
        }
    }

    public function render()
    {
        $query = Collection::latest()->orderBy($this->sortField, $this->sortDirection);

        if ($this->search) {
            $query->whereLike('name', '%' . $this->search . '%');
        }

        $title = 'Delete!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('livewire.admin.tables.collections-table', [
            'collections' => $query->paginate($this->paginateNumber)
        ]);
    }
}
