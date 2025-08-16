<?php

namespace App\Domain\City\Services;

use App\Domain\City\Contracts\CityRepositoryInterface;
use App\Domain\City\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CityService 
{
    protected $cityRepository;

    public function __construct(private CityRepositoryInterface $repository)
    {
        $this->cityRepository = $repository;
    }

    public function getAllCities(): LengthAwarePaginator
    {
        $pagesCount = 100;

        return $this->cityRepository->all()->paginate($pagesCount);    
    }

    public function findCityById(int $id): ?City
    {
        return $this->cityRepository->find($id);
    }

    public function createCity(array $data): City
    {
        return $this->cityRepository->create($data);
    }

    public function updateCity(int $id, array $data): City
    {
        return $this->cityRepository->update($id, $data);
    }

    public function deleteCity(int $id): void
    {
        $this->cityRepository->delete($id);
    }
}