<?php

/**
 * (ɔ) GrCOTE7 - 1999-2024
 */

namespace App\Livewire;

use Mary\Traits\Toast;
use Livewire\Component;

class Counter extends Component
{

	public $counter = 0;

	public function increment()
	{
		++$this->counter;
        // $this->success('Counter upgraded !');
	}

	public function render()
	{
		return view('livewire.counter');
	}
}
