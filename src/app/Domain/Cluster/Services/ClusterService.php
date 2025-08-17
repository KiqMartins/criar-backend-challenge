<?php

namespace App\Domain\Cluster\Services;

use App\Domain\Cluster\Contracts\ClusterRepositoryInterface;
use App\Domain\Cluster\Models\Cluster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClusterService
{
    protected $clusterRepository;

    public function __construct(private ClusterRepositoryInterface $repository)
    {
        $this->clusterRepository = $repository;
    }

    public function getAllClusters(): LengthAwarePaginator
    {
        $pagesCount = 100;

        return $this->clusterRepository->all()->paginate($pagesCount);
    }

    public function findClusterById(int $id): ?Cluster
    {
        return $this->clusterRepository->find($id);
    }

    public function createCluster(array $data): Cluster
    {
        return $this->clusterRepository->create($data);
    }

    public function updateCluster(int $id, array $data): Cluster
    {
        return $this->clusterRepository->update($id, $data);
    }

    public function deleteCluster(int $id): void
    {
        $this->clusterRepository->delete($id);
    }
}
