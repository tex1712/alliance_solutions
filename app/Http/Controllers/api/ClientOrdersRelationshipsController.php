<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderIdentifierResource;
use App\Models\Client;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientOrdersRelationshipsController extends Controller
{
    public function index(Client $client): ?AnonymousResourceCollection
    {
        if(!empty($client->orders)){
            return OrderIdentifierResource::collection($client->orders);
        }

        return NULL;
    }
}
