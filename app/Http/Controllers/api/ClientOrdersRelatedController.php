<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersCollection;
use App\Models\Client;

class ClientOrdersRelatedController extends Controller
{
    public function index(Client $client): ?OrdersCollection
    {
        if($client->orders){
            return new OrdersCollection($client->orders);
        }

        return NULL;


    }
}
