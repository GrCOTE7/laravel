<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComponentDemo extends Component
{
	public $data;

	/**
	 * Create a new component instance.
	 *
	 * @param null|mixed $data
	 */
	public function __construct($data = null)
	{
		$this->data = $data;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|\Closure|string
	{
		// $data = $this->data.'oki';
		// $data = 'oki';

		return view('components.component');
	}
}
