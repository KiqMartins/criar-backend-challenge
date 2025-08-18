<?php

namespace App\Domain\Campaign\Contracts;

use App\Domain\Campaign\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface CampaignRepositoryInterface 
{
    public function all(): Builder;
    public function find(int $id): ?Campaign;
    public function create(array $data): Campaign;
    public function update(int $id, array $data): Campaign;
    public function delete(int $id): bool;
    public function findActiveByCluster(int $clusterId, ?int $campaignIdToIgnore = null): ?Campaign;
}