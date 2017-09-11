<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Billing\Stripe;
use Psy\Util\Str;

class AppServiceProvider extends ServiceProvider
{
    protected $defer = true;    // resolution is delayed and executed when necessary

    /**
     * Bootstrap any application services.
     * when any view is loaded with View Composer, listen to the hook and pass function/class path
     * view()->composer('hook', function());
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view){
            $archives = \App\Post::archives();
            $tags = \App\Tag::has('posts')->pluck('name');

            $view->with(compact('archives', 'tags'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Service Container: Binding App with Stripe class
         * Inside service provider App::bind facade or $this->app helper function can be used
         *
        App::bind('App\Billing\Stripe', function(){
            return new \App\Billing\Stripe(config('services.stripe.secret'));
        });
         * Above can also be written as:
         * also the closure can accept $app parameter i.e. function($app)
         */
        $this->app->bind(Stripe::class, function(){
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
