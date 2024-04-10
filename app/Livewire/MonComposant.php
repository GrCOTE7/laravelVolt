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

	public function __construct()
	{
		$this->maxUid = DB::table('users')->max('id');
	}

	public function getUserProperty()
	{
		return User::find($this->index);
	}

	public function render()
	{
		return view('livewire.mon-composant');
	}
}
