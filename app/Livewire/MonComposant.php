<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonComposant extends Component
{
	public $name = 'Lionel';

	public $count = 7;

	public $index = 1;

	public $maxUid;

	public $NameAndNote;

	public $note = 0;

	public $multiplier = 1;

	protected $rules = [
		'note'       => 'required|integer|between:0,20',
		'multiplier' => 'required|integer|between:1,4',
	];

	protected $messages = [
		'note.integer'       => 'C\'est quand même mieux un nombre pour une note !',
		'multiplier.integer' => 'C\'est quand même mieux un nombre pour un coefficient !',
	];

	public function __construct()
	{
		$this->maxUid = DB::table('users')->max('id');
		$this->note   = $this->getUserProperty()->note;
	}

	public function noter($multiplier)
	{
		$this->validate();
		$user       = User::find($this->index);
		$user->note = $this->note * $multiplier;
		$user->save();
	}

	public function getUserProperty()
	{
		$u          = User::find($this->index);
		$this->note = $u->note ?? 'Pas de note';

		return $u;
	}

	public function render()
	{
		return view('livewire.mon-composant');
	}
}
