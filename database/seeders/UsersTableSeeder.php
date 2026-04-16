<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

	public function run()
	{


		// Admin Account
		User::updateOrCreate(
			['username' => 'admin'],
			[
				'firstname' => 'Admin',
				'lastname' => 'User',
				'sex' => 'Male',
				'age' => '30',
				'email' => 'admin@coin.com',
				'mobile_number' => '+1234567890',
				'roles' => 1,
				'password' => Hash::make('AdminPass123!'),
				'last_login' => now(),
				'account_number' => '1000000001',
				'account_name' => 'Admin Controller',
				'bank_name' => 'Main Bank'
			]
		);

		// Regular User Account
		User::updateOrCreate(
			['username' => 'user'],
			[
				'firstname' => 'Test',
				'lastname' => 'User',
				'sex' => 'Female',
				'age' => '25',
				'email' => 'user@coinledger.com',
				'mobile_number' => '+0987654321',
				'roles' => 2,
				'password' => Hash::make('UserPass123!'),
				'last_login' => now(),
				'account_number' => '2000000002',
				'account_name' => 'John Doe',
				'bank_name' => 'Secondary Bank'
			]
		);

		// Original ShevooPay Admin
		User::updateOrCreate(
			['username' => 'shevoopay'],
			[
				'firstname' => 'Admin',
				'lastname' => 'ShevooPay',
				'sex' => 'Male',
				'age' => '31',
				'email' => 'shevootech@gmail.com',
				'mobile_number' => '+2347031633778',
				'roles' => 1,
				'password' => Hash::make('CALLME123456'),
				'last_login' => now(),
				'account_number' => '0000000000',
				'account_name' => 'Admin User',
				'bank_name' => 'Default Bank'
			]
		);
	}
}
