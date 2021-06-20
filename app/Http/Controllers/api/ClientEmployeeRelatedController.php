<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Client;


class ClientEmployeeRelatedController extends Controller
{
    public function index(Client $client): ?EmployeeResource
    {
        if ($client->employee) {
            return new EmployeeResource($client->employee);
        }

        return NULL;
    }
}
