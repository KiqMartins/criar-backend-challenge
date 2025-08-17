<?php

namespace App\Domain\Cluster\Contracts;

use App\Domain\Cluster\Models\Cluster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface ClusterRepositoryInterface 
{
    public function all(): Builder;
    public function find(int $id): ?Cluster;
    public function create(array $data): Cluster;
    public function update(int $id, array $data): Cluster;
    public function delete(int $id): bool;
}