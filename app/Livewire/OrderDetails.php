<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderDetails extends Component
{
    public $order;

    public function mount($orderId)
    {
        // Load the specific order by its ID and make sure the user is authorized
        $this->order = Order::where('id', $orderId)
                             ->where('user_id', Auth::id())
                             ->with('orderItems.product')
                             ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.order-details', [
            'order' => $this->order,
        ]);
    }
}
