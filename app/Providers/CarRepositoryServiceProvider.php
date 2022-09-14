<?php

namespace App\Providers;

use App\Domain\Car\CarRepositoryInterface;
use App\Repositories\CarRepository;
use Illuminate\Support\ServiceProvider;

class CarRepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
    }
}
