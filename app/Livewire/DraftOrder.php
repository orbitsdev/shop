<?php

namespace App\Livewire;

use App\Http\Controllers\FilamentForm;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class DraftOrder extends Component
{   

    public $draftOrder;
    public $orderItems = [];
    
    public function mount()
    {
        $this->loadDraftOrder();
    }

    public function loadDraftOrder()
    {
        
        $this->draftOrder = Order::myDraftOrder()->with('orderItems.product')->first();

       
        if ($this->draftOrder) {
            $this->orderItems = $this->draftOrder->orderItems;
        } else {
            $this->orderItems = [];
        }
    }

    
    public function incrementQuantity($itemId)
    {
        $orderItem = OrderItem::findOrFail($itemId);
        $orderItem->quantity += 1;
        $orderItem->save();

        $this->updateTotalPrice(); 
        $this->loadDraftOrder(); 
    }

    
    public function decrementQuantity($itemId)
    {
        $orderItem = OrderItem::findOrFail($itemId);

      
        if ($orderItem->quantity > 1) {
            $orderItem->quantity -= 1;
            $orderItem->save();
        }

        $this->updateTotalPrice(); 
        $this->loadDraftOrder();
    }

  
    public function deleteItem($itemId)
    {
        $orderItem = OrderItem::findOrFail($itemId);
        $orderItem->delete();

        FilamentForm::notification('Item Was Remove');

        $this->updateTotalPrice(); 
        $this->loadDraftOrder(); 
    }

    
    public function updateTotalPrice()
    {
        if ($this->draftOrder) {
            $this->draftOrder->total_price = $this->draftOrder->orderItems()->sum(DB::raw('quantity * price'));
            $this->draftOrder->save();
        }
    }
    public function render()
    {
        return view('livewire.draft-order',
    [
        'draftOrder' => $this->draftOrder,
        'orderItems' => $this->orderItems,
    ]
    );
    }

    public function placeOrder()
{
    if ($this->draftOrder) {
        // Change the order status from 'draft' to 'pending'
        $this->draftOrder->status = Order::STATUS_PENDING;
        $this->draftOrder->save();

        // Optionally, you can reset the orderItems array after placing the order
        $this->orderItems = [];

        // Notification or redirection after successfully placing the order
        session()->flash('success', 'Your order has been placed successfully!');

        // You can redirect to another page or stay on the same page
        return redirect()->route('order.summary', ['orderId' => $this->draftOrder->id]);
    } else {
        // Show error if there's no draft order
        session()->flash('error', 'No draft order to place.');
    }
}

}
