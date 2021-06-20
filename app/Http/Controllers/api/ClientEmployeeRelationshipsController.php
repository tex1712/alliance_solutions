<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Resources\EmployeeIdentifierResource;
use App\Models\Client;

class ClientEmployeeRelationshipsController extends Controller
{
    public function index(Client $client): ?EmployeeIdentifierResource
    {
        if($client->employee){
            return new EmployeeIdentifierResource($client->employee);
        }

        return null;

    }
}
