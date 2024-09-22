<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderList extends Component
{
    public $orders;

    public function mount()
    {
        // Get all orders where the status is not draft
        $this->orders = Order::where('user_id', Auth::id())
                              ->where('status', '!=', Order::STATUS_DRAFT)
                              ->with('orderItems.product')
                              ->get();
    }

    public function render()
    {
        return view('livewire.order-list', [
            'orders' => $this->orders,
        ]);
    }
}
