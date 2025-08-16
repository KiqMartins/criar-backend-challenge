<?php

namespace App\Domain\City\Repositories;

use App\Domain\City\Contracts\CityRepositoryInterface;
use App\Domain\City\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class EloquentCityRepository implements CityRepositoryInterface
{
    public function all(): Builder
    {
        return City::query();
    }

    public function find(int $id): ?City
    {
        return City::find($id);
    }

    public function create(array $data): City
    {
        return City::create($data);
    }

    public function update(int $id, array $data): City
    {
        $city = City::find($id);
        $city->update($data);

        return $city;
    }

    public function delete(int $id): bool
    {
        $city = City::find($id);
        return $city->delete();
    }
}