<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ClientIdentifierResource;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class EmployeesClientsRelationshipsController extends Controller
{
    public function index(Employee $employee): ?AnonymousResourceCollection
    {
        if(!empty($employee->clients)){
            return ClientIdentifierResource::collection($employee->clients);
        }

        return NULL;
    }
}
