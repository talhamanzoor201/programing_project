<?php

namespace App\Providers;

use App\OnlineUser;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Event::listen(Login::class, function () {
            if (Auth::check())
                OnlineUser::create(['user_id' => Auth::id()]);
        });

        Event::listen(Logout::class, function () {
            if (Auth::check())
                OnlineUser::where('user_id', Auth::id())->delete();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
