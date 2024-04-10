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
    public $multiple = 1;

	public function __construct()
	{
		$this->maxUid = DB::table('users')->max('id');
		$this->note   = $this->getUserProperty()->note;
	}

	public function noter($multiple)
	{
		$user       = User::find($this->index);
		$user->note = $this->note * $multiple;
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
