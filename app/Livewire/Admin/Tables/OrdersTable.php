<?php

namespace App\Livewire\Admin\Tables;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $paymentFilter = '';
    public int $paginateNumber = 10;

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
    public function updatingPaymentFilter() { $this->resetPage(); }

    public function render()
    {
        $query = Order::with('user')->latest();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('id', 'like', '%'.$this->search.'%')
                  ->orWhere('guest_email', 'like', '%'.$this->search.'%')
                  ->orWhere('guest_firstname', 'like', '%'.$this->search.'%')
                  ->orWhere('guest_lastname', 'like', '%'.$this->search.'%')
                  ->orWhereHas('user', fn($u) => $u->where('email', 'like', '%'.$this->search.'%')
                      ->orWhere('firstname', 'like', '%'.$this->search.'%'));
            });
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->paymentFilter) {
            $query->where('payment_status', $this->paymentFilter);
        }

        $title = 'Delete Order!';
        $text = "Are you sure you want to delete this order?";
        confirmDelete($title, $text);

        return view('livewire.admin.tables.orders-table', [
            'orders' => $query->paginate($this->paginateNumber),
        ]);
    }
}
