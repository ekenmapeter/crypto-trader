<?php echo $__env->make('user.components.user_head', ['title' => 'Live Market'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('user.components.top-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="px-4 py-8 mb-20 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tighter">Live Crypto Market</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Real-time market insights</p>
        </div>
    </div>

    <!-- Stats summary -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Market Cap</span>
            <span class="text-lg font-black text-gray-900 tracking-tight" id="global-mcap">Calculating...</span>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col justify-center">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Global 24h Vol</span>
            <span class="text-lg font-black text-gray-900 tracking-tight" id="global-vol">Calculating...</span>
        </div>
    </div>

    <!-- Market Table -->
    <div class="bg-white rounded-[32px] shadow-xl border border-gray-100 overflow-hidden relative">
        <!-- Floating gradient accent -->
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap min-w-[700px]">
                <thead class="bg-gray-50/80 border-b border-gray-100/80">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Asset</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                            Price</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                            24h Change</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                            Market Cap</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                            Volume (24h)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white" id="market-tbody">
                    <?php
                        // List from the user's provided data
$topCoins = [
    ['name' => 'Bitcoin', 'symbol' => 'BTC'],
    ['name' => 'Ethereum', 'symbol' => 'ETH'],
    ['name' => 'Tether', 'symbol' => 'USDT'],
    ['name' => 'XRP', 'symbol' => 'XRP'],
    ['name' => 'Binance Coin', 'symbol' => 'BNB'],
    ['name' => 'USD Coin', 'symbol' => 'USDC'],
    ['name' => 'Solana', 'symbol' => 'SOL'],
    ['name' => 'TRON', 'symbol' => 'TRX'],
    ['name' => 'Lido Staked Ether', 'symbol' => 'STETH'],
    ['name' => 'Figure Heloc', 'symbol' => 'FIGR'],
    ['name' => 'Dogecoin', 'symbol' => 'DOGE'],
    ['name' => 'WhiteBIT Coin', 'symbol' => 'WBT'],
    ['name' => 'USDS', 'symbol' => 'USDS'],
    ['name' => 'Hyperliquid', 'symbol' => 'HYPE'],
    ['name' => 'LEO Token', 'symbol' => 'LEO'],
    ['name' => 'Wrapped stETH', 'symbol' => 'WSTETH'],
    ['name' => 'Cardano', 'symbol' => 'ADA'],
    ['name' => 'Bitcoin Cash', 'symbol' => 'BCH'],
    ['name' => 'Chainlink', 'symbol' => 'LINK'],
    ['name' => 'Wrapped Bitcoin', 'symbol' => 'WBTC'],
    ['name' => 'Binance Bridged USDT', 'symbol' => 'BSC-USD'],
    ['name' => 'Monero', 'symbol' => 'XMR'],
    ['name' => 'Ethena USDe', 'symbol' => 'USDE'],
    ['name' => 'Wrapped Beacon ETH', 'symbol' => 'WBETH'],
    ['name' => 'Zcash', 'symbol' => 'ZEC'],
                        ];
                    ?>

                    <?php $__currentLoopData = $topCoins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $coin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50/80 transition-colors group coin-row"
                            data-symbol="<?php echo e($coin['symbol']); ?>">
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold text-gray-400"><?php echo e($index + 1); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-100 p-2 shadow-inner border border-gray-200/50 flex-shrink-0 relative overflow-hidden group-hover:shadow-md transition-all duration-300 flex items-center justify-center">
                                        <img id="img-<?php echo e($coin['symbol']); ?>" src="/images/crypto_logo/bg_coin.png"
                                            class="w-full h-full object-contain filter group-hover:scale-110 transition-transform duration-500"
                                            alt="<?php echo e($coin['name']); ?>" />
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-black text-gray-900 tracking-tight group-hover:text-blue-600 transition-colors">
                                            <?php echo e($coin['name']); ?></h4>
                                        <span
                                            class="text-[10px] text-gray-400 font-bold uppercase tracking-widest"><?php echo e($coin['symbol']); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="text-sm font-black text-gray-900 tracking-tight transition-colors duration-500 price-display"
                                    id="price-<?php echo e($coin['symbol']); ?>">
                                    <div class="h-4 w-16 bg-gray-200 animate-pulse rounded ml-auto"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black ml-auto border border-transparent transition-all duration-500 change-display"
                                    id="change-<?php echo e($coin['symbol']); ?>">
                                    <div class="h-3 w-10 bg-gray-200 animate-pulse rounded"></div>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs font-bold text-gray-500 tracking-tight mcap-display"
                                    id="mcap-<?php echo e($coin['symbol']); ?>">
                                    <div class="h-4 w-20 bg-gray-200 animate-pulse rounded ml-auto"></div>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs font-bold text-gray-500 tracking-tight vol-display"
                                    id="vol-<?php echo e($coin['symbol']); ?>">
                                    <div class="h-4 w-20 bg-gray-200 animate-pulse rounded ml-auto"></div>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $__env->make('user.components.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    /* Flash animations for price updates */
    @keyframes greenFlash {
        0% {
            background-color: rgba(16, 185, 129, 0.2);
        }

        100% {
            background-color: transparent;
        }
    }

    @keyframes redFlash {
        0% {
            background-color: rgba(239, 68, 68, 0.2);
        }

        100% {
            background-color: transparent;
        }
    }

    .flash-up {
        animation: greenFlash 1s ease-out;
    }

    .flash-down {
        animation: redFlash 1s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const symbols = Array.from(document.querySelectorAll('.coin-row')).map(row => row.dataset.symbol);
        const lastPrices = {};

        function formatMoney(amount, isLarge = false) {
            if (isLarge) {
                if (amount >= 1e12) return '$' + (amount / 1e12).toFixed(2) + ' T';
                if (amount >= 1e9) return '$' + (amount / 1e9).toFixed(2) + ' B';
                if (amount >= 1e6) return '$' + (amount / 1e6).toFixed(2) + ' M';
            }
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        }

        async function updateMarket() {
            if (symbols.length === 0) return;

            try {
                const fsyms = symbols.join(',');
                const response = await fetch(
                    `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${fsyms}&tsyms=USD`);
                const result = await response.json();

                if (result.RAW) {
                    let totalMcap = 0;
                    let totalVol = 0;

                    symbols.forEach(sym => {
                        const data = result.RAW[sym]?.USD;
                        if (!data) return;

                        const row = document.querySelector(`[data-symbol="${sym}"]`);
                        const priceEl = document.getElementById(`price-${sym}`);
                        const changeEl = document.getElementById(`change-${sym}`);
                        const mcapEl = document.getElementById(`mcap-${sym}`);
                        const volEl = document.getElementById(`vol-${sym}`);
                        const imgEl = document.getElementById(`img-${sym}`);

                        const currentPrice = data.PRICE;
                        const changePercent = data.CHANGEPCT24HOUR;
                        const cap = data.MKTCAP;
                        const vol = data.TOTALVOLUME24HTO;
                        const imgUrl = data.IMAGEURL;

                        totalMcap += cap || 0;
                        totalVol += vol || 0;

                        if (imgUrl && imgEl && imgEl.getAttribute('src').includes('bg_coin.png')) {
                            imgEl.src = `https://www.cryptocompare.com${imgUrl}`;
                        }

                        // Price Update with smooth flash effect
                        if (lastPrices[sym]) {
                            if (currentPrice > lastPrices[sym]) {
                                priceEl.classList.remove('text-red-600', 'text-gray-900');
                                priceEl.classList.add('text-emerald-500');
                                row.classList.remove('flash-down');
                                row.classList.add('flash-up');
                                setTimeout(() => {
                                    priceEl.classList.add('text-gray-900');
                                    priceEl.classList.remove('text-emerald-500');
                                }, 1000);
                            } else if (currentPrice < lastPrices[sym]) {
                                priceEl.classList.remove('text-emerald-500', 'text-gray-900');
                                priceEl.classList.add('text-red-600');
                                row.classList.remove('flash-up');
                                row.classList.add('flash-down');
                                setTimeout(() => {
                                    priceEl.classList.add('text-gray-900');
                                    priceEl.classList.remove('text-red-600');
                                }, 1000);
                            }
                        }

                        lastPrices[sym] = currentPrice;
                        priceEl.textContent = formatMoney(currentPrice);

                        // Change Update
                        const isPositive = changePercent >= 0;
                        changeEl.innerHTML = (isPositive ?
                                '<i class="fa-solid fa-arrow-turn-up mr-1.5 opacity-70"></i>' :
                                '<i class="fa-solid fa-arrow-turn-down mr-1.5 opacity-70"></i>') +
                            Math.abs(changePercent).toFixed(2) + '%';
                        changeEl.className =
                            `inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black ml-auto border transition-all duration-500 ${isPositive ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100'}`;

                        // Mcap & Vol
                        if (cap) mcapEl.textContent = formatMoney(cap, true);
                        if (vol) volEl.textContent = formatMoney(vol, true);
                    });

                    // Update Top Stats
                    if (totalMcap > 0) document.getElementById('global-mcap').textContent = formatMoney(
                        totalMcap, true);
                    if (totalVol > 0) document.getElementById('global-vol').textContent = formatMoney(
                        totalVol, true);
                }
            } catch (error) {
                console.error('Market update failed:', error);
            }
        }

        updateMarket();
        // Poll every 8 seconds for real-time market updates
        setInterval(updateMarket, 8000);
    });
</script>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/user/pages/market.blade.php ENDPATH**/ ?>