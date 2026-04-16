<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WalletType;
use App\Models\UserWallet;
use Illuminate\Database\Seeder;

class UserWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $walletTypes = WalletType::all();

        foreach ($users as $user) {
            foreach ($walletTypes as $type) {
                UserWallet::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'wallet_type_id' => $type->id
                    ],
                    [
                        'amount' => 500.0, // Initial balance
                        'wallet_address' => strtolower($type->short_code) . '_addr_' . bin2hex(random_bytes(8)),
                        'restrict_fee' => '0'
                    ]
                );
            }
        }
    }
}
