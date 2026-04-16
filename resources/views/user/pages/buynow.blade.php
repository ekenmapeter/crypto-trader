@php($title = 'Buy Crypto')
@include('user.components.user_head')

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="min-h-screen bg-gray-50 flex flex-col font-sans">
    <!-- Sticky Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('user') }}" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-all">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h1 class="text-xl font-black text-gray-900 leading-none">Buy Crypto</h1>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Manual Bank & PayPal Transfer</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 border border-blue-100">
                    <i class="fas fa-university text-sm"></i>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <!-- Hero -->
        <div class="text-center mb-12 px-4">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tighter mb-3 leading-tight">Purchase Digital Assets</h2>
            <p class="text-base text-gray-500 max-w-xl mx-auto font-medium">Send payment via bank transfer or PayPal, upload your receipt, and our team will credit your wallet within 30 minutes.</p>
        </div>

        <!-- Payment Instructions Card -->
        @if($setting)
        <div class="bg-white rounded-[32px] border border-gray-100 shadow-xl shadow-gray-100/60 overflow-hidden mb-10">
            <div class="px-8 py-5 border-b border-gray-50 bg-blue-600 flex items-center gap-3">
                <i class="fa-solid fa-circle-info text-white/80 text-lg"></i>
                <h3 class="font-black text-white uppercase tracking-wider text-sm">Payment Instructions</h3>
            </div>
            <div class="p-8 grid md:grid-cols-2 gap-6">
                <!-- Bank Transfer -->
                <div class="bg-gray-50 rounded-[20px] p-6 border border-gray-100 space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-building-columns text-blue-600 text-sm"></i>
                        </div>
                        <span class="font-black text-gray-800 text-sm uppercase tracking-wider">Bank Transfer</span>
                    </div>
                    @if($setting->bank_name || $setting->account_name || $setting->account_number)
                    <div class="space-y-3">
                        @if($setting->bank_name)
                        <div class="flex justify-between items-center bg-white/50 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Bank Name</span>
                            <span class="text-xs font-black text-gray-900">{{ $setting->bank_name }}</span>
                        </div>
                        @endif
                        @if($setting->account_name)
                        <div class="flex justify-between items-center bg-white/50 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Account Name</span>
                            <span class="text-xs font-black text-gray-900">{{ $setting->account_name }}</span>
                        </div>
                        @endif
                        @if($setting->account_number)
                        <div class="flex justify-between items-center bg-white/50 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Account No.</span>
                            <span class="text-xs font-black text-gray-900 select-all">{{ $setting->account_number }}</span>
                        </div>
                        @endif
                        @if($setting->routing_number)
                        <div class="flex justify-between items-center bg-white/50 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Routing / Swift</span>
                            <span class="text-xs font-black text-gray-900 select-all">{{ $setting->routing_number }}</span>
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="text-sm text-gray-400 italic">Bank details not configured yet. Please contact support.</p>
                    @endif
                </div>

                <!-- PayPal -->
                <div class="bg-gray-50 rounded-[20px] p-6 border border-gray-100 space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-brands fa-paypal text-blue-600 text-sm"></i>
                        </div>
                        <span class="font-black text-gray-800 text-sm uppercase tracking-wider">PayPal</span>
                    </div>
                    @if($setting->paypal_email)
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Send To</span>
                        <span class="text-sm font-black text-gray-800 select-all">{{ $setting->paypal_email }}</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Use "Friends & Family" when sending via PayPal to avoid fees.</p>
                    @else
                    <p class="text-sm text-gray-400 italic">PayPal not configured yet. Please contact support.</p>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Asset List -->
        <div class="bg-white rounded-[32px] border border-gray-100 shadow-xl shadow-gray-100/60 overflow-hidden">
            <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest ml-2">Select Asset to Buy</span>
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest mr-2">Action</span>
            </div>

            <div class="divide-y divide-gray-50">
                @forelse($activeWalletTypes as $walletType)
                <div x-data="{ open: false }" class="group">
                    <div class="flex items-center justify-between p-6 hover:bg-blue-50/30 transition-all duration-300">
                        <div class="flex items-center space-x-5">
                            <div class="relative">
                                <div class="w-14 h-14 bg-white rounded-2xl shadow border border-gray-100 p-2.5 group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                    <img src="/images/crypto_logo/{{ $walletType->logo }}" alt="{{ $walletType->coin_name }}" class="w-full h-full object-contain"/>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-base font-black text-gray-900">{{ $walletType->coin_name }}</h3>
                                    <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $walletType->short_code }}</span>
                                </div>
                                <p class="text-[10px] text-gray-400 font-bold tracking-widest uppercase mt-0.5">Manual Transfer</p>
                            </div>
                        </div>

                        <button @click="open = true; document.body.style.overflow = 'hidden'"
                            class="bg-gray-900 hover:bg-blue-600 text-white px-7 py-2.5 rounded-2xl font-black text-xs transition-all duration-300 shadow hover:shadow-blue-200 hover:-translate-y-0.5">
                            Buy Now
                        </button>
                    </div>

                    <!-- Purchase Modal -->
                    <div x-show="open"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">

                        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" @click="open = false; document.body.style.overflow = 'auto'"></div>

                        <div class="bg-white rounded-[32px] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100">

                            <!-- Modal Header -->
                            <div class="bg-blue-600 px-8 py-6 flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl p-2.5">
                                        <img src="/images/crypto_logo/{{ $walletType->logo }}" class="w-full h-full object-contain" alt="{{ $walletType->coin_name }}">
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-blue-200 font-black uppercase tracking-widest mb-0.5">Purchase Order</p>
                                        <h2 class="text-2xl font-black text-white">Buy {{ $walletType->coin_name }}</h2>
                                    </div>
                                </div>
                                <button @click="open = false; document.body.style.overflow = 'auto'" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center text-white transition-all">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="px-8 py-7 overflow-y-auto max-h-[70vh]">
                                <form action="{{ url('buy-crypto') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="wallet_type_id" value="{{ $walletType->id }}">
                                    <input type="hidden" name="coin_name" value="{{ $walletType->coin_name }}">
                                    <input type="hidden" name="short_code" value="{{ $walletType->short_code }}">
                                    <input type="hidden" name="logo" value="{{ $walletType->logo }}">

                                    <!-- Amount -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Amount in USD ($)</label>
                                        <div class="relative">
                                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-xl font-black text-gray-300">$</div>
                                            <input type="number" name="amount" placeholder="0.00" required step="0.01" min="1"
                                                class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-500 rounded-[16px] pl-10 pr-5 py-4 text-xl font-black text-gray-900 transition-all outline-none">
                                        </div>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Payment Method</label>
                                        <select name="payment_method" required class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-500 rounded-[16px] px-5 py-4 text-gray-900 font-bold outline-none cursor-pointer appearance-none transition-all">
                                            <option value="">Select method...</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>

                                    <!-- Payment Reference / Receipt Upload -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Payment Receipt / Proof</label>
                                        <input type="file" name="receipt_upload" accept="image/*,.pdf"
                                            class="w-full bg-gray-50 border-2 border-dashed border-gray-200 focus:border-blue-500 rounded-[16px] px-5 py-4 text-gray-600 text-sm font-bold outline-none transition-all cursor-pointer file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-100 file:text-blue-700">
                                        <p class="text-[10px] text-gray-400 ml-1">Upload a screenshot or PDF of your payment confirmation.</p>
                                    </div>

                                    <!-- Note -->
                                    <div class="bg-amber-50 rounded-2xl p-4 border border-amber-100 flex gap-3">
                                        <i class="fa-solid fa-clock text-amber-500 mt-0.5"></i>
                                        <p class="text-xs text-amber-700 font-medium leading-relaxed">After submitting, our team will verify your payment and credit your wallet within <strong>30 minutes</strong> during business hours.</p>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-2xl text-white font-black text-base transition-all shadow-lg hover:shadow-blue-200 active:scale-95 flex items-center justify-center gap-2">
                                        <i class="fas fa-paper-plane"></i>
                                        Submit Purchase Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <i class="fas fa-coins text-gray-200 text-5xl mb-4"></i>
                    <p class="text-gray-400 font-bold">No assets available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        <p class="text-center text-[11px] text-gray-400 font-bold mt-8 uppercase tracking-widest">All transactions are manually reviewed &amp; secured.</p>
    </main>
</div>

@include('user.components.auth-footer')
