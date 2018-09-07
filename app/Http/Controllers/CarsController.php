<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;

class CarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$cars = Car::paginate();
		return view('cars.index', compact('cars'));
	}

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

	public function create(Car $car)
	{
		return view('cars.create_and_edit', compact('car'));
	}

	public function store(CarRequest $request)
	{
		$car = Car::create($request->all());
		return redirect()->route('cars.show', $car->id)->with('message', 'Created successfully.');
	}

	public function edit(Car $car)
	{
        $this->authorize('update', $car);
		return view('cars.create_and_edit', compact('car'));
	}

	public function update(CarRequest $request, Car $car)
	{
		$this->authorize('update', $car);
		$car->update($request->all());

		return redirect()->route('cars.show', $car->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Car $car)
	{
		$this->authorize('destroy', $car);
		$car->delete();

		return redirect()->route('cars.index')->with('message', 'Deleted successfully.');
	}
}