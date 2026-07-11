<?php

namespace App\Providers;

use App\Models\Setting;
use App\View\Composers\AdminComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(!$this->app->isProduction());

        View::composer('layouts.sidebar', AdminComposer::class);
    }
}