<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUser extends Component
{
	public User $user;

	public function render()
	{
		return view('livewire.show-user')->layout('components.layouts.app');
	}
}