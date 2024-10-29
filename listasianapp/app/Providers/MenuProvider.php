<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lavary\Menu\Menu;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Menu $menu)
    {
        $menu->make('MyNavBar', function ($menu) {
            $menu->add('HOME', ['url' => url('/')]);
            $menu->add('DIRECTORY', 'directory');
            $menu->add('REGISTER', 'register');
            $menu->add('LOGIN', 'login');
        });
    }
}
