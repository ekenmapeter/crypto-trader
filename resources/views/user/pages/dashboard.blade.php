@include('user.components.user_head')
@include('user.components.top-navbar')

<div class="px-4 space-y-8 mt-6 pb-24 max-w-7xl mx-auto">

    {{-- Top Section: Balance & Header --}}
    <div class="w-full">
        <section
            class="w-full rounded-[40px] p-8 bg-gradient-to-br from-blue-900 to-indigo-900 text-white shadow-2xl relative overflow-hidden group">
            <div
                class="absolute top-0 center w-64 h-64 bg-white/5 rounded-full blur-3xl -mt-32 transition-transform group-hover:scale-110">
            </div>

            <div class="flex flex-col items-center justify-center gap-6 relative">
                <div
                    class="flex items-center justify-center w-56 h-56 md:w-72 md:h-72 rounded-full border-[6px] border-blue-400/20 bg-blue-800/30 shadow-[0_0_40px_rgba(59,130,246,0.3)] backdrop-blur-sm mx-auto relative overflow-hidden group/circle">
                    <!-- Spinning accent ring -->
                    <div
                        class="absolute inset-0 rounded-full border-t-[6px] border-r-[6px] border-blue-400/60 animate-[spin_8s_linear_infinite]">
                    </div>
                    <div
                        class="absolute inset-0 rounded-full border-b-[6px] border-l-[6px] border-indigo-400/40 animate-[spin_12s_linear_infinite_reverse]">
                    </div>

                    <div
                        class="text-center relative z-10 flex flex-col items-center justify-center p-4 transition-transform group-hover/circle:scale-110 duration-500">
                        <div class="bg-blue-400/10 p-2.5 rounded-full mb-3 hidden md:block">
                            <i class="fa-solid fa-wallet text-blue-300 text-lg"></i>
                        </div>
                        <h2
                            class="text-[10px] md:text-[11px] font-black text-blue-200 uppercase tracking-[0.15em] mb-1 leading-tight">
                            Net Portfolio<br />Value
                        </h2>
                        <div class="flex items-baseline justify-center gap-1 mt-1">
                            <span class="text-xl md:text-2xl font-black text-blue-400">$</span>
                            <p class="text-2xl md:text-3xl font-black tracking-tighter" id="totalPortfolioBalance">
                                {{ number_format($totalWalletAmount, 2) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions Strip --}}
                <section class="flex flex-wrap md:grid md:grid-cols-3 gap-4 mt-8 max-w-2xl mx-auto">
                    @php
                        $actions = [
                            [
                                'icon' => 'fa-arrow-down',
                                'label' => 'Receive',
                                'url' => route('user.deposit.create'),
                                'color' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30',
                            ],
                            [
                                'icon' => 'fa-paper-plane',
                                'label' => 'Send',
                                'url' => route('user.withdraw.create'),
                                'color' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
                            ],
                            [
                                'icon' => 'fa-cart-plus',
                                'label' => 'Buy',
                                'url' => url('buy'),
                                'color' => 'bg-purple-500/20 text-purple-400 border border-purple-500/30',
                            ],
                        ];
                    @endphp

                    @foreach ($actions as $action)
                        <a href="{{ $action['url'] }}"
                            class="flex-1 flex flex-col items-center justify-center py-4 px-2 bg-white/5 backdrop-blur-md rounded-[28px] shadow-lg border border-white/10 hover:bg-white/10 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95 min-w-[100px] group">
                            <div
                                class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center {{ $action['color'] }} rounded-full shadow-inner mb-3 group-hover:scale-110 transition-transform duration-300">
                                <i class="fa-solid {{ $action['icon'] }} text-lg md:text-xl"></i>
                            </div>
                            <span
                                class="text-[9px] md:text-[10px] font-black text-gray-300 group-hover:text-white uppercase tracking-[0.2em] transition-colors">{{ $action['label'] }}</span>
                        </a>
                    @endforeach
                </section>
                <!--
                <div class="mt-6 flex items-center justify-center gap-2">
                    @if ($verification && $verification->status === 'approved')
