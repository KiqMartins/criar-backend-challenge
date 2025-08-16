<?php

namespace App\Domain\City\Contracts;
use App\Domain\City\Models\City;    
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface CityRepositoryInterface
{
    public function all(): Builder;
    public function find(int $id): ?City;
    public function create(array $data): City;
    public function update(int $id, array $data): City;
    public function delete(int $id): bool;
}