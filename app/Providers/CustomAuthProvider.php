<?php namespace App\Providers;

use App\User;
use App\Providers\CustomUserProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Hashing\BcryptHasher;

class CustomAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('custom',function($app)
        {
            $model = $app['config']['auth.model'];
            // return new CustomUserProvider($app['hash'], new $model);
            // return new CustomUserProvider(new BcryptHasher,  new $model);
            return new CustomUserProvider(new BcryptHasher,  new $model);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}