<span
                            class="inline-flex items-center gap-2 text-[10px] px-4 py-2 rounded-full bg-emerald-500/20 text-emerald-400 font-black border border-emerald-500/30 uppercase tracking-widest shadow-lg shadow-emerald-500/10">
                            <i class="fa-solid fa-square-check text-xs"></i> Verified Identity
                        </span>
@else
<a href="{{ route('user.verify.create') }}"
                            class="inline-flex items-center gap-2 text-[10px] px-4 py-2 rounded-full bg-red-500/20 text-red-400 font-black border border-red-500/30 uppercase tracking-widest shadow-lg shadow-red-500/10 hover:bg-red-500/40 transition-all">
                            <i class="fa-solid fa-circle-exclamation text-xs"></i> Complete Verification
                        </a>
@endif
                </div>
                -->
            </div>
        </section>
    </div>



</div>



{{-- Main Content Grid: Assets & Traction --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Assets Tracker (Left) --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="px-2 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                <h3 class="font-black text-white uppercase text-xs tracking-widest">My Portfolio Assets</h3>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] text-emerald-600 font-black uppercase tracking-widest">Live Market</span>
            </div>
        </div>

        <section
            class="bg-white dark:bg-slate-800 rounded-[40px] shadow-xl border border-gray-100 dark:border-slate-700 overflow-hidden transition-colors">
            <div class="divide-y divide-gray-50 dark:divide-slate-700">
                @foreach ($results as $data)
                    @php $symbol = strtoupper($data->walletType->short_code); @endphp
                    <a href="/coin-preview/{{ $data->wallet_type_id }}" data-symbol="{{ $symbol }}"
                        data-holdings="{{ (float) $data->amount }}"
                        class="flex items-center px-8 py-6 hover:bg-gray-50/80 dark:hover:bg-slate-700/50 transition-all group coin-row">

                        <div
                            class="w-12 h-12 rounded-2xl bg-gray-50 dark:bg-slate-900 p-2 flex-shrink-0 border border-gray-100 dark:border-slate-700 group-hover:scale-110 transition-transform shadow-sm">
                            <img class="w-full h-full object-contain"
                                src="/images/crypto_logo/{{ $data->walletType->logo }}"
                                alt="{{ $data->walletType->coin_name }}" />
                        </div>

                        <div class="ml-5 flex-1">
                            <h4
                                class="text-sm font-black text-gray-900 dark:text-white tracking-tight leading-none group-hover:text-blue-600 transition-colors">
                                {{ $data->walletType->coin_name }}</h4>
                            <p
                                class="text-[10px] text-gray-400 dark:text-gray-500 font-black uppercase tracking-widest mt-1.5">
                                {{ (float) $data->amount }} <span
                                    class="text-blue-400 uppercase tracking-tighter">{{ $symbol }}</span></p>
                        </div>

                        <div class="text-right">
                            <div class="text-sm font-black text-gray-900 dark:text-white transition-colors duration-500"
                                id="price-{{ $symbol }}">$---.--</div>
                            <div class="mt-1">
                                <span
                                    class="text-[9px] font-black px-2 py-0.5 rounded-lg border border-transparent transition-all duration-500"
                                    id="change-{{ $symbol }}">0.00%</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Traction Widget (Right) --}}
    <div class="space-y-4">
        <div class="px-2 flex items-center justify-between">
            <h3 class="font-black text-gray-900 uppercase text-xs tracking-widest">Recent Traction</h3>
            <a href="{{ route('user-transactions') }}"
                class="text-[10px] font-black text-blue-600 uppercase hover:underline">View All</a>
        </div>

        <section class="bg-white rounded-[32px] shadow-lg border border-gray-100 overflow-hidden">
            <div class="divide-y divide-gray-50">
                @forelse($transactionsTable as $tx)
                    <div class="px-6 py-5 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center text-sm {{ $tx->status == 1 ? 'bg-emerald-50 text-emerald-600' : ($tx->status == 2 ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }}">
                            @if ($tx->transaction_type == 'deposit')
                                <i class="fa-solid fa-arrow-down-long"></i>
                            @elseif($tx->transaction_type == 'withdrawal')
                                <i class="fa-solid fa-arrow-up-long"></i>
                            @elseif($tx->transaction_type == 'exchange')
                                <i class="fa-solid fa-rotate"></i>
                            @else
                                <i class="fa-solid fa-receipt"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-black text-gray-900 truncate uppercase mt-0.5 tracking-tighter">
                                {{ $tx->transaction_type }}</p>
                            <p class="text-[9px] text-gray-400 font-bold">
                                {{ \Carbon\Carbon::parse($tx->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-gray-900">${{ number_format($tx->amount, 2) }}</p>
                            <p
                                class="text-[9px] font-black {{ $tx->status == 1 ? 'text-emerald-500' : ($tx->status == 2 ? 'text-red-500' : 'text-orange-500') }} uppercase">
                                {{ $tx->status == 1 ? 'Success' : ($tx->status == 2 ? 'Failed' : 'Pending') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <i class="fa-solid fa-inbox text-gray-100 text-3xl mb-2"></i>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">No Recent Activity
                        </p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Support Card --}}
        <div
            class="p-8 bg-gradient-to-br from-gray-900 to-black rounded-[32px] text-white shadow-xl relative overflow-hidden group">
            <i
                class="fa-solid fa-headset absolute -right-4 -bottom-4 text-white/5 text-8xl group-hover:scale-110 transition-transform"></i>
            <h4 class="font-black text-xs mb-2 relative">24/7 Concierge</h4>
            <p class="text-[10px] text-gray-400 leading-relaxed mb-4 relative">Need assistance with your
                institutional account or wire transfers?</p>
            <a href="{{ route('account-settings') }}"
                class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all relative">Contact
                Support</a>
        </div>
    </div>

</div>
</div>

@include('user.components.user')

<script>
    (function() {
        const symbols = Array.from(document.querySelectorAll('.coin-row')).map(row => row.dataset.symbol);
        const lastPrices = {};

        async function updateMarket() {
            if (symbols.length === 0) return;

            try {
                const fsyms = symbols.join(',');
                const response = await fetch(
                    `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${fsyms}&tsyms=USD`);
                const result = await response.json();

                if (result.RAW) {
                    let totalValue = 0;

                    symbols.forEach(sym => {
                        const data = result.RAW[sym]?.USD;
                        if (!data) return;

                        const priceEl = document.getElementById(`price-${sym}`);
                        const changeEl = document.getElementById(`change-${sym}`);
                        const row = document.querySelector(`[data-symbol="${sym}"]`);

                        const currentPrice = data.PRICE;
                        const changePercent = data.CHANGEPCT24HOUR;
                        const formattedPrice = new Intl.NumberFormat('en-US', {
                            style: 'currency',
                            currency: 'USD'
                        }).format(currentPrice);

                        if (lastPrices[sym]) {
                            if (currentPrice > lastPrices[sym]) {
                                priceEl.classList.remove('text-red-500', 'text-gray-900');
                                priceEl.classList.add('text-emerald-500');
                                setTimeout(() => priceEl.classList.add('text-gray-900'), 1000);
                            } else if (currentPrice < lastPrices[sym]) {
                                priceEl.classList.remove('text-emerald-500', 'text-gray-900');
                                priceEl.classList.add('text-red-500');
                                setTimeout(() => priceEl.classList.add('text-gray-900'), 1000);
                            }
                        }

                        lastPrices[sym] = currentPrice;
                        priceEl.textContent = formattedPrice;

                        const isPositive = changePercent >= 0;
                        changeEl.textContent = (isPositive ? '+' : '') + changePercent.toFixed(2) + '%';
                        changeEl.className =
                            `text-[9px] font-black px-2 py-0.5 rounded-lg border ${isPositive ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100'}`;

                        const holdings = parseFloat(row.dataset.holdings || 0);
                        totalValue += (holdings * currentPrice);
                    });

                    const portfolioEl = document.getElementById('totalPortfolioBalance');
                    if (portfolioEl) {
                        portfolioEl.textContent = totalValue.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                }
            } catch (error) {
                console.error('Market update failed:', error);
            }
        }

        updateMarket();
        setInterval(updateMarket, 10000);
    })();
</script>
