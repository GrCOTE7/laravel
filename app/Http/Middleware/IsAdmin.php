<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, \Closure $next): Response
	{
		$user = $request->user();
		if ($user && 'admin' === $user->role) {
			return $next($request);
		}

		return redirect()->route('home');
	}
}
