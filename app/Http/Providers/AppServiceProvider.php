<?php

namespace App\Providers;

use App\Models\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::define('isKasir', function($user) {
            return $user->role == 'kasir';
        });

        Auth::define('isPelanggan', function($user) {
            return $user->role == 'pelanggan';
        });
    }
}
