<?php

namespace App\Domain\State\Repositories;

use App\Domain\State\Contracts\StateRepositoryInterface;
use App\Domain\State\Models\State;
use Illuminate\Database\Eloquent\Collection;

class EloquentStateRepository implements StateRepositoryInterface
{

    public function all(): Collection
    {
        return State::all();
    }

    public function find(int $id): ?State
    {
        return State::find($id);
    } 


    public function create(array $data): State
    {
        return State::create($data);
    }

    public function update(int $id, array $data): State
    {
        $state = State::find($id);
        $state->update($data);

        return $state;
    }

    public function delete(int $id): bool
    {
        $state = State::find($id);
        return $state->delete();
    }
}