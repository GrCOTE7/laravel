<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notification extends Component
{
	public $text;

	public function __construct()
	{
	}

	public function render(): View|\Closure|string
	{
		return view('components.notification');
	}
}
