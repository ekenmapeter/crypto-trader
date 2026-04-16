@php($title = 'Link Wallet')
@include('user.components.user_head')

<div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('user') }}" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-all">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 leading-none">Connect Wallet</h1>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider font-semibold">Security & Integration</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="px-3 py-1 bg-green-50 rounded-full border border-green-100 flex items-center space-x-2">
                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-bold text-green-700 uppercase">Secure Line</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-[24px] shadow-lg shadow-blue-200 mb-6">
                <i class="fas fa-link text-white text-3xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Unified Portfolio Access</h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Connect your external wallets to synchronize balances, track performance, and execute secure withdrawals directly through our encrypted gateway.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Features -->
            <div class="lg:col-span-12">
                <div class="bg-white rounded-[32px] border border-gray-200 shadow-sm overflow-hidden p-8 md:p-12 mb-8">
                    <div class="grid md:grid-cols-3 gap-8 text-center md:text-left">
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mx-auto md:mx-0">
                                <i class="fas fa-shield-alt text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">End-to-End Encryption</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">All wallet data is encrypted using military-grade AES-256 protocols before leaving your browser.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mx-auto md:mx-0">
                                <i class="fas fa-sync text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Real-time Sync</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Instantly synchronize your balances across multiple chains including BTC, ETH, and Solana.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mx-auto md:mx-0">
                                <i class="fas fa-bolt text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Streamlined Withdrawals</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">Linked wallets enable one-click withdrawal authorization for a faster, more professional experience.</p>
                        </div>
                    </div>

                    <div class="mt-12 pt-12 border-t border-gray-100 flex flex-col items-center">
                        <div class="bg-blue-600 hover:bg-blue-700 text-white rounded-[20px] px-10 py-5 font-bold text-lg shadow-xl shadow-blue-100 transition-all hover:scale-[1.02] cursor-pointer inline-flex items-center space-x-3" onclick="window.location.href='{{ route('coin-wallet') }}'">
                            <span>Get Started Now</span>
                            <i class="fas fa-chevron-right text-sm"></i>
                        </div>
                        <p class="mt-6 text-gray-400 text-sm flex items-center">
                            <i class="fas fa-lock mr-2 text-green-500"></i>
                            Secure connection facilitated via WalletConnect & HTTPS
                        </p>
                    </div>
                </div>

                <!-- Portfolio Context -->
                <div class="bg-gray-900 rounded-[32px] p-8 md:p-10 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div>
                            <span class="text-blue-400 font-bold uppercase tracking-widest text-xs">Total Portfolio Value</span>
                            <h2 class="text-4xl md:text-5xl font-black mt-2 tracking-tighter">${{ number_format($totalWalletAmount, 2) }}</h2>
                            <p class="text-gray-400 mt-2">Aggregated from {{ count(auth()->user()->userWallets) }} internal crypto assets</p>
                        </div>
                        <div class="w-full md:w-auto flex flex-col space-y-3">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center justify-between gap-8">
                                <span class="text-gray-300 font-medium">Internal Assets</span>
                                <span class="font-bold text-xl">${{ number_format($totalWalletAmount, 2) }}</span>
                            </div>
                            <div class="bg-blue-500/20 backdrop-blur-md border border-blue-500/30 rounded-2xl p-4 flex items-center justify-between gap-8">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 animate-pulse"></div>
                                    <span class="text-blue-200 font-medium">External (Linked)</span>
                                </div>
                                <span class="font-bold text-xl text-blue-400">$0.00</span>
                            </div>
                        </div>
                    </div>
                    <!-- Abstract Background Decorations -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-600/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center text-gray-400 text-sm">
            <p>Trusted by institutional traders and individual investors worldwide.</p>
            <div class="flex justify-center space-x-6 mt-4 opacity-50 grayscale">
                <i class="fab fa-bitcoin text-2xl"></i>
                <i class="fab fa-ethereum text-2xl"></i>
                <i class="fab fa-stripe text-2xl"></i>
                <i class="fas fa-vault text-2xl"></i>
            </div>
        </div>
    </main>
</div>

@include('user.components.auth-footer')
