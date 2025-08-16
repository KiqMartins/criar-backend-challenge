<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\State\Contracts\StateRepositoryInterface;
use App\Domain\State\Repositories\EloquentStateRepository;
use App\Domain\City\Contracts\CityRepositoryInterface;
use App\Domain\City\Repositories\EloquentCityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CityRepositoryInterface::class,
            EloquentCityRepository::class
        );

        $this->app->bind(
            StateRepositoryInterface::class,
            EloquentStateRepository::class
        );
    }
}