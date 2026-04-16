@include('user.components.user_head', ['title' => 'Transaction Archive'])

@include('user.components.top-navbar')

<div class="min-h-screen bg-gray-50 pb-24">
    
    {{-- Page Header --}}
    <header class="max-w-7xl mx-auto px-6 py-12 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-[22px] text-white shadow-xl shadow-blue-200 mb-6">
            <i class="fa-solid fa-list-check text-2xl"></i>
        </div>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight uppercase">Activity Ledger</h1>
        <p class="text-xs font-black text-blue-600 uppercase tracking-widest mt-2">Comprehensive Transaction History</p>
    </header>

    {{-- Stats Row (Pulse of the account) --}}
    <div class="max-w-7xl mx-auto px-6 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-[28px] border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Logs</p>
                <p class="text-2xl font-black text-gray-900">{{ $totalTransactions }}</p>
            </div>
            <div class="bg-white p-6 rounded-[28px] border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Last Activity</p>
                <p class="text-2xl font-black text-gray-900">{{ $transactionsTable->first() ? \Carbon\Carbon::parse($transactionsTable->first()->created_at)->diffForHumans(null, true) : 'N/A' }}</p>
            </div>
            <div class="bg-white p-6 rounded-[28px] border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Account Class</p>
                <p class="text-2xl font-black text-blue-600">Standard</p>
            </div>
            <div class="bg-white p-6 rounded-[28px] border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Ref ID</p>
                <p class="text-2xl font-black text-gray-900">#{{ substr(Auth::id(), 0, 4) }}</p>
            </div>
        </div>
    </div>

    {{-- Transaction Table/List --}}
    <main class="max-w-7xl mx-auto px-6">
        <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-500/5 border border-gray-100 overflow-hidden">
            
            <div class="hidden md:block">
                {{-- Desktop Table --}}
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Type / Asset</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Timeline</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Amount</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Settlement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($transactionsTable as $tx)
                            @php
                                $isSuccess = $tx->status == 1;
                                $isPending = $tx->status == 0;
                                $isFailed = $tx->status == 2;
                            @endphp
                            <tr class="group hover:bg-gray-50/80 transition-all cursor-pointer">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-lg {{ $isSuccess ? 'bg-emerald-50 text-emerald-600' : ($isFailed ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }} transition-transform group-hover:scale-110">
                                            @if($tx->transaction_type == 'deposit') <i class="fa-solid fa-arrow-down-long"></i>
                                            @elseif($tx->transaction_type == 'withdrawal') <i class="fa-solid fa-arrow-up-long"></i>
                                            @elseif($tx->transaction_type == 'exchange') <i class="fa-solid fa-rotate"></i>
                                            @else <i class="fa-solid fa-receipt"></i> @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-gray-900 uppercase tracking-tighter">{{ $tx->transaction_type }}</p>
                                            <p class="text-[9px] font-black text-blue-500 uppercase tracking-widest opacity-60">TXID: #{{ $tx->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-black text-gray-900">{{ \Carbon\Carbon::parse($tx->created_at)->format('M d, Y') }}</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($tx->created_at)->format('H:i A') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-gray-900">${{ number_format($tx->amount, 2) }}</p>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">USD Equivalent</p>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full {{ $isSuccess ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : ($isFailed ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-orange-50 text-orange-600 border border-orange-100 animate-pulse') }}">
                                        {{ $isSuccess ? 'Completed' : ($isFailed ? 'Declined' : 'In Progress') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-24 text-center">
                                    <i class="fa-solid fa-receipt text-gray-100 text-6xl mb-4"></i>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">No transaction data found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile List (Stacked for better UX) --}}
            <div class="md:hidden divide-y divide-gray-50">
                @foreach($transactionsTable as $tx)
                    @php
                        $isSuccess = $tx->status == 1;
                        $isPending = $tx->status == 0;
                        $isFailed = $tx->status == 2;
                    @endphp
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-sm {{ $isSuccess ? 'bg-emerald-50 text-emerald-600' : ($isFailed ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }}">
                                    @if($tx->transaction_type == 'deposit') <i class="fa-solid fa-arrow-down-long"></i>
                                    @elseif($tx->transaction_type == 'withdrawal') <i class="fa-solid fa-arrow-up-long"></i>
                                    @elseif($tx->transaction_type == 'exchange') <i class="fa-solid fa-rotate"></i>
                                    @else <i class="fa-solid fa-receipt"></i> @endif
                                </div>
                                <div>
                                    <p class="text-xs font-black text-gray-900 uppercase tracking-tighter">{{ $tx->transaction_type }}</p>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($tx->created_at)->format('M d, H:i') }}</p>
                                </div>
                            </div>
                            <p class="text-xs font-black text-gray-900">${{ number_format($tx->amount, 2) }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[8px] font-black text-blue-500 uppercase tracking-[0.2em] opacity-40">TX #{{ $tx->id }}</span>
                            <span class="text-[8px] font-black uppercase tracking-widest px-2 py-1 rounded-md {{ $isSuccess ? 'bg-emerald-50 text-emerald-500' : ($isFailed ? 'bg-red-50 text-red-500' : 'bg-orange-50 text-orange-500') }}">
                                {{ $isSuccess ? 'Completed' : ($isFailed ? 'Declined' : 'Pending') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Pagination --}}
        <div class="mt-10 px-4">
            {{ $transactionsTable->links() }}
        </div>
    </main>
</div>

@include('user.components.user')
