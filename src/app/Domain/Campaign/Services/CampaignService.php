<?php

namespace App\Domain\Campaign\Services;

use App\Domain\Campaign\Models\Campaign;
use App\Domain\Campaign\Contracts\CampaignRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Domain\Campaign\Exceptions\ActiveCampaignDeletionException;

class CampaignService
{
    protected $campaignRepository;

    public function __construct(private CampaignRepositoryInterface $repository)
    {
        $this->campaignRepository = $repository;
    }

    public function getAllCampaigns(): LengthAwarePaginator
    {
        $pagesCount = 100;

        return $this->campaignRepository->all()->paginate($pagesCount);
    }

    public function findCampaignById(int $id): ?Campaign
    {
        return $this->campaignRepository->find($id);
    }

    public function createCampaign(array $data): Campaign
    {
        return $this->campaignRepository->create($data);
    }

    public function updateCampaign(int $id, array $data): Campaign
    {
        return $this->campaignRepository->update($id, $data); 
    }

    public function deleteCampaign(int $id, bool $status): void
    {
        if ($status) {
            throw new ActiveCampaignDeletionException(
                'Não é possível excluir uma campanha que está ativa. Por favor, desative-a primeiro.'
            );
        }

        $this->campaignRepository->delete($id);
    }
}