<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('company', function(){
            return new \App\Libraries\CompanyLibrary();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
