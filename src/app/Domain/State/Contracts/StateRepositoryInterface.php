<?php

namespace App\Domain\State\Contracts;
use App\Domain\State\Models\State;
use Illuminate\Database\Eloquent\Collection;

interface StateRepositoryInterface
{   
    public function all(): collection;
    public function find(int $id): ?State;
    public function create(array $data): State;
    public function update(int $id, array $data): State;
    public function delete(int $id): bool;
}