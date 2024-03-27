<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Film as FilmResource;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class FilmController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(): LengthAwarePaginator
	{
		return Film::with('categories', 'actors')->paginate(2);
	}

	public function index2(): View
	{
		$films = Film::with('categories', 'actors')->get();

		$data = [];
		foreach ($films as $k => $v) {
			array_push($data, $k . ': ' . $v . '<hr>');
		}
		$data = implode($data);

		return view('pages.test', compact('data'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): void
	{
		Film::create($request->all());
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Film $film): FilmResource
	{
		return new FilmResource($film);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Film $film): Film
	{
		$film->update($request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Film $film): void
	{
		$film->delete();
	}
}
