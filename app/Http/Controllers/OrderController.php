<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {

    }

    public function index()
    {
        return view('order');
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->store($request->validated('products'));

        return response()->json(['order_id' => $order->id]);
    }
}
