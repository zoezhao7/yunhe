<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommissionRequest;

class CommissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$commissions = Commission::paginate();
		return view('commissions.index', compact('commissions'));
	}

    public function show(Commission $commission)
    {
        return view('commissions.show', compact('commission'));
    }

	public function create(Commission $commission)
	{
		return view('commissions.create_and_edit', compact('commission'));
	}

	public function store(CommissionRequest $request)
	{
		$commission = Commission::create($request->all());
		return redirect()->route('commissions.show', $commission->id)->with('message', 'Created successfully.');
	}

	public function edit(Commission $commission)
	{
        $this->authorize('update', $commission);
		return view('commissions.create_and_edit', compact('commission'));
	}

	public function update(CommissionRequest $request, Commission $commission)
	{
		$this->authorize('update', $commission);
		$commission->update($request->all());

		return redirect()->route('commissions.show', $commission->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Commission $commission)
	{
		$this->authorize('destroy', $commission);
		$commission->delete();

		return redirect()->route('commissions.index')->with('message', 'Deleted successfully.');
	}
}