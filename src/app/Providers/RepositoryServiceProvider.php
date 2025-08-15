<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\State\Contracts\StateRepositoryInterface;
use App\Domain\State\Repositories\EloquentStateRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            StateRepositoryInterface::class,
            EloquentStateRepository::class
        );
    }
}