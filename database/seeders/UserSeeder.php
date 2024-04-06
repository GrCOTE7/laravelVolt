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
		$admin = strtolower(env('MAIL_USERNAME', 'admin'));
		$users = [$admin, 'durand', 'dupont', 'martin'];

		foreach ($users as $user) {
			User::create([
				'name'     => ucfirst($user),
				'email'    => $user . '@example.com',
				'admin'    => $user === $admin,
				'password' => bcrypt('password'),
			]);
		}
	}
}
