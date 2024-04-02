<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class MonComposant extends Component
{
	public $monTest = 'Gc7Test of Livewire';

	public $index = 15;

	// public $user;

	public function getUserProperty()
	{
		return User::find($this->index);
	}

	public function render()
	{
		return view('livewire.mon-composant');
	}
}
