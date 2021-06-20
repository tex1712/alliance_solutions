<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ClientIdentifierResource;
use App\Models\Order;

class OrdersClientRelationshipsController extends Controller
{
    public function index(Order $order): ?ClientIdentifierResource
    {
        if($order->client){
            return new ClientIdentifierResource($order->client);
        }

        return null;

    }
}
