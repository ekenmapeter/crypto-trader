@extends('layouts.admin')

@section('content')
<div class="space-y-8 pb-12">
    
    {{-- Top Greeting --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Dashboard Overview</h1>
            <p class="text-sm text-gray-500 font-medium">Welcome back, <span class="text-blue-600 underline decoration-2 underline-offset-4">{{ Auth::user()->firstname }}</span>. Here's what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden md:flex flex-col items-end text-right">
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ now()->format('l, jS F') }}</p>
                <p class="text-[10px] text-gray-400 font-bold" id="live-clock">{{ now()->format('H:i:s') }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center shadow-sm">
                <i class="fa-solid fa-calendar-day text-blue-500"></i>
            </div>
        </div>
    </div>

    {{-- Main Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Total Users --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-blue-500/5 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Users</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ number_format($totalUsers ?? 0) }}</h3>
                    <p class="text-[10px] text-emerald-500 font-bold mt-1"><i class="fa-solid fa-arrow-trend-up mr-1"></i> Platform Growth</p>
                </div>
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Transactions --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Transactions</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ number_format($totalTransactions ?? 0) }}</h3>
                    <p class="text-[10px] text-emerald-500 font-bold mt-1"><i class="fa-solid fa-check mr-1"></i> Live Activity</p>
                </div>
                <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <i class="fa-solid fa-money-bill-transfer text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Active Coins --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-purple-500/5 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-purple-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Active Assets</p>
                    <h3 class="text-3xl font-black text-gray-900">{{ $activeCoins ?? 0 }}<span class="text-gray-300 text-lg">/{{ $totalCoins ?? 0 }}</span></h3>
                    <p class="text-[10px] text-purple-500 font-bold mt-1"><i class="fa-solid fa-coins mr-1"></i> Live Currencies</p>
                </div>
                <div class="w-14 h-14 bg-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-purple-200">
                    <i class="fa-solid fa-chart-pie text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Pending Actions --}}
        <div class="bg-white rounded-[32px] p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-orange-500/5 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-110 transition-transform"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Action Required</p>
                    <h3 class="text-3xl font-black text-orange-600">{{ ($pendingKyc ?? 0) + ($pendingDeposits ?? 0) + ($pendingWithdrawals ?? 0) }}</h3>
                    <p class="text-[10px] text-orange-400 font-bold mt-1 animate-pulse"><i class="fa-solid fa-circle-exclamation mr-1"></i> Pending Verification</p>
                </div>
                <div class="w-14 h-14 bg-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-bell-concierge text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- Detailed Sections --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Recent Transactions --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between px-2">
                <h2 class="text-lg font-black text-gray-900">Recent Transactions</h2>
                <a href="{{ route('transactions') }}" class="text-xs font-bold text-blue-600 hover:underline">View All</a>
            </div>
            
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">User</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Type</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Amount</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentTransactions as $tx)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 font-bold text-xs">
                                            {{ strtoupper(substr($tx->user->firstname ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 leading-none">{{ $tx->user->firstname ?? 'User' }}</p>
                                            <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $tx->user->email ?? '--' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-gray-700">{{ $tx->transaction_type }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-black text-gray-900">${{ number_format($tx->amount, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($tx->status == 0)
                                        <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-[10px] font-black uppercase tracking-widest">Pending</span>
                                    @elseif($tx->status == 1)
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest">Success</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest">Failed</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('order-preview', $tx->id) }}" class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-gray-200 text-gray-400 hover:text-blue-600 transition-all">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <i class="fa-solid fa-inbox text-gray-200 text-4xl mb-3"></i>
                                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">No recent transactions</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pending Queue Sidebar --}}
        <div class="space-y-4">
            <h2 class="text-lg font-black text-gray-900 px-2">Action Required</h2>
            
            <div class="space-y-3">
                {{-- KYC --}}
                <a href="{{ route('admin.kyc.index') }}" class="block p-4 bg-white rounded-3xl border border-gray-100 shadow-sm hover:translate-x-1 hover:border-blue-200 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-sm">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900">KYC Verifications</p>
                                <p class="text-[10px] text-gray-400 font-bold mt-0.5">Approve user identity</p>
                            </div>
                        </div>
                        <span class="bg-orange-500 text-white text-[10px] font-black px-2 py-0.5 rounded-lg">{{ $pendingKyc ?? 0 }}</span>
                    </div>
                </a>

                {{-- Deposits --}}
                <a href="{{ route('admin.deposits.index') }}" class="block p-4 bg-white rounded-3xl border border-gray-100 shadow-sm hover:translate-x-1 hover:border-emerald-200 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-sm">
                                <i class="fa-solid fa-arrow-down-long"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900">Pending Deposits</p>
                                <p class="text-[10px] text-gray-400 font-bold mt-0.5">Verify incoming funds</p>
                            </div>
                        </div>
                        <span class="bg-emerald-500 text-white text-[10px] font-black px-2 py-0.5 rounded-lg">{{ $pendingDeposits ?? 0 }}</span>
                    </div>
                </a>

                {{-- Withdrawals --}}
                <a href="{{ route('admin.withdrawals.index') }}" class="block p-4 bg-white rounded-3xl border border-gray-100 shadow-sm hover:translate-x-1 hover:border-red-200 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-sm">
                                <i class="fa-solid fa-arrow-up-long"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900">Withdrawal Requests</p>
                                <p class="text-[10px] text-gray-400 font-bold mt-0.5">Process user payouts</p>
                            </div>
                        </div>
                        <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-lg">{{ $pendingWithdrawals ?? 0 }}</span>
                    </div>
                </a>

                {{-- QPhone --}}
                <a href="{{ route('admin.qphone.index') }}" class="block p-4 bg-white rounded-3xl border border-gray-100 shadow-sm hover:translate-x-1 hover:border-indigo-200 transition-all">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-sm">
                                <i class="fa-solid fa-mobile-screen"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900">QPhone Orders</p>
                                <p class="text-[10px] text-gray-400 font-bold mt-0.5">Manage hardware orders</p>
                            </div>
                        </div>
                        <span class="bg-indigo-500 text-white text-[10px] font-black px-2 py-0.5 rounded-lg">{{ $pendingQPhoneOrders ?? 0 }}</span>
                    </div>
                </a>
            </div>

            {{-- Support Card --}}
            <div class="p-6 bg-gradient-to-br from-gray-900 to-gray-800 rounded-[32px] text-white overflow-hidden relative group">
                <i class="fa-solid fa-shield-halved absolute -right-4 -bottom-4 text-white/5 text-8xl transition-all group-hover:scale-110"></i>
                <h3 class="font-black text-sm mb-2 relative">System Security</h3>
                <p class="text-[11px] text-gray-400 leading-relaxed mb-4 relative">All administrative actions are logged. Ensure two-factor authentication is active on all admin accounts.</p>
                <a href="{{ route('admin-settings') }}" class="inline-block py-2 px-4 bg-white/10 hover:bg-white/20 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all relative">Settings</a>
            </div>
        </div>

    </div>

</div>

<script>
    // Live clock for the dashboard
    function updateClock() {
        const now = new Date();
        const clock = document.getElementById('live-clock');
        if(clock) {
            clock.innerText = now.toLocaleTimeString();
        }
    }
    setInterval(updateClock, 1000);
</script>
@endsection
