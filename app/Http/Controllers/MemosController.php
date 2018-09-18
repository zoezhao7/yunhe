<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemoRequest;

class MemosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$memos = Memo::paginate();
		return view('memos.index', compact('memos'));
	}

    public function show(Memo $memo)
    {
        return view('memos.show', compact('memo'));
    }

	public function create(Memo $memo)
	{
		return view('memos.create_and_edit', compact('memo'));
	}

	public function store(MemoRequest $request)
	{
		$memo = Memo::create($request->all());
		return redirect()->route('memos.show', $memo->id)->with('message', 'Created successfully.');
	}

	public function edit(Memo $memo)
	{
        $this->authorize('update', $memo);
		return view('memos.create_and_edit', compact('memo'));
	}

	public function update(MemoRequest $request, Memo $memo)
	{
		$this->authorize('update', $memo);
		$memo->update($request->all());

		return redirect()->route('memos.show', $memo->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Memo $memo)
	{
		$this->authorize('destroy', $memo);
		$memo->delete();

		return redirect()->route('memos.index')->with('message', 'Deleted successfully.');
	}
}