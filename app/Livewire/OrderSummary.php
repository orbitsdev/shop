<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderSummary extends Component
{

    public $order;
    
    public function mount($orderId)
    {
        // Fetch the specific order by ID
        $this->order = Order::where('id', $orderId)->where('user_id', Auth::id())->with('orderItems.product')->firstOrFail();
    }

    public function render()
    {
        return view('livewire.order-summary', [
            'order' => $this->order,
        ]);
    }
}
