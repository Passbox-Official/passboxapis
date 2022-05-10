<?php

namespace App\Providers;

use App\Services\Responser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Services\User;
use App\Services\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::unguard();

        // Facades
        $this->app->bind('user', function () {
            return new User();
        });

        $this->app->bind('responser', function () {
            return new Responser();
        });

        $this->app->bind('password-service', function () {
            return new Password();
        });
    }
}
