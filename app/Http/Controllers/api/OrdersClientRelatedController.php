<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Order;

class OrdersClientRelatedController extends Controller
{
    public function index(Order $order): ?ClientResource
    {
        if ($order->client) {
            return new ClientResource($order->client);
        }

        return NULL;
    }
}
