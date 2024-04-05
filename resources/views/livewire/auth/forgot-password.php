-- Active: 1712325630871@@127.0.0.1@3306
<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024.
 */

use Illuminate\Support\Facades\Password;
use Livewire\Volt\Component;

$v = new class() extends Component {
	public string $email = '';

	public function sendPasswordResetLink(): void
	{
		$this->validate([
			'email' => ['required', 'string', 'email'],
		]);

		$status = Password::sendResetLink(
			$this->only('email')
		);

		if (Password::RESET_LINK_SENT != $status) {
			$this->addError('email', __($status));

			return;
		}

		$this->reset('email');

		session()->flash('status', __($status));
	}
};
