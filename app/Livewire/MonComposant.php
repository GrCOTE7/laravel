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

	public $userVerifiedId;

	public $userVerified;

	protected $rulesNote = [
		'note' => 'required|integer|between:0,20',
	];

	protected $rulesNoteAutre = [
		'noteAutre'  => 'required|integer|between:0,20',
		'indexAutre' => 'required|exists:users,id',
	];

	protected $messages = [
		'noteAutre.integer' => 'C\'est quand même mieux un nombre pour une note !',
	];

	public function getUserProperty()
	{
		return User::find($this->index);
	}

	public function updatedUserVerifiedId($id)
	{
		$this->userVerified = User::find($id);
		if ($id && !$this->userVerified) {
			session()->flash('error', 'Utilisateur non trouvé');
		}
	}

	public function noter()
	{
		$this->validate($this->rulesNote);
		$u       = User::find($this->index);
		$u->note = $this->note;
		$u->save();
	}

	public function noterAutre($indexAutre = 111)
	{
		$this->validate($this->rulesNoteAutre);
		$user       = User::find($indexAutre);
		$user->note = $this->noteAutre;
		$user->save();
	}

	public function render()
	{
		return view('livewire.mon-composant');
	}
}
