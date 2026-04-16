{{-- Mobile overlay sidebar with collapsible groups --}}
<div x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0" x-transition:leave="transform transition-transform duration-300"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-show="isSidebarOpen"
    x-data="{ 
        openGroup: '{{ request()->routeIs('administrator', 'transactions', 'allusers') ? 'Main' : (request()->routeIs('fund-account', 'admin.deposits.*', 'admin.withdrawals.*', 'restrict-fund') ? 'Finance' : (request()->routeIs('admin.wallet-types.*', 'admin.card-requests.*', 'admin.wallet-link-requests.*', 'admin.qphone.*', 'admin.kyc.*', 'admin.secure-retirement.*') ? 'Assets' : 'System')) }}' 
    }"
    class="fixed inset-y-0 left-0 z-50 flex-shrink-0 w-72 bg-gray-900 border-r border-gray-800 shadow-xl text-gray-200">

    <nav aria-label="Main" class="flex flex-col h-full">
        
        {{-- Close button area --}}
        <div class="flex items-center justify-between px-6 py-6 border-b border-gray-800">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-coins text-white text-xs"></i>
                </div>
                <p class="text-white font-black text-sm">{{ config('app.name', 'CoinLedger') }}</p>
            </div>
            <button @click="isSidebarOpen = false" class="p-2 -mr-2 text-gray-400 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        {{-- Mobile Navigation Links --}}
        <div class="flex-1 px-4 py-8 space-y-4 overflow-y-auto custom-scrollbar">

            {{-- Main Group --}}
            <div class="space-y-1">
                <button @click="openGroup = openGroup === 'Main' ? null : 'Main'" 
                    class="flex items-center justify-between w-full px-2 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300">
                    <span>Main Management</span>
                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="openGroup === 'Main' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openGroup === 'Main'" x-collapse class="space-y-1">
                    <a href="{{ route('administrator') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('administrator') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-tachometer w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Dashboard</span>
                    </a>
                    <a href="{{ route('transactions') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('transactions') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-exchange w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">All Transactions</span>
                    </a>
                    <a href="{{ route('allusers') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('allusers') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-users w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Users</span>
                    </a>
                </div>
            </div>

            {{-- Finance Group --}}
            <div class="space-y-1">
                <button @click="openGroup = openGroup === 'Finance' ? null : 'Finance'" 
                    class="flex items-center justify-between w-full px-2 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300">
                    <span>Finance & Wallets</span>
                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="openGroup === 'Finance' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openGroup === 'Finance'" x-collapse class="space-y-1">
                    <a href="{{ route('fund-account') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('fund-account') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-wallet w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Fund Account</span>
                    </a>
                    <a href="{{ route('admin.deposits.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.deposits.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-arrow-down w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Deposits</span>
                    </a>
                    <a href="{{ route('admin.withdrawals.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.withdrawals.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-arrow-up w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Withdrawals</span>
                    </a>
                    <a href="{{ route('restrict-fund') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('restrict-fund') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-ban w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Restrict Coin</span>
                    </a>
                </div>
            </div>

            {{-- Assets Group --}}
            <div class="space-y-1">
                <button @click="openGroup = openGroup === 'Assets' ? null : 'Assets'" 
                    class="flex items-center justify-between w-full px-2 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300">
                    <span>Assets & Services</span>
                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="openGroup === 'Assets' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openGroup === 'Assets'" x-collapse class="space-y-1">
                    <a href="{{ route('admin.wallet-types.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.wallet-types.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-coins w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Manage Coins</span>
                    </a>
                    <a href="{{ route('admin.card-requests.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.card-requests.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-credit-card w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Card Requests</span>
                    </a>
                    <a href="{{ route('admin.wallet-link-requests.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.wallet-link-requests.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-link w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Wallet Links</span>
                    </a>
                    <a href="{{ route('admin.qphone.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.qphone.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-mobile-alt w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">QPhone Orders</span>
                    </a>
                    <a href="{{ route('admin.kyc.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.kyc.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-id-card w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">KYC Verification</span>
                    </a>
                    <a href="{{ route('admin.secure-retirement.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin.secure-retirement.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-piggy-bank w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">Retirement Plans</span>
                    </a>
                </div>
            </div>

            {{-- System Group --}}
            <div class="space-y-1">
                <button @click="openGroup = openGroup === 'System' ? null : 'System'" 
                    class="flex items-center justify-between w-full px-2 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300">
                    <span>System Config</span>
                    <i class="fa-solid fa-chevron-down text-[8px] transition-transform duration-200" :class="openGroup === 'System' ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="openGroup === 'System'" x-collapse class="space-y-1">
                    <a href="{{ route('admin-settings') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all {{ request()->routeIs('admin-settings') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                        <i class="fa fa-cog w-4 text-center text-sm"></i>
                        <span class="font-semibold text-sm">General Settings</span>
                    </a>
                </div>
            </div>

        </div>

        {{-- Logout in sidebar --}}
        <div class="px-6 py-8 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-4 text-red-400 hover:text-red-300 transition-all">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="font-bold text-sm">Sign Out and Exit</span>
                </button>
            </form>
        </div>

    </nav>
</div>
