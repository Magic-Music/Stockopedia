<?php

namespace App\Providers;

use App\Repositories\SecuritiesRepository;
use App\Repositories\SecuritiesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SecuritiesRepositoryInterface::class, SecuritiesRepository::class);
    }
}
