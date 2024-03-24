<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lang extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|\Closure|string
	{
		return view('components.lang');
	}
}
