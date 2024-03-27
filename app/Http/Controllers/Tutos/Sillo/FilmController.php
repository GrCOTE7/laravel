<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Sillo;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmRequest;
use App\Models\Category;
use App\Models\Film;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FilmController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param null|mixed $slug
	 */
	public function index($slug = null): View
	{
		$query = $slug ? Category::whereSlug($slug)->firstOrFail()->films() : Film::query();
		$films = $query->withTrashed()->oldest('title')->paginate(5);

		// $categories = Category::all();
		return view('pages.tuto.film.index', compact('films', 'slug'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		return view('pages.tuto.film.create');
	}

	public function store(FilmRequest $filmRequest): RedirectResponse
	{
		$film = Film::create($filmRequest->all());
		$film->categories()->attach($filmRequest->cats);

		return redirect()->route('films.index')->with('info', 'Le film a bien été créé');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Film $film): View
	{
		return view('pages.tuto.film.show', compact('film'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Film $film): View
	{
		return view('pages.tuto.film.edit', compact('film'));
	}

	public function update(FilmRequest $filmRequest, Film $film): RedirectResponse
	{
		$film->update($filmRequest->all());
		$film->categories()->sync($filmRequest->cats);

		return redirect()->route('films.index')->with('info', 'Le film a bien été modifié');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Film $film): RedirectResponse
	{
		$film->delete();

		return back()->with('info', 'Le film a bien été mis dans la corbeille.');
	}

	public function forceDestroy($id): RedirectResponse
	{
		Film::withTrashed()->whereId($id)->firstOrFail()->forceDelete();

		return back()->with('info', 'Le film a bien été supprimé définitivement dans la base de données.');
	}

	public function restore($id): RedirectResponse
	{
		Film::withTrashed()->whereId($id)->firstOrFail()->restore();

		return back()->with('info', 'Le film a bien été restauré.');
	}
}
