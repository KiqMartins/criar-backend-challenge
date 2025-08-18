<?php

namespace App\Domain\Campaign\Repositories;

use App\Domain\Campaign\Models\Campaign;
use App\Domain\Campaign\Contracts\CampaignRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class EloquentCampaignRepository implements CampaignRepositoryInterface
{
    public function all(): Builder
    {
        return Campaign::query();
    }

    public function find(int $id): ?Campaign
    {
        return Campaign::with('discount')->find($id);
    }

    public function create(array $data): Campaign
    {
        return Campaign::create($data);
    }

    public function update(int $id, array $data): Campaign
    {
        $campaign = Campaign::find($id);
        $campaign->update($data);

        return $campaign;
    }

    public function delete(int $id): bool
    {
        $campaign = Campaign::find($id);
        return $campaign->delete();
    }

    public function findActiveByCluster(int $clusterId, ?int $campaignIdToIgnore = null): ?Campaign
    {
        return Campaign::where('cluster_id', $clusterId)
            ->where('is_active', true)
            ->when($campaignIdToIgnore, function ($query, $ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->first();
    }
}