<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\MatchingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $r, MatchingService $m): JsonResponse {
        $data = $r->validated();
        $data['user_id'] = auth()->id() ?? 1; // demo
        $order = Order::create($data);
        $trade = $m->tryMatch($order);
        return response()->json(['order'=>$order->fresh(), 'trade'=>$trade], 201);
      }
}
