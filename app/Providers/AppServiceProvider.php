<?php

namespace App\Providers;

use App\Facades\Supplements\AppLozic;
use App\Facades\Supplements\QuickBlox;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindAppLozic();
        $this->bindQuickBlox();

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    protected function bindAppLozic()
    {
        $this->app->singleton(AppLozic::class, function () {
            return new AppLozic(env('APP_LOZIC_ID'));
        });
    }

    private function bindQuickBlox()
    {
        $this->app->singleton(QuickBlox::class, function () {
            return new QuickBlox();
        });
    }
}
