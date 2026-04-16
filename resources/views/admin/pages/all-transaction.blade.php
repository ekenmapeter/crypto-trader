@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Transaction Ledger</h1>
            <p class="text-sm text-gray-500 font-medium">Monitoring all platform financial movements.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 text-white px-6 py-2.5 rounded-2xl shadow-lg shadow-blue-200 flex items-center gap-2">
                <i class="fa-solid fa-receipt text-xs opacity-70"></i>
                <span class="text-sm font-black">{{ number_format($totalTransactions) }} Total</span>
            </div>
        </div>
    </div>

    {{-- Filters & Search --}}
    <div class="bg-white p-4 rounded-[24px] shadow-sm border border-gray-100 flex flex-wrap items-center gap-4">
        <div class="relative flex-1 min-w-[300px]">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search by ID, Username, or Email..." 
                class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 transition-all font-medium">
        </div>
        <div class="flex items-center gap-2">
            <button class="px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-xl text-gray-600 text-sm font-bold transition-all flex items-center gap-2 border border-gray-100">
                <i class="fa-solid fa-filter text-xs"></i>
                <span>Status</span>
            </button>
            <button class="px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-xl text-gray-600 text-sm font-bold transition-all flex items-center gap-2 border border-gray-100">
                <i class="fa-solid fa-calendar text-xs"></i>
                <span>Date Range</span>
            </button>
        </div>
    </div>

    {{-- Transactions Table Card --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID / User</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Description</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactionsTable as $data)
                    @php
                        $meta = is_array($data->metadata ?? null) ? $data->metadata : (json_decode($data->metadata ?? '[]', true) ?: []);
                        $logo = $meta['logo'] ?? null;
                        $coinName = $meta['coin_name'] ?? null;
                        $coinCode = $meta['coin_code'] ?? null;
                        $desc = $data->description ?? ($coinName ? ('Buy ' . $coinName) : ucfirst(str_replace('_',' ', $data->transaction_type ?? 'transaction')));
                        $currency = $data->currency ?? ($coinCode ?? 'USD');
                        $rate = $data->exchange_rate ?? ($meta['rate'] ?? null);
                        $amount = $data->amount ?? 0;
                        $statusText = strtolower($data->status_text ?? ($data->status === 1 ? 'completed' : ($data->status === 2 ? 'failed' : 'pending')));
                        
                        $txPayload = [
                            'id' => $data->id,
                            'username' => $data->username,
                            'description' => $desc,
                            'type' => $data->transaction_type,
                            'amount' => number_format($amount, 2) . ' ' . $currency,
                            'currency' => $currency,
                            'rate' => $rate,
                            'status' => $statusText,
                            'when' => \Carbon\Carbon::parse($data->created_at)->format('Y-m-d g:i A'),
                            'metadata' => $meta,
                        ];
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition-colors group js-admin-open-tx cursor-pointer" data-tx='@json($txPayload)'>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                                    @if($logo)
                                        <img class="w-10 h-10 rounded-xl object-contain p-1" src="/images/crypto_logo/{{ $logo }}" />
                                    @else
                                        <i class="fa-solid fa-receipt text-sm"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 leading-none">#{{ $data->id }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $data->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-[200px]">
                                <p class="text-sm font-bold text-gray-700 truncate">{{ $desc }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $data->transaction_type }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($statusText === 'completed' || $statusText === 'success')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest inline-block">Successful</span>
                            @elseif ($statusText === 'cancelled' || $statusText === 'rejected' || $statusText === 'failed')
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest inline-block">Failed</span>
                            @else
                                <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-[10px] font-black uppercase tracking-widest inline-block animate-pulse">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-black text-gray-900">${{ number_format($amount, 2) }} <span class="text-[10px] text-gray-400 font-medium">USD</span></p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-bold">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('j M, Y') }}
                            <span class="block text-[10px] text-gray-300">{{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-300 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-money-bill-transfer text-gray-200 text-3xl"></i>
                                </div>
                                <h3 class="text-gray-900 font-black text-lg">No Transactions Found</h3>
                                <p class="text-gray-400 text-sm max-w-xs mx-auto">We couldn't find any financial activities in your ledger yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="px-6 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $transactionsTable->links() }}
        </div>
    </div>

</div>

{{-- Admin TX Details Modal --}}
<div id="adminTxModal" class="fixed inset-0 z-[100] items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" id="adminTxBackdrop"></div>
    <div class="relative w-full max-w-lg bg-white rounded-[32px] shadow-2xl overflow-hidden border border-gray-100">
        <div class="flex items-center justify-between px-8 py-6 border-b border-gray-50">
            <h3 class="text-gray-900 font-black text-lg">Transaction Receipt</h3>
            <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-red-500 transition-colors" id="adminTxClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="px-8 py-8 space-y-6 overflow-y-auto max-h-[70vh]">
            <div class="flex flex-col items-center justify-center pb-6 border-b border-dashed border-gray-200">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <h4 class="text-2xl font-black text-gray-900" id="mTxAmount">-</h4>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mt-1" id="mTxType">-</p>
            </div>

            <div class="grid grid-cols-2 gap-y-6">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">REFERENCE ID</p>
                    <p class="text-sm font-bold text-gray-900" id="mTxId">-</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">USER ACCOUNT</p>
                    <p class="text-sm font-bold text-gray-900" id="mTxUser">-</p>
                </div>
                <div class="col-span-2">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">DESCRIPTION</p>
                    <p class="text-sm font-medium text-gray-700 italic bg-gray-50 p-3 rounded-xl" id="mTxDesc">-</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">DATE & TIME</p>
                    <p class="text-sm font-bold text-gray-900" id="mTxDate">-</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">FINAL STATUS</p>
                    <div id="mTxStatus"></div>
                </div>
            </div>

            <div id="mTxMetaWrap" class="hidden pt-4">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">EXTENDED METADATA</p>
                <pre class="bg-gray-900 text-blue-400 p-4 rounded-xl text-[10px] overflow-x-auto font-mono" id="mTxMeta"></pre>
            </div>
        </div>

        <div class="p-6 bg-gray-50/50 flex gap-3">
            <button onclick="window.print()" class="flex-1 bg-white border border-gray-200 text-gray-600 py-3 rounded-xl font-bold text-sm hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-print text-xs"></i>
                Print
            </button>
            <button id="mTxCloseBtn" class="flex-1 bg-gray-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-black transition-all">Dismiss View</button>
        </div>
    </div>
</div>

<script>
(function(){
    const modal = document.getElementById('adminTxModal');
    const closeBtn = document.getElementById('adminTxClose');
    const closeBtn2 = document.getElementById('mTxCloseBtn');
    const backdrop = document.getElementById('adminTxBackdrop');
    
    const openModal = (tx) => {
        document.getElementById('mTxId').innerText = '#' + tx.id;
        document.getElementById('mTxUser').innerText = tx.username;
        document.getElementById('mTxAmount').innerText = tx.amount;
        document.getElementById('mTxType').innerText = tx.type;
        document.getElementById('mTxDesc').innerText = tx.description;
        document.getElementById('mTxDate').innerText = tx.when;
        
        // Status badge
        const statusCont = document.getElementById('mTxStatus');
        const s = tx.status.toLowerCase();
        let color = 'bg-orange-100 text-orange-600';
        if(s === 'completed' || s === 'success') color = 'bg-emerald-100 text-emerald-600';
        if(s === 'failed' || s === 'rejected') color = 'bg-red-100 text-red-600';
        statusCont.innerHTML = `<span class="px-3 py-1 ${color} rounded-full text-[10px] font-black uppercase tracking-widest">${tx.status}</span>`;

        // Meta
        const metaWrap = document.getElementById('mTxMetaWrap');
        if(tx.metadata && Object.keys(tx.metadata).length > 0) {
            metaWrap.classList.remove('hidden');
            document.getElementById('mTxMeta').innerText = JSON.stringify(tx.metadata, null, 2);
        } else {
            metaWrap.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('.js-admin-open-tx').forEach(row => {
        row.addEventListener('click', () => {
            const tx = JSON.parse(row.getAttribute('data-tx'));
            openModal(tx);
        });
    });

    [closeBtn, closeBtn2, backdrop].forEach(el => el && el.addEventListener('click', closeModal));
})();
</script>
@endsection
