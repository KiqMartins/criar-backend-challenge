<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\State\Services\StateService;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Actions\States\CreateStateAction;
use App\Http\Resources\StateResource;
use Illuminate\Http\Response;
use App\Domain\State\Models\State;

class StateController extends Controller 
{
    protected $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    public function index()
    {
        $states = $this->stateService->getAllStates();
        return StateResource::collection($states);
    }

    public function show(State $state)
    {
        return new StateResource($state);
    }

    public function store(StoreStateRequest $request)
    {   
        $state = $this->stateService->createState($request->validated());
        return (new StateResource($state))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $updatedState = $this->stateService->updateState($state->id, $request->validated());
        return new StateResource($updatedState);
    }

    public function destroy(State $state)
    {
        $this->stateService->deleteState($state->id);
        return response()->noContent();
    }

}