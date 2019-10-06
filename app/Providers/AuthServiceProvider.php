<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Passport::tokensExpireIn(now()->addDays(15));

        // Passport::refreshTokensExpireIn(now()->addDays(30));

        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        // Configuramos la expiración del token a 30 minutos.
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));

        // Con esto configuramos a 30 días el tiempo en el que usuario puede hacer
        // un refreshTokens luego que el token haya expirado, de lo contrario deberá 
        // agotar el flujo de autorización para obtener un nuevo token.
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
