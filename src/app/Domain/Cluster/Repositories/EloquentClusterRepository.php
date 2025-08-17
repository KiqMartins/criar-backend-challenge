<?php 

namespace App\Domain\Cluster\Repositories;

use App\Domain\Cluster\Models\Cluster;
use App\Domain\Cluster\Contracts\ClusterRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class EloquentClusterRepository implements ClusterRepositoryInterface
{
    public function all(): Builder
    {
        return Cluster::query();
    }

    public function find(int $id): ?Cluster
    {
        return Cluster::with('cities:id,name,cluster_id')->find($id);
    }

    public function create(array $data): Cluster
    {
        return Cluster::create($data);
    }

    public function update(int $id, array $data): Cluster
    {
        $cluster = Cluster::find($id);
        $cluster->update($data);

        return $cluster;
    }

    public function delete(int $id): bool
    {
        $cluster = Cluster::find($id);

        return $cluster->delete();  
    }
}