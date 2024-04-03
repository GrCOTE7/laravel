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

	public $note;

	public $noteAutre;

	public $indexAutre;

	protected $rules = [
		'note'       => 'required|integer|between:0,20',
		'noteAutre'  => 'required|integer|between:0,20',
		'indexAutre' => 'required|exists:users,id',
	];

	protected $messages = [
		'noteAutre.integer' => 'C\'est quand même mieux un nombre pour une note !',
	];
	// public $user;

	public function getUserProperty()
	{
		return User::find($this->index);
	}

	public function noter()
	{
		$this->validate();
		$u       = User::find($this->index);
		$u->note = $this->note;
		$u->save();
	}

	public function noterAutre($indexAutre = 111)
	{
		$this->validate();
		$user       = User::find($indexAutre);
		$user->note = $this->noteAutre;
		$user->save();
	}

	public function render()
	{
		return view('livewire.mon-composant');
	}
}
