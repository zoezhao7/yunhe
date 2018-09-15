<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarBrandRequest;

class CarBrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$car_brands = CarBrand::paginate();
		return view('car_brands.index', compact('car_brands'));
	}

    public function show(CarBrand $car_brand)
    {
        return view('car_brands.show', compact('car_brand'));
    }

	public function create(CarBrand $car_brand)
	{
		return view('car_brands.create_and_edit', compact('car_brand'));
	}

	public function store(CarBrandRequest $request)
	{
		$car_brand = CarBrand::create($request->all());
		return redirect()->route('car_brands.show', $car_brand->id)->with('message', 'Created successfully.');
	}

	public function edit(CarBrand $car_brand)
	{
        $this->authorize('update', $car_brand);
		return view('car_brands.create_and_edit', compact('car_brand'));
	}

	public function update(CarBrandRequest $request, CarBrand $car_brand)
	{
		$this->authorize('update', $car_brand);
		$car_brand->update($request->all());

		return redirect()->route('car_brands.show', $car_brand->id)->with('message', 'Updated successfully.');
	}

	public function destroy(CarBrand $car_brand)
	{
		$this->authorize('destroy', $car_brand);
		$car_brand->delete();

		return redirect()->route('car_brands.index')->with('message', 'Deleted successfully.');
	}
}