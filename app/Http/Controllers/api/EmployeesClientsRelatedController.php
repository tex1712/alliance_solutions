<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ClientsCollection;
use App\Models\Employee;


class EmployeesClientsRelatedController extends Controller
{
    public function index(Employee $employee): ?ClientsCollection
    {
        if($employee->clients){
            return new ClientsCollection($employee->clients);
        }

        return NULL;


    }
}
