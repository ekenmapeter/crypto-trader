{{-- Modern always-visible desktop sidebar with collapsible groups --}}
<aside x-data="{ openGroup: '{{ request()->routeIs('administrator', 'transactions', 'allusers') ? 'Main' : (request()->routeIs('fund-account', 'admin.deposits.*', 'admin.withdrawals.*', 'restrict-fund') ? 'Finance' : (request()->routeIs('admin.wallet-types.*', 'admin.card-requests.*', 'admin.wallet-link-requests.*', 'admin.qphone.*', 'admin.kyc.*', 'admin.secure-retirement.*') ? 'Assets' : 'System')) }}' }" 
    class="hidden sm:flex flex-col w-64 min-h-screen bg-gray-900 border-r border-gray-800 shadow-xl flex-shrink-0">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 py-6 border-b border-gray-800">
        <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-coins text-white text-sm"></i>
        </div>
        <div class="min-w-0">
            <p class="text-white font-black text-sm leading-none truncate">{{ config('app.name', 'CoinLedger') }}</p>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mt-0.5">Admin Panel</p>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-5 space-y-2 overflow-y-auto custom-scrollbar">

        {{-- Main Group --}}
        <div>
            <button @click="openGroup = openGroup === 'Main' ? null : 'Main'" 
                class="flex items-center justify-between w-full px-3 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300 transition-colors">
                <span>Main Management</span>
                <i class="fa-solid fa-chevron-down transition-transform duration-200" :class="openGroup === 'Main' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="openGroup === 'Main'" x-collapse class="mt-1 space-y-1">
                <a href="{{ route('administrator') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('administrator') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-tachometer w-4 text-center text-sm {{ request()->routeIs('administrator') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>
                <a href="{{ route('transactions') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('transactions') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-exchange w-4 text-center text-sm {{ request()->routeIs('transactions') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">All Transactions</span>
                </a>
                <a href="{{ route('allusers') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('allusers') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-users w-4 text-center text-sm {{ request()->routeIs('allusers') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Users</span>
                </a>
            </div>
        </div>

        {{-- Finance Group --}}
        <div>
            <button @click="openGroup = openGroup === 'Finance' ? null : 'Finance'" 
                class="flex items-center justify-between w-full px-3 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300 transition-colors">
                <span>Finance & Wallets</span>
                <i class="fa-solid fa-chevron-down transition-transform duration-200" :class="openGroup === 'Finance' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="openGroup === 'Finance'" x-collapse class="mt-1 space-y-1">
                <a href="{{ route('fund-account') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('fund-account') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-wallet w-4 text-center text-sm {{ request()->routeIs('fund-account') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Fund Account</span>
                </a>
                <a href="{{ route('admin.deposits.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.deposits.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-arrow-down w-4 text-center text-sm {{ request()->routeIs('admin.deposits.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Deposits</span>
                </a>
                <a href="{{ route('admin.withdrawals.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.withdrawals.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-arrow-up w-4 text-center text-sm {{ request()->routeIs('admin.withdrawals.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Withdrawals</span>
                </a>
                <a href="{{ route('restrict-fund') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('restrict-fund') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-ban w-4 text-center text-sm {{ request()->routeIs('restrict-fund') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Restrict Coin</span>
                </a>
            </div>
        </div>

        {{-- Assets Group --}}
        <div>
            <button @click="openGroup = openGroup === 'Assets' ? null : 'Assets'" 
                class="flex items-center justify-between w-full px-3 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300 transition-colors">
                <span>Assets & Services</span>
                <i class="fa-solid fa-chevron-down transition-transform duration-200" :class="openGroup === 'Assets' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="openGroup === 'Assets'" x-collapse class="mt-1 space-y-1">
                <a href="{{ route('admin.wallet-types.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.wallet-types.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-coins w-4 text-center text-sm {{ request()->routeIs('admin.wallet-types.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Manage Coins</span>
                </a>
                <a href="{{ route('admin.card-requests.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.card-requests.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-credit-card w-4 text-center text-sm {{ request()->routeIs('admin.card-requests.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Card Requests</span>
                </a>
                <a href="{{ route('admin.wallet-link-requests.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.wallet-link-requests.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-link w-4 text-center text-sm {{ request()->routeIs('admin.wallet-link-requests.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Wallet Links</span>
                </a>
                <a href="{{ route('admin.qphone.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.qphone.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-mobile-alt w-4 text-center text-sm {{ request()->routeIs('admin.qphone.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">QPhone Orders</span>
                </a>
                <a href="{{ route('admin.kyc.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.kyc.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-id-card w-4 text-center text-sm {{ request()->routeIs('admin.kyc.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">KYC Verification</span>
                </a>
                <a href="{{ route('admin.secure-retirement.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin.secure-retirement.*') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-piggy-bank w-4 text-center text-sm {{ request()->routeIs('admin.secure-retirement.*') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">Retirement Plans</span>
                </a>
            </div>
        </div>

        {{-- System Group --}}
        <div>
            <button @click="openGroup = openGroup === 'System' ? null : 'System'" 
                class="flex items-center justify-between w-full px-3 py-2 text-[10px] font-black text-gray-500 uppercase tracking-widest hover:text-gray-300 transition-colors">
                <span>System Config</span>
                <i class="fa-solid fa-chevron-down transition-transform duration-200" :class="openGroup === 'System' ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="openGroup === 'System'" x-collapse class="mt-1 space-y-1">
                <a href="{{ route('admin-settings') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-400 hover:bg-gray-800 hover:text-white transition-all group {{ request()->routeIs('admin-settings') ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : '' }}">
                    <i class="fa fa-cog w-4 text-center text-sm {{ request()->routeIs('admin-settings') ? 'text-blue-400' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-semibold text-sm">General Settings</span>
                </a>
            </div>
        </div>

    </nav>

    {{-- Footer / Logout --}}
    <div class="px-4 py-5 border-t border-gray-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-500/10 transition-all group">
                <i class="fa fa-sign-out-alt w-4 text-center text-sm"></i>
                <span class="font-semibold text-sm">Logout</span>
            </button>
        </form>
    </div>

</aside>

<style>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 10px; }
.custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #374151; }
</style>
