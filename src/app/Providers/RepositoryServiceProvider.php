<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\State\Contracts\StateRepositoryInterface;
use App\Domain\State\Repositories\EloquentStateRepository;
use App\Domain\City\Contracts\CityRepositoryInterface;
use App\Domain\City\Repositories\EloquentCityRepository;
use App\Domain\Cluster\Repositories\EloquentClusterRepository;
use App\Domain\Cluster\Contracts\ClusterRepositoryInterface;
use App\Domain\Campaign\Repositories\EloquentCampaignRepository;
use App\Domain\Campaign\Contracts\CampaignRepositoryInterface;
use App\Domain\Discount\Contracts\DiscountRepositoryInterface;
use App\Domain\Discount\Repositories\EloquentDiscountRepository;

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

        $this->app->bind(
            ClusterRepositoryInterface::class,
            EloquentClusterRepository::class
        );

        $this->app->bind(
            CampaignRepositoryInterface::class,
            EloquentCampaignRepository::class
        );

        $this->app->bind(
            DiscountRepositoryInterface::class,
            EloquentDiscountRepository::class
        );
    }
}