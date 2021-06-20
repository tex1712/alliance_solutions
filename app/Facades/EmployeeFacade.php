<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Libraries\EmployeeLibrary;


class EmployeeFacade extends Facade
{

    protected static function getFacadeAccessor() { return 'employees'; }

}
