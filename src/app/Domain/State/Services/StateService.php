<?php

namespace App\Domain\State\Services;

use App\Domain\State\Contracts\StateRepositoryInterface;
use App\Domain\State\Models\State;
use Illuminate\Database\Eloquent\Collection; 

class StateService
{   
    protected $stateRepository;

    public function __construct(private StateRepositoryInterface $repository)
    {
        $this->stateRepository = $repository;
    }

    public function getAllStates(): Collection
    {
        return $this->stateRepository->all();
    }

    public function findStateById(int $id): ?State
    {
        return $this->stateRepository->find($id);
    }

    public function createState(array $data): State
    {
        return $this->stateRepository->create($data);
    }

    public function updateState(int $id, array $data): State
    {
        return $this->stateRepository->update($id, $data);
    }

    public function deleteState(int $id): void
    {
        $this->stateRepository->delete($id);
    }
}