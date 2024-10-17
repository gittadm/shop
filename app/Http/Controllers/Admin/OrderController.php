<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {

    }

    public function index()
    {
        $orders = $this->orderService->getOrders();
        $totalPrice = $this->orderService->getTotalPrice($orders);

        return view('orders', compact('orders', 'totalPrice'));
    }

    public function delete(int $id)
    {
        Order::destroy($id);

        return redirect()->route('orders.index');
    }
}
