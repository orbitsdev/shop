<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderItems extends Component
{
    public $order_items_count = 0;

    public function loadDraftOrderItems()
    {
        // Fetch the current user's draft order
        $draftOrder = Order::myDraftOrder()->with('orderItems')->first();

        // Count the number of distinct items in the draft order
        if ($draftOrder) {
            $this->order_items_count = $draftOrder->orderItems->count();
        } else {
            $this->order_items_count = 0; // No draft order, no items
        }
    }

    public function render()
    {
        // Call loadDraftOrderItems to ensure updated count on render
        $this->loadDraftOrderItems();

        return view('livewire.order-items', [
            'order_items_count' => $this->order_items_count,
        ]);
    }
}
