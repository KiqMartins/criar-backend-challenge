<?php

namespace App\Http\Resources\Campaign;

use App\Http\Resources\ClusterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'clusterId' => $this->cluster_id,
            'cluster' => new ClusterResource($this->whenLoaded('cluster')),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}