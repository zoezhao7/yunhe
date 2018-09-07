<?php

namespace App\Http\Controllers;

use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecRequest;

class SpecsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$specs = Spec::paginate();
		return view('specs.index', compact('specs'));
	}

    public function show(Spec $spec)
    {
        return view('specs.show', compact('spec'));
    }

	public function create(Spec $spec)
	{
		return view('specs.create_and_edit', compact('spec'));
	}

	public function store(SpecRequest $request)
	{
		$spec = Spec::create($request->all());
		return redirect()->route('specs.show', $spec->id)->with('message', 'Created successfully.');
	}

	public function edit(Spec $spec)
	{
        $this->authorize('update', $spec);
		return view('specs.create_and_edit', compact('spec'));
	}

	public function update(SpecRequest $request, Spec $spec)
	{
		$this->authorize('update', $spec);
		$spec->update($request->all());

		return redirect()->route('specs.show', $spec->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Spec $spec)
	{
		$this->authorize('destroy', $spec);
		$spec->delete();

		return redirect()->route('specs.index')->with('message', 'Deleted successfully.');
	}
}