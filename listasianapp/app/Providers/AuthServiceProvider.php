<?php

namespace App\Providers;

use App\Models\Advert;
use App\Policies\AdvertPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //\App\Models\Advert::class => \App\Policies\AdvertPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    // public function create(User $user)
    // {
    //     return $user->role === 'admin';
    // }
}