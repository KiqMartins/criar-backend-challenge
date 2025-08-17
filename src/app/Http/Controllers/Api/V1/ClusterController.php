<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Cluster\Models\Cluster;
use App\Domain\Cluster\Services\ClusterService;
use App\Http\Requests\Cluster\StoreClusterRequest;
use App\Http\Requests\Cluster\UpdateClusterRequest;
use App\Http\Resources\ClusterResource;
use App\Http\Resources\ClusterCollection;
use Illuminate\Http\Response;

class ClusterController extends Controller
{
    protected $clusterService;

    public function __construct(ClusterService $service)
    {
        $this->clusterService = $service;
    }

    public function index()
    {
        $clusters = $this->clusterService->getAllClusters();
        return new ClusterCollection($clusters);
    }

    public function show(Cluster $cluster)
    {
        return new ClusterResource($this->clusterService->findClusterById($cluster->id));
    }

    public function store(StoreClusterRequest $request)
    {
        $cluster = $this->clusterService->createCluster($request->validated());
        return (new ClusterResource($cluster))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateClusterRequest $request, Cluster $cluster)
    {
        $updatedCluster = $this->clusterService->updateCluster($cluster->id, $request->validated());
        return (new ClusterResource($updatedCluster));
    }

    public function destroy(Cluster $cluster)
    {
        $this->clusterService->deleteCluster($cluster->id);
        return response()->noContent();
    }
}