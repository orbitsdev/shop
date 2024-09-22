<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_DRAFT = 'draft';
    const STATUS_AWAITING_CONFIRMATION = 'awaiting_confirmation';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PAID = 'paid';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    const ORDER_STATUS_OPTION = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_AWAITING_CONFIRMATION => 'Awaiting Confirmation',
        self::STATUS_CONFIRMED => 'Confirmed',
        self::STATUS_PAID => 'Paid',
        self::STATUS_SHIPPED => 'Shipped',
        self::STATUS_DELIVERED => 'Delivered',
        self::STATUS_CANCELLED => 'Cancelled',
    ];


    public function scopeMyDraftOrder($query)
{
    return $query->where('user_id', Auth::id())->where('status', self::STATUS_DRAFT);
}


public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
