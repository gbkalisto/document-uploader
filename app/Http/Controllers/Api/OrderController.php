<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{

    public $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request, $slug)
    {
        $start = microtime(true);
        $user = $request->user();
        $product = Product::where('slug', $slug)->firstOrFail();
        Log::info('Product fetch took: ' . (microtime(true) - $start));

        $orderStart = microtime(true);
        $order = $this->orderService->processOrder($user, $product);
        Log::info('Order process took: ' . (microtime(true) - $orderStart));

        return response()->json(['message' => 'order created']);
    }
}
