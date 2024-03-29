<?php

namespace App\Providers;

use App\User;
use App\Product;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        User::created(function($user){

            retry(5, function() use ($user){ // reintentamos 5 veces cada 100 milisegundo
                Mail::to($user)->send(new UserCreated($user));
            }, 100);
            
        });

        User::updated(function($user){

            retry(5, function() use ($user){
                if($user->isDirty('email'))
                    Mail::to($user)->send(new UserMailChanged($user));
            }, 100);
            
        });
        
        Product::updated(function($product){
            if($product->quantity == 0 && $product->estaDisponible()){
                $product->status = Product::PRODUCTO_NO_DISPONIBLE;

                $product->save();
            }
        });

    }
}
