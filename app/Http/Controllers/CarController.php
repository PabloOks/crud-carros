<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Models\Car;
use Illuminate\Http\Request as Request;

class CarController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $withTrashed = $request->with_deleted ?? false;
        $onlyTrashed = $request->deleted_only ?? false;

        if ($withTrashed) $cars = Car::withTrashed()->get();
        if ($onlyTrashed) $cars = Car::onlyTrashed()->get();
        if (!$withTrashed && !$onlyTrashed) $cars = Car::all();

        return $this->success(data: [$cars]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $car = new Car();
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->year = $request->year;
        $car->save();

        return $this->success(
            message: 'Registro adicionado com sucesso',
            data: ['id' => $car->id]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Car $car)
    {
        return $this->success(data: [$car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->color = $request->color;
        $car->year = $request->year;
        $car->save();

        return $this->success(message: 'Informações alteradas com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if (!$car->trashed()) $car->delete();

        return $this->success(message: 'Registro excluído com sucesso');
    }

    /**
     * Restore the specified resource from storage
     */
    public function restore(Car $car)
    {
        if ($car->trashed()) $car->restore();

        return $this->success(message: 'Registro restaurado com sucesso');
    }
}
