@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-20">
    
    {{-- Page Header --}}
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Financial Treasury</h1>
        <p class="text-sm text-gray-500 font-medium">Directly credit user wallets with various crypto assets.</p>
    </div>

    {{-- Funding Form Card --}}
    <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-500/5 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50"></div>
        
        <div class="relative p-8 md:p-12">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-200">
                    <i class="fa-solid fa-vault text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900">Direct Wallet Credit</h2>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Authorized Transaction Only</p>
                </div>
            </div>

            <form action="{{ route('fund') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf
                
                {{-- User Selection --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Target User Account</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <select name="email" required
                            class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-[20px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer">
                            <option value="">Select a user email...</option>
                            @foreach($getuser as $user)
                                <option value="{{ $user->id }}">{{ $user->email }} ({{ $user->firstname }})</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 text-[10px] pointer-events-none"></i>
                    </div>
                </div>

                {{-- Asset Selection --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Crypto Asset Type</label>
                    <div class="relative">
                        <i class="fa-solid fa-coins absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <select name="crypto" required
                            class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-[20px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer">
                            <option value="">Select coin to credit...</option>
                            @foreach($getcoin as $coin)
                                <option value="{{ $coin->id }}">{{ $coin->coin_name }} ({{ strtoupper($coin->short_code ?? '') }})</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 text-[10px] pointer-events-none"></i>
                    </div>
                </div>

                {{-- Amount Input --}}
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 text-center block">Amount to Credit (USD)</label>
                    <div class="relative max-w-md mx-auto">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-2xl font-black text-gray-400">$</span>
                        <input type="number" name="amount" placeholder="0.00" step="0.01" required
                            class="w-full pl-12 pr-6 py-6 bg-blue-50/50 border-2 border-transparent focus:border-blue-500 rounded-[30px] text-3xl font-black text-gray-900 focus:ring-0 transition-all text-center">
                    </div>
                    <p class="text-[10px] text-gray-400 text-center font-bold italic mt-2">
                        <i class="fa-solid fa-circle-info mr-1"></i> This action will increase the user's balance instantly.
                    </p>
                </div>

                {{-- Dynamic Balance Display --}}
                <div class="md:col-span-2 p-6 bg-blue-50/30 rounded-3xl border border-blue-100 flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-blue-500 shadow-sm">
                            <i class="fa-solid fa-scale-balanced text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Current Wallet Balance</p>
                            <p class="text-xs text-blue-400 font-bold">Live selection data</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span id="current-balance" class="text-2xl font-black text-blue-600">0.00</span>
                        <span class="text-[10px] text-blue-400 font-black uppercase ml-1" id="coin-symbol">ASSET</span>
                    </div>
                </div>

                <div class="md:col-span-2 pt-4">
                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-[24px] text-white font-black text-base transition-all shadow-xl shadow-blue-200 active:scale-95 flex items-center justify-center gap-3">
                        <i class="fa-solid fa-paper-plane"></i>
                        Complete Transmission
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userSelect = document.querySelector('select[name="email"]');
        const coinSelect = document.querySelector('select[name="crypto"]');
        const amountInput = document.querySelector('input[name="amount"]');
        const balanceDisplay = document.getElementById('current-balance');
        const symbolDisplay = document.getElementById('coin-symbol');
        
        // Add conversion display elements
        const usdBalanceDisplay = document.createElement('div');
        usdBalanceDisplay.className = 'text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1';
        usdBalanceDisplay.id = 'current-balance-usd';
        usdBalanceDisplay.innerText = 'Calculating USD...';
        balanceDisplay.parentElement.appendChild(usdBalanceDisplay);

        const conversionHint = document.createElement('p');
        conversionHint.className = 'text-[11px] text-blue-600 font-black text-center mt-3 animate-pulse';
        conversionHint.id = 'conversion-hint';
        amountInput.parentElement.parentElement.appendChild(conversionHint);

        let currentCoinPrice = 0;

        async function fetchPrice(symbol) {
            try {
                const response = await fetch(`https://min-api.cryptocompare.com/data/price?fsym=${symbol}&tsyms=USD`);
                const data = await response.json();
                return data.USD || 0;
            } catch (e) {
                console.error('Price fetch failed', e);
                return 0;
            }
        }

        async function updateBalance() {
            const userId = userSelect.value;
            const walletTypeId = coinSelect.value;
            let symbol = 'ASSET';
            
            if (coinSelect.selectedIndex > 0) {
                const selectedText = coinSelect.options[coinSelect.selectedIndex].text;
                const match = selectedText.match(/\((.*?)\)/);
                symbol = match ? match[1] : 'ASSET';
                symbolDisplay.innerText = symbol;
            } else {
                symbolDisplay.innerText = 'ASSET';
                usdBalanceDisplay.innerText = '';
            }

            if (symbol !== 'ASSET') {
                currentCoinPrice = await fetchPrice(symbol);
            } else {
                currentCoinPrice = 0;
            }

            if (userId && walletTypeId) {
                balanceDisplay.style.opacity = '0.5';
                fetch(`{{ route('admin.get-user-balance') }}?user_id=${userId}&wallet_type_id=${walletTypeId}`)
                    .then(response => response.json())
                    .then(data => {
                        const cryptoAmount = parseFloat(data.balance);
                        balanceDisplay.innerText = cryptoAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 8});
                        
                        if (currentCoinPrice > 0) {
                            const usdVal = cryptoAmount * currentCoinPrice;
                            usdBalanceDisplay.innerText = `≈ $${usdVal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})} USD`;
                        } else {
                            usdBalanceDisplay.innerText = '';
                        }
                        
                        balanceDisplay.style.opacity = '1';
                        updateConversionHint();
                    })
                    .catch(error => {
                        console.error('Error fetching balance:', error);
                        balanceDisplay.innerText = 'Error';
                        balanceDisplay.style.opacity = '1';
                    });
            } else {
                balanceDisplay.innerText = '0.00';
                usdBalanceDisplay.innerText = '';
                conversionHint.style.display = 'none';
            }
        }

        function updateConversionHint() {
            const usdAmount = parseFloat(amountInput.value || 0);
            const symbol = symbolDisplay.innerText;
            if (usdAmount > 0 && currentCoinPrice > 0 && symbol !== 'ASSET') {
                const cryptoAmount = usdAmount / currentCoinPrice;
                conversionHint.innerText = `Recipient will receive: ${cryptoAmount.toFixed(8)} ${symbol}`;
                conversionHint.style.display = 'block';
            } else {
                conversionHint.style.display = 'none';
            }
        }

        userSelect.addEventListener('change', updateBalance);
        coinSelect.addEventListener('change', updateBalance);
        amountInput.addEventListener('input', updateConversionHint);
    });
</script>

    {{-- Asset Summary List --}}
    <div class="space-y-4">
        <h3 class="text-sm font-black text-gray-400 uppercase tracking-widest px-4">Available Network Assets</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($getcoin as $coin)
            <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm flex flex-col items-center gap-3 hover:border-blue-200 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-100 group-hover:scale-110 transition-transform">
                    <img src="/images/crypto_logo/{{ $coin->logo }}" alt="{{ $coin->coin_name }}" class="w-8 h-8 object-contain" />
                </div>
                <div class="text-center">
                    <p class="text-xs font-black text-gray-900 truncate max-w-[100px]">{{ $coin->coin_name }}</p>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $coin->short_code }}</p>
                    <div class="mt-1 px-2 py-0.5 bg-blue-50 rounded-full">
                        <p class="text-[10px] font-black text-blue-600">{{ number_format($coin->total_balance, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
