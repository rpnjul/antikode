<?php
namespace App\Repositories\Brand;
use Illuminate\Support\ServiceProvider;

class BrandRepoServiceProvider extends ServiceProvider{
    
    public function boot(){

    }

    public function register(){
        $this->app->bind('App\Repositories\Brand\BrandInterface', 
        'App\Repositories\Brand\BrandRepository');
    }
}