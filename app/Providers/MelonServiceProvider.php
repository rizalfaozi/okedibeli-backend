<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use App\Auth\MelonUserProvider;

class MelonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('melon', function () {
            return new MelonUserProvider();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function login()
    {
        echo "<pre/>";print_r("login");die();
    }
}


