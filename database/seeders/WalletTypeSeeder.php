<?php

namespace Database\Seeders;

use App\Models\WalletType;
use Illuminate\Database\Seeder;

class WalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $walletTypes = [
            [
                'logo' => 'bitcoin.png',
                'coin_name' => 'Bitcoin',
                'short_code' => 'BTC',
                'active' => true,
                'payment_wallet_address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
                'payment_qr_code' => 'btc_qr.png',
                'payment_instructions' => 'Send only BTC to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'ethereum.png',
                'coin_name' => 'Ethereum',
                'short_code' => 'ETH',
                'active' => true,
                'payment_wallet_address' => '0xde0B295669a9FD93d5F28D9Ec85E40f4cb697BAe',
                'payment_qr_code' => 'eth_qr.png',
                'payment_instructions' => 'Send only ETH to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'tether.png',
                'coin_name' => 'Tether',
                'short_code' => 'USDT',
                'active' => true,
                'payment_wallet_address' => '0x71C7656EC7ab88b098defB751B7401B5f6d8976F',
                'payment_qr_code' => 'usdt_qr.png',
                'payment_instructions' => 'Send only USDT (ERC20) to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'bnb.png',
                'coin_name' => 'Binance Coin',
                'short_code' => 'BNB',
                'active' => true,
                'payment_wallet_address' => 'bnb1grpf0955u0uun796vsl9fy3vcrzehrqy358aa5',
                'payment_qr_code' => 'bnb_qr.png',
                'payment_instructions' => 'Send only BNB to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'solana.png',
                'coin_name' => 'Solana',
                'short_code' => 'SOL',
                'active' => true,
                'payment_wallet_address' => 'vines1vzrYbzduYv9cYp9KshN8gn95iSshm7vJ2X8H',
                'payment_qr_code' => 'sol_qr.png',
                'payment_instructions' => 'Send only SOL to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'xrp.png',
                'coin_name' => 'XRP',
                'short_code' => 'XRP',
                'active' => true,
                'payment_wallet_address' => 'rGWrHioRL9KzS9Z7vwwKzrq3G9YXpveG1D',
                'payment_qr_code' => 'xrp_qr.png',
                'payment_instructions' => 'Send only XRP to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'cardano.png',
                'coin_name' => 'Cardano',
                'short_code' => 'ADA',
                'active' => true,
                'payment_wallet_address' => 'addr1q95k80n9vld66p89c3w02f3v45g88kkh6r4f',
                'payment_qr_code' => 'ada_qr.png',
                'payment_instructions' => 'Send only ADA to this address.',
                'restrict' => '0'
            ],
            [
                'logo' => 'dogecoin.png',
                'coin_name' => 'Dogecoin',
                'short_code' => 'DOGE',
                'active' => true,
                'payment_wallet_address' => 'D8vBfgnqD4A5vJ29X5fG9Vv8Yp88pPVyD4',
                'payment_qr_code' => 'doge_qr.png',
                'payment_instructions' => 'Send only DOGE to this address.',
                'restrict' => '0'
            ],
        ];

        foreach ($walletTypes as $type) {
            WalletType::updateOrCreate(['short_code' => $type['short_code']], $type);
        }
    }
}
