<?php

namespace App\Models\Presenters;

use App\Models\Order;

class OrderPresenter
{
    public function __construct(protected Order $order)
    {
        //
    }

    public function status()
    {
        return match ($this->order->status()) {
            'placed_at' => 'Order Placed',
            'packaged_at' => 'Order Packaged',
            'shipped_at' => 'Order Shipped',
            default => ''
        };
    }
}
