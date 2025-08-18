<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Campaign\Models\Campaign;
use App\Domain\Campaign\Contracts\CampaignRepositoryInterface;
use App\Domain\Campaign\Services\CampaignService;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Resources\Campaign\CampaignResource;
use App\Http\Resources\Campaign\CampaignCollection;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $service)
    {
        $this->campaignService = $service;
    }

    public function index()
    {
        $campaigns = $this->campaignService->getAllCampaigns();
        return new CampaignCollection($campaigns);
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['cluster', 'discount']);

        return new CampaignResource($campaign);
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return (new CampaignResource($campaign))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $updatedCampaign = $this->campaignService->updateCampaign($campaign->id, $request->validated());
        return (new CampaignResource($updatedCampaign));
    }

    public function destroy(Campaign $campaign)
    {
        $this->campaignService->deleteCampaign($campaign->id, $campaign->is_active);
        return response()->noContent();
    }
}