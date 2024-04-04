<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Task;

class TaskController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tasks = Task::all();

		return view('pages.tuto.tasks.index', compact('tasks'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.tuto.tasks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(TodoRequest $request)
	{
		$task         = new Task();
		$task->title  = $request->title;
		$task->detail = $request->detail;
		$task->save();

		return back()->with('message', trans('Task created!'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Task $todo)
	{
		$task = $todo;

		return view('pages.tuto.tasks.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Task $todo)
	{
		$task = $todo;

		return view('pages.tuto.tasks.edit', compact('task'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(TodoRequest $request, Task $todo)
	{
		$task = $todo;

		$task->title  = $request->title;
		$task->detail = $request->detail;
		$task->state  = $request->has('state');
		$task->save();

		return back()->with('message', trans('The task has been updated!'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Task $todo)
	{
		$todo->delete();

		return back()->with('message', trans('The task has been deleted!'));
	}
}
