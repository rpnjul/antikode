<?php
namespace App\Repositories\Outlet;
use Illuminate\Support\ServiceProvider;

class OutletRepoServiceProvider extends ServiceProvider{
    
    public function boot(){

    }

    public function register(){
        $this->app->bind('App\Repositories\Outlet\OutletInterface', 
        'App\Repositories\Outlet\OutletRepository');
    }
}