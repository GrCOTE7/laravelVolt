<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Title('UserV2')]
// #[Layout('layouts.volt')]
class extends Component {
	public User $user;
	public $version='Oki';

	public $count = 0;

	public function mount(): void
	{
		$this->user  = User::find(1);
		$this->title = 'UserV2';
        $this->version = 'The Volt';
	}

	public function increment()
	{
		++$this->count;
	}

	public function decrement()
	{
		--$this->count;
	}

	public function with(): array
	{
		return [
			'user' => User::find(1),
			// 'count'   => $this->count,
			// 'version' => 'New Volt',
			'title'   => 'abc',
		];
	}
};