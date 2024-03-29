<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class IsLionel
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, \Closure $next): Response
	{
		$user = $request->user();
		if ($user && 'Lionel' === $user->name) {
			return $next($request);
		}
		$data = 'Vous devez être un "Lionel" !';
		Session::put('data', $data);

		return redirect()->route('test');
		// return view('pages.test')->with('data');
	}
}
