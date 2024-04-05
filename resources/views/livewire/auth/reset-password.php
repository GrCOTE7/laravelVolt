<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

$v = new class() extends Component {
	#[Locked]
	public string $token = '';

	public string $email = '';

	public string $password = '';

	public string $password_confirmation = '';

	public function mount(string $token): void
	{
		$this->token = $token;

		$this->email = request()->string('email');
	}

	public function resetPassword(): void
	{
		$this->validate([
			'token'    => ['required'],
			'email'    => ['required', 'string', 'email'],
			'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
		]);

		$status = Password::reset($this->only('email', 'password', 'password_confirmation', 'token'), function ($user) {
			$user
				->forceFill([
					'password'       => Hash::make($this->password),
					'remember_token' => Str::random(60),
				])
				->save();

			event(new PasswordReset($user));
		});

		if (Password::PASSWORD_RESET != $status) {
			$this->addError('email', __($status));

			return;
		}

		Session::flash('status', __($status));

		$this->redirectRoute('login', navigate: true);
	}
};
