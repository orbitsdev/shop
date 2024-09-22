<?php

use App\Livewire\OrderList;
use App\Livewire\DraftOrder;
use App\Livewire\ProductPage;
use App\Livewire\OrderDetails;
use App\Livewire\OrderSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    
    if (auth()->check()) {
        
        return redirect()->route('dashboard');
    } else {
        // If not authenticated, redirect to login
        return redirect()->route('login');
    }
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if(Auth::user()->role=='Admin'){
            return redirect()->route('filament.admin.pages.dashboard');
        }else{
            
            return redirect()->route('product.index');
        //  return redirect()->route('');
        }
    })->name('dashboard');

    Route::get('products', ProductPage::class)->name('product.index');
    Route::get('/cart', DraftOrder::class)->name('draft-order');
    Route::get('/order-summary/{orderId}', OrderSummary::class)->name('order.summary');
    Route::get('/my-orders', OrderList::class)->name('orders.list');
    Route::get('/order-details/{orderId}', OrderDetails::class)->name('order.details');
    
});
