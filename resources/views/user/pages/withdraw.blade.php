@include('user.components.user_head', ['title' => 'Withdraw'])

@include('user.components.top-navbar')

<div class="px-4 py-8 space-y-6">
    <div class="bg-white text-black border border-gray-100 shadow-xl rounded-[24px] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-lg text-gray-800">Withdraw Funds</h3>
            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-full uppercase tracking-tighter">Secure Withdrawal</span>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-[16px] bg-green-50 border border-green-100 text-green-700 text-sm font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Select Coin</label>
                        <select id="walletTypeSelect" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all font-semibold">
                            @foreach($walletTypes ?? [] as $coin)
                                <option value="{{ $coin->id }}" class="text-black overflow-hidden">{{ $coin->coin_name }} ({{ $coin->short_code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Withdrawal Method</label>
                        <select id="methodSelect" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all font-semibold">
                            <option value="crypto" class="text-black">Crypto Wallet</option>
                            <option value="bank" class="text-black">Local Bank Account</option>
                            <option value="wire" class="text-black">International Wire Transfer</option>
                        </select>
                    </div>

                    <div id="cryptoFields" class="space-y-2 transform transition-all duration-300">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Destination Address</label>
                        <input type="text" id="destinationAddress" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Enter wallet address">
                    </div>

                    <div id="bankFields" class="space-y-4 hidden transform transition-all duration-300">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Bank Name</label>
                            <input type="text" id="bankName" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Bank name">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Account Name</label>
                            <input type="text" id="accountName" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Name on account">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Account Number</label>
                            <input type="text" id="accountNumber" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Number on account">
                        </div>
                    </div>

                    <div id="wireFields" class="space-y-2 hidden transform transition-all duration-300">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Wire Transfer Details</label>
                        <textarea id="wireDetails" class="w-full bg-gray-50 border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" rows="4" placeholder="Recipient bank info, SWIFT code, etc."></textarea>
                    </div>
                </div>

                <div class="bg-gray-50/50 p-6 rounded-[20px] border border-gray-100 h-fit">
                    <!-- Balance Summary Section -->
                    <div class="mb-8 space-y-4">
                        <div class="px-5 py-4 bg-gradient-to-r from-blue-900 to-blue-800 rounded-[20px] shadow-lg text-white">
                            <div class="text-[10px] font-bold opacity-60 uppercase tracking-widest mb-1">Total Available Balance</div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-sm font-bold opacity-80">$</span>
                                <span class="text-3xl font-extrabold">{{ number_format($totalWalletAmount, 2) }}</span>
                            </div>
                        </div>

                        <div class="grid gap-3">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Asset Balances</label>
                            <div class="max-h-[280px] overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                                @foreach($userWallets as $wallet)
                                    <div class="flex justify-between items-center px-4 py-3 bg-white border border-gray-100 rounded-[16px] shadow-sm">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gray-50 p-1 overflow-hidden">
                                                @if($wallet->walletType->logo)
                                                    <img src="/images/crypto_logo/{{ $wallet->walletType->logo }}" class="w-full h-full rounded-full" alt="">
                                                @else
                                                  <div class="w-full h-full rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-[10px]">
                                                      {{ strtoupper(substr($wallet->walletType->short_code, 0, 2)) }}
                                                  </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-xs font-bold text-gray-900 leading-tight">{{ $wallet->walletType->coin_name }}</div>
                                                <div class="text-[10px] font-bold text-gray-400">{{ strtoupper($wallet->walletType->short_code) }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-bold text-gray-900">{{ number_format($wallet->amount, 8) }}</div>
                                            <div class="text-[9px] font-bold text-green-500 uppercase">Available</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('user.withdraw.store') }}" method="post" class="space-y-6" onsubmit="return syncForm()">
                        @csrf
                        <input type="hidden" name="wallet_type_id" id="walletTypeId" value="{{ $walletTypes->first()->id ?? '' }}">
                        <input type="hidden" name="method" id="methodInput" value="crypto">
                        <input type="hidden" name="destination_address" id="destinationAddressInput">
                        <input type="hidden" name="bank_name" id="bankNameInput">
                        <input type="hidden" name="account_name" id="accountNameInput">
                        <input type="hidden" name="account_number" id="accountNumberInput">
                        <input type="hidden" name="wire_details" id="wireDetailsInput">

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Amount to Withdraw</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">$</span>
                                <input type="number" step="0.00000001" name="amount" class="w-full bg-white border border-gray-100 rounded-[12px] pl-8 pr-4 py-4 font-bold text-xl focus:ring-2 focus:ring-blue-500 transition-all" placeholder="0.00" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-[16px] bg-[#F5A623] text-black font-bold shadow-lg hover:shadow-xl hover:bg-black hover:text-white transition-all transform active:scale-95 duration-200">
                            PROCEED WITHDRAWAL
                        </button>

                        <p class="text-[10px] text-center text-gray-400 mt-4 leading-relaxed px-4">
                            <i class="fa-solid fa-lock mr-1"></i> Your transaction is secured with end-to-end encryption. Process time varies by method.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.components.user')
@include('user.components.auth-footer')

<script>
  function syncForm(){
    const method = document.getElementById('methodSelect').value;
    const walletTypeId = document.getElementById('walletTypeSelect').value;

    document.getElementById('methodInput').value = method;
    document.getElementById('walletTypeId').value = walletTypeId;
    document.getElementById('destinationAddressInput').value = document.getElementById('destinationAddress').value;
    document.getElementById('bankNameInput').value = document.getElementById('bankName').value;
    document.getElementById('accountNameInput').value = document.getElementById('accountName').value;
    document.getElementById('accountNumberInput').value = document.getElementById('accountNumber').value;
    document.getElementById('wireDetailsInput').value = document.getElementById('wireDetails').value;

    // Validate required fields based on method
    if (method === 'crypto' && !document.getElementById('destinationAddress').value) {
      alert('Please enter a destination address for crypto withdrawal');
      return false;
    }
    if (method === 'bank' && (!document.getElementById('bankName').value || !document.getElementById('accountName').value || !document.getElementById('accountNumber').value)) {
      alert('Please fill in all bank details');
      return false;
    }
    if (method === 'wire' && !document.getElementById('wireDetails').value) {
      alert('Please enter wire transfer details');
      return false;
    }

    return true;
  }
  document.addEventListener('DOMContentLoaded', () => {
    const methodSelect = document.getElementById('methodSelect');
    const cryptoFields = document.getElementById('cryptoFields');
    const bankFields = document.getElementById('bankFields');
    const wireFields = document.getElementById('wireFields');
    function update(){
      cryptoFields.classList.add('hidden');
      bankFields.classList.add('hidden');
      wireFields.classList.add('hidden');
      const m = methodSelect.value;
      if (m === 'crypto') cryptoFields.classList.remove('hidden');
      if (m === 'bank') bankFields.classList.remove('hidden');
      if (m === 'wire') wireFields.classList.remove('hidden');
    }
    methodSelect.addEventListener('change', update);
    update();
  });
</script>


