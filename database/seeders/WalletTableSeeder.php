<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletTableSeeder extends Seeder {

	public function run()
	{
		
		$users = \App\Models\User::all();

		foreach ($users as $user) {
			Wallet::updateOrCreate(
				['user_id' => $user->id],
				['amount' => 1000.00] // Give everyone some starter money
			);
		}
	}
}