<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\View;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ProductPage extends Component  implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $products = [];
    public $order_items = 0;
    public function render()
    {
        $this->products = Product::all();
        $draftOrder = Order::myDraftOrder()->with('orderItems')->first(); // Load draft order with items

       
        if ($draftOrder) {
            
            $this->order_items = $draftOrder->orderItems->count();
        } else {
           
            $this->order_items = 0;
        }

        return view('livewire.product-page', [
            'products' => $this->products,
            'order_items' => $this->order_items,
        ]);
    }

    public function addToCartAction(): Action
    {
        return Action::make('addToCart')
            ->color('primary')

            // ->requiresConfirmation()
            ->form([


                TextInput::make('quantity')
                ->default(1)
                ->required()
                ->mask(9999)
                ->minValue(1)       // Minimum value of 1
                ->maxValue(10000),
            ])
            ->modalHeading(function (array $arguments) {
                $record = Product::find($arguments['record']);
                return $record->nameWithPrice()  ?? 'Add Product';
            })
            ->action(function (array $data, array $arguments) {


                $quantity = (int)$data['quantity'];
                $product = Product::findOrFail($arguments['record']);

                // Use DB transaction to ensure data integrity
                try {
                    DB::beginTransaction();

                    // Get the current user's draft order (cart)
                    $draft = Order::myDraftOrder()->first();

                    if ($draft) {
                        // Draft order exists, add the item to the order
                        $orderItem = OrderItem::where('order_id', $draft->id)
                            ->where('product_id', $product->id)
                            ->first();

                        if ($orderItem) {
                            // If the product is already in the order, update the quantity
                            $orderItem->quantity += $quantity;
                            $orderItem->save();
                        } else {
                            // If the product is not in the order, create a new order item
                            OrderItem::create([
                                'order_id' => $draft->id,
                                'product_id' => $product->id,
                                'quantity' => $quantity,
                                'price' => $product->price, // Save the current price
                            ]);
                        }
                    } else {
                        // No draft order exists, create a new one
                        $draft = Order::create([
                            'user_id' => Auth::id(),
                            'status' => Order::STATUS_DRAFT, // Ensure this is a valid ENUM or valid status type
                            'total_price' => 0.00,
                        ]);


                        // Add the product as the first item in the new draft order
                        OrderItem::create([
                            'order_id' => $draft->id,
                            'product_id' => $product->id,
                            'quantity' => $quantity,
                            'price' => $product->price,
                        ]);
                    }

                    // Recalculate the total price of the draft order
                    $draft->total_price = $draft->orderItems()->sum(DB::raw('quantity * price'));
                    $draft->save();

                    DB::commit(); // Commit the transaction

                    // Success notification
                    FilamentForm::notification('Product added to cart successfully!');

                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    DB::rollBack();
                    // Rollback transaction if something fails

                    // Log the error if needed (optional)
                    // Log::error($e->getMessage());

                    // Error notification
                    FilamentForm::error('Failed to add product to cart! Please try again.');

                    return redirect()->back()->with('error', 'Failed to add product to cart!');
                }
            });
    }
}
