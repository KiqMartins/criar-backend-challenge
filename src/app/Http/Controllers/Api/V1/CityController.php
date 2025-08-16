<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Domain\City\Models\City;
use App\Domain\City\Services\CityService;
use App\Http\Resources\CityCollection;
use Illuminate\Http\Response;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index()
    {
        $cities = $this->cityService->getAllCities();
        return new CityCollection($cities);
    }

    public function show(City $city)
    {
        return new CityResource($city);
    }

    public function store(StoreCityRequest $request)
    {
        $city = $this->cityService->createCity($request->validated());
        return (new CityResource($city))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $updatedCity = $this->cityService->updateCity($city->id, $request->validated());
        return new CityResource($updatedCity);
    }

    public function destroy(City $city)
    {
        $this->cityService->deleteCity($city->id);
        return response()->noContent();
    }
}
