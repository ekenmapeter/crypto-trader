  <!-- Mobile List Card -->
  <section class="md:hidden block  bg-white text-black rounded-2xl p-4 sm:p-6 shadow-2xl">
<style>[x-cloak]{ display:none !important; }</style>
<div class="sm:rounded-2xl">
    <div class="flex items-center justify-between px-4 py-4 font-semibold text-black">
        <span>Recent Transactions</span>
    </div>
<div class="w-full p-4 bg-white border rounded-2xl shadow-md sm:p-6 mb-4">

   <div class="flow-root">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
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
                $statusText = strtolower($data->status_text ?? ($data->status === 1 ? 'completed' : ($data->status === 2 ? 'cancelled' : 'pending')));
                $txPayload = [
                    'id' => $data->id,
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
            <li class="py-3 sm:py-4 cursor-pointer js-open-tx-m" data-tx='@json($txPayload)'>
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        @if($logo)
                            <img class="w-8 h-8 rounded-full" src="/images/crypto_logo/{{ $logo }}" alt="logo">
                        @else
                            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100">
                                @if(($data->transaction_type ?? '') === 'deposit')
                                    <i class="fa-solid fa-arrow-down text-[10px]"></i>
                                @elseif(($data->transaction_type ?? '') === 'withdrawal')
                                    <i class="fa-solid fa-arrow-up text-[10px]"></i>
                                @elseif(($data->transaction_type ?? '') === 'exchange')
                                    <i class="fa-solid fa-rotate text-[10px]"></i>
                                @else
                                    <i class="fa-solid fa-money-bill-transfer text-[10px]"></i>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ Str::limit($desc ,20) }}
                        </p>
                        <p class="badge text-sm text-gray-500 truncate">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-y') }} <span class="font-semibold text-black">{{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}</span>
                        </p>
                        <p class="text-xs text-gray-600 truncate">
                            {{ number_format($amount, 2) }} {{ $currency }} @if(!empty($rate)) • Rate: {{ $rate }} @endif
                        </p>
                    </div>
                    @if ($statusText === 'completed')
                    <div class="inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                        {{ number_format($amount, 2) }} {{ $currency }}
                    </div>
                    @elseif ($statusText === 'cancelled' || $statusText === 'rejected' || $statusText === 'failed')
                    <div class="inline-flex items-center bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                        {{ number_format($amount, 2) }} {{ $currency }}
                    </div>
                    @else
                    <div class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                        {{ number_format($amount, 2) }} {{ $currency }}
                    </div>
                    @endif


                </div>
            </li>
             @empty
             <div class="text-center text-gray-500">
                <h3 class="font-semibold">No Transaction Available</h3>
            </div>
           @endforelse
        </ul>
   </div>
</div>

    <div class="px-4 pb-4">
        {{ $transactionsTable->links() }}
    </div>
</div>

<!-- Modal (vanilla JS) -->
<div id="txModalM" class="fixed inset-0 z-[70] items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-black/70" id="txModalBackdropM"></div>
    <div class="relative w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b">
            <h3 class="text-gray-900 font-semibold text-sm">Transaction Details</h3>
            <button class="text-gray-500 hover:text-gray-700" id="txModalCloseM">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 text-sm text-gray-700">
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <div class="text-gray-500 text-xs">Description</div>
                    <div class="text-gray-900" id="txDescM"></div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <div class="text-gray-500 text-xs">Type</div>
                        <div class="text-gray-900 uppercase" id="txTypeM"></div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-xs">Status</div>
                        <div class="text-gray-900 capitalize" id="txStatusM"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <div class="text-gray-500 text-xs">Amount</div>
                        <div class="text-gray-900" id="txAmountM"></div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-xs">Currency</div>
                        <div class="text-gray-900" id="txCurrencyM"></div>
                    </div>
                </div>
                <div>
                    <div class="text-gray-500 text-xs">Rate</div>
                    <div class="text-gray-900" id="txRateM"></div>
                </div>
                <div>
                    <div class="text-gray-500 text-xs">When</div>
                    <div class="text-gray-900" id="txWhenM"></div>
                </div>
                <div class="hidden" id="txMetaWrapM">
                    <div class="text-gray-500 text-xs">Metadata</div>
                    <pre class="text-gray-800 bg-gray-100 rounded p-2 overflow-x-auto" id="txMetaM"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
  if (window.__txModalBoundM) return; // avoid double-binding
  window.__txModalBoundM = true;
  const modal = document.getElementById('txModalM');
  if (!modal) return;
  const closeBtn = document.getElementById('txModalCloseM');
  const backdrop = document.getElementById('txModalBackdropM');
  const setText = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v ?? '-'; };
  const setMeta = (meta) => {
    const wrap = document.getElementById('txMetaWrapM');
    const pre = document.getElementById('txMetaM');
    if (!wrap || !pre) return;
    if (meta && Object.keys(meta).length){ wrap.classList.remove('hidden'); pre.textContent = JSON.stringify(meta, null, 2); }
    else { wrap.classList.add('hidden'); pre.textContent = ''; }
  };
  const openModal = (tx) => {
    setText('txDescM', tx.description);
    setText('txTypeM', (tx.type||'').toUpperCase());
    setText('txAmountM', tx.amount);
    setText('txCurrencyM', tx.currency);
    setText('txRateM', tx.rate ?? '-');
    setText('txStatusM', tx.status);
    setText('txWhenM', tx.when);
    setMeta(tx.metadata||{});
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };
  const closeModal = () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  };
  document.addEventListener('click', function(e){
    const row = e.target.closest('.js-open-tx-m');
    if (row && row.dataset && row.dataset.tx){
      try { const tx = JSON.parse(row.dataset.tx); openModal(tx); } catch(_){}
    }
  });
  closeBtn && closeBtn.addEventListener('click', closeModal);
  backdrop && backdrop.addEventListener('click', closeModal);
})();
</script>
</section>





