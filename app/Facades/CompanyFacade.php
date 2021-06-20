<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Libraries\CompanyLibrary;


class CompanyFacade extends Facade
{

    protected static function getFacadeAccessor() { return 'company'; }

}
