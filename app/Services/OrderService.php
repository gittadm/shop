<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getTotalPrice(Collection $orders): int
    {
        $totalPrice = 0;
        foreach ($orders as $order) {
            $totalPrice += $order->total_price;
        }
        return $totalPrice;
    }

    public function getOrders(): Collection
    {
        return Order::with('products')->orderBy('created_at', 'desc')->get();
    }

    public function store(array $products): Order
    {
        $orderProducts = [];
        foreach ($products as $product) {
            $orderProducts[$product['id']] = ['count' => $product['count']];
        }

        return DB::transaction(function () use ($orderProducts) {
            $order = Order::create();
            $order->products()->attach($orderProducts);
            return $order;
        });
    }
}
