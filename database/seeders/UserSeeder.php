<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run(): void
	{
		$users = [strtolower(env('MAIL_USERNAME', 'admin')), 'durand', 'dupont', 'martin'];

		foreach ($users as $user) {
			User::create([
				'name'     => ucfirst($user),
				'email'    => $user . '@example.com',
				'password' => bcrypt('password'),
			]);

			$admin        = User::find(1);
			$admin->admin = 1;
			$admin->save();
		}
	}
}
