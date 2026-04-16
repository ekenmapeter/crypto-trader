@include('user.components.user_head', ['title' => $title ?? 'Swap Assets'])

@include('user.components.top-navbar')

<div class="min-h-screen bg-gray-50 flex flex-col items-center py-12 px-4 shadow-inner">
    
    <div class="w-full max-w-lg">
        {{-- Header Section --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Instant Exchange</h1>
            <p class="text-xs font-black text-blue-600 uppercase tracking-widest mt-2">Zero-Slippage Trading</p>
        </div>

        @if(session('error'))
            <div class="mb-6 animate-pulse bg-red-50 border border-red-100 text-red-600 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Main Swap UI --}}
        <div class="bg-white rounded-[48px] shadow-2xl shadow-blue-500/10 border border-gray-100 p-8 md:p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-3xl -mr-16 -mt-16"></div>
            
            {{-- From Section --}}
            <div class="space-y-3 relative">
                <div class="flex items-center justify-between px-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">You Send</label>
                    <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-2 py-0.5 rounded-lg" id="fromBalanceLabel">Balance: --</span>
                </div>
                <div class="bg-gray-50 rounded-[24px] p-6 hover:ring-2 hover:ring-blue-100 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <input type="number" id="fromAmount" step="0.00000001" placeholder="0.00" 
                                class="w-full bg-transparent border-none p-0 text-3xl font-black text-gray-900 focus:ring-0 placeholder-gray-300" />
                        </div>
                        <div class="h-10 w-px bg-gray-200"></div>
                        <div class="flex items-center gap-2 cursor-pointer">
                            <img id="fromIcon" src="" class="w-8 h-8 rounded-full object-contain bg-white shadow-sm border border-gray-100 p-1" />
                            <select id="fromSelect" class="bg-transparent border-none text-sm font-black text-gray-900 focus:ring-0 appearance-none pr-6 cursor-pointer">
                                @foreach($walletTypes as $coin)
                                    <option value="{{ $coin->id }}" data-icon="/images/crypto_logo/{{ $coin->logo }}" class="text-black">{{ $coin->short_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Swap Arrow Center --}}
            <div class="relative flex justify-center -my-4 z-10">
                <button id="flipButton" class="w-12 h-12 bg-white rounded-full shadow-lg border border-gray-100 text-blue-600 hover:scale-110 active:scale-95 transition-all flex items-center justify-center">
                    <i class="fa-solid fa-right-left rotate-90 text-lg"></i>
                </button>
            </div>

            {{-- To Section --}}
            <div class="space-y-3 relative">
                <div class="flex items-center justify-between px-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">You Receive</label>
                </div>
                <div class="bg-gray-50 rounded-[24px] p-6 border-2 border-transparent">
                    <div class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <input type="text" id="toAmount" readonly placeholder="0.00" 
                                class="w-full bg-transparent border-none p-0 text-3xl font-black text-gray-900 focus:ring-0 placeholder-gray-300" />
                        </div>
                        <div class="h-10 w-px bg-gray-200"></div>
                        <div class="flex items-center gap-2 cursor-pointer">
                            <img id="toIcon" src="" class="w-8 h-8 rounded-full object-contain bg-white shadow-sm border border-gray-100 p-1" />
                            <select id="toSelect" class="bg-transparent border-none text-sm font-black text-gray-900 focus:ring-0 appearance-none pr-6 cursor-pointer">
                                @foreach($walletTypes as $coin)
                                    <option value="{{ $coin->id }}" data-icon="/images/crypto_logo/{{ $coin->logo }}" class="text-black">{{ $coin->short_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rate Info Card --}}
            <div class="mt-8 p-5 bg-blue-600 rounded-[32px] text-white shadow-xl shadow-blue-200 group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest">Market Estimate</p>
                    <div class="flex gap-1">
                        <span class="w-1 h-1 bg-white/30 rounded-full animate-pulse"></span>
                        <span class="w-1 h-1 bg-white/60 rounded-full animate-pulse" style="animation-delay: 0.2s"></span>
                        <span class="w-1 h-1 bg-white/90 rounded-full animate-pulse" style="animation-delay: 0.4s"></span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h4 id="estimateText" class="text-3xl font-black">0.00</h4>
                        <p id="pairText" class="text-[10px] font-bold text-blue-100 mt-1 opacity-80">--</p>
                    </div>
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-lg">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <form action="{{ route('user.swap.store') }}" method="post" class="mt-8" onsubmit="return syncSwapForm()">
                @csrf
                <input type="hidden" name="from_wallet_type_id" id="fromInput">
                <input type="hidden" name="to_wallet_type_id" id="toInput">
                <input type="hidden" name="from_amount" id="fromAmountInput">
                <input type="hidden" name="rate" id="rateInput">
                
                <button type="submit" 
                    class="w-full bg-gray-900 hover:bg-black py-5 rounded-[24px] text-white font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center justify-center gap-3 group">
                    <span>Execute Swap</span>
                    <i class="fa-solid fa-bolt text-yellow-400 group-hover:scale-125 transition-transform"></i>
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-[10px] text-gray-400 font-bold">Estimated fee: <span class="text-emerald-500">0.00% (No Fee)</span></p>
            </div>
        </div>

        {{-- Footer Trust Section --}}
        <div class="mt-8 grid grid-cols-3 gap-4">
            <div class="text-center p-4 bg-white/50 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-shield text-blue-500 text-xs mb-2"></i>
                <p class="text-[9px] font-black text-gray-500 uppercase">Secure</p>
            </div>
            <div class="text-center p-4 bg-white/50 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-clock text-blue-500 text-xs mb-2"></i>
                <p class="text-[9px] font-black text-gray-500 uppercase">Instant</p>
            </div>
            <div class="text-center p-4 bg-white/50 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-check-double text-blue-500 text-xs mb-2"></i>
                <p class="text-[9px] font-black text-gray-500 uppercase">Verified</p>
            </div>
        </div>
    </div>
</div>

@include('user.components.user')
@include('user.components.auth-footer')

<script>
  // Dynamic user balance mapping from server-side
  const userBalances = @json($userWallets->pluck('amount', 'wallet_type_id'));

  async function fetchRate(from, to){
    try{
      if (!from || !to || from === to) return 1;
      const res = await fetch(`https://min-api.cryptocompare.com/data/pricemulti?fsyms=${from}&tsyms=${to}`);
      const data = await res.json();
      return data?.[from]?.[to] || 1;
    }catch(e){
      return 1;
    }
  }

  async function updateEstimate(){
    const fromSel = document.getElementById('fromSelect');
    const toSel = document.getElementById('toSelect');
    const fromAmount = parseFloat(document.getElementById('fromAmount').value || '0');
    
    const fromText = fromSel.options[fromSel.selectedIndex].text;
    const toText = toSel.options[toSel.selectedIndex].text;
    const fromId = fromSel.value;
    
    // Update Icons
    document.getElementById('fromIcon').src = fromSel.options[fromSel.selectedIndex].getAttribute('data-icon') || '';
    document.getElementById('toIcon').src = toSel.options[toSel.selectedIndex].getAttribute('data-icon') || '';
    
    // Update Balance Label
    const bal = userBalances[fromId] || 0;
    document.getElementById('fromBalanceLabel').textContent = `Balance: ${bal.toLocaleString()}`;

    const rate = await fetchRate(fromText, toText);
    const toAmount = (fromAmount || 0) * rate;
    
    document.getElementById('toAmount').value = toAmount ? toAmount.toFixed(8) : '';
    document.getElementById('estimateText').textContent = toAmount ? toAmount.toFixed(8) : '0.00';
    document.getElementById('pairText').textContent = `1 ${fromText} ≈ ${rate.toLocaleString()} ${toText}`;
    document.getElementById('rateInput').value = rate;
  }

  function syncSwapForm(){
    const fromSel = document.getElementById('fromSelect');
    const toSel = document.getElementById('toSelect');
    document.getElementById('fromInput').value = fromSel.value;
    document.getElementById('toInput').value = toSel.value;
    document.getElementById('fromAmountInput').value = document.getElementById('fromAmount').value;
    return true;
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('fromSelect').addEventListener('change', updateEstimate);
    document.getElementById('toSelect').addEventListener('change', updateEstimate);
    document.getElementById('fromAmount').addEventListener('input', updateEstimate);
    
    // Flip Button Logic
    document.getElementById('flipButton').addEventListener('click', () => {
        const fv = document.getElementById('fromSelect').value;
        const tv = document.getElementById('toSelect').value;
        document.getElementById('fromSelect').value = tv;
        document.getElementById('toSelect').value = fv;
        updateEstimate();
    });

    updateEstimate();
  });
</script>
