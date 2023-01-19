<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        App::singleton('client_id',function(){
        return Client::where('id',auth('api')->user()->id);
        });
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        $settings=Setting::first();
        view()->share(compact('settings'));
    
    }
}
