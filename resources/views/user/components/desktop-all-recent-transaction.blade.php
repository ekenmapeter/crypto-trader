<section class="hidden md:block bg-gradient-to-b from-gray-900 to-gray-800 border border-gray-700 rounded-2xl p-4 sm:p-6 shadow-2xl">
<style>[x-cloak]{ display:none !important; }</style>

<div class="relative sm:rounded-2xl">
   <div class="flex items-center justify-between px-4 sm:px-6 py-4 font-semibold text-white border-b border-gray-700">
        <span>Recent Transactions</span>
   </div>
    <table class="w-full text-sm text-left text-gray-300 mb-4">


        <tbody>
             <thead class="text-xs text-gray-300 uppercase bg-gray-800">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Transaction
                </th>
                <th scope="col" class="py-3 px-6">
                    Date
                </th>
                <th scope="col" class="py-3 px-6">
                    Amt / Rate
                </th>
                <th scope="col" class="py-3 px-6">
                    Total
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
            </tr>
        </thead>
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
                $statusText = $data->status_text ?? ([$data->status === 1 ? 'Completed' : ($data->status === 2 ? 'Cancelled' : 'Pending')]);
                $status = strtolower(is_array($statusText)?($statusText[0]??'pending'):$statusText);
                $txPayload = [
                    'id' => $data->id,
                    'description' => $desc,
                    'type' => $data->transaction_type,
                    'amount' => number_format($amount, 2) . ' ' . $currency,
                    'currency' => $currency,
                    'rate' => $rate,
                    'status' => $status,
                    'when' => \Carbon\Carbon::parse($data->created_at)->format('Y-m-d g:i A'),
                    'metadata' => $meta,
                ];
            @endphp
            <tr class="border-b border-gray-700 hover:bg-gray-800/60 cursor-pointer js-open-tx" data-tx='@json($txPayload)'>

                <th scope="row" class="flex items-center py-4 px-6 text-white whitespace-nowrap">
                    @if($logo)
                        <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/{{ $logo }}" alt="logo">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gray-700/50 flex items-center justify-center text-blue-400 border border-gray-600">
                            @if(($data->transaction_type ?? '') === 'deposit')
                                <i class="fa-solid fa-arrow-down text-sm"></i>
                            @elseif(($data->transaction_type ?? '') === 'withdrawal')
                                <i class="fa-solid fa-arrow-up text-sm"></i>
                            @elseif(($data->transaction_type ?? '') === 'exchange')
                                <i class="fa-solid fa-rotate text-sm"></i>
                            @else
                                <i class="fa-solid fa-money-bill-transfer text-xs"></i>
                            @endif
                        </div>
                    @endif
                    <div class="pl-3">
                        <div class="text-xs font-semibold text-white">{{ $desc }}</div>
                        <div class="font-normal text-gray-400">{{ strtoupper($data->transaction_type ?? '') }} {{ $coinCode ? '• '.$coinCode : '' }}</div>
                    </div>
                </th>
                <td class="py-4 px-6">
                    <div class="text-xs font-semibold text-white">{{ \Carbon\Carbon::parse($data->created_at)->format('jS F Y') }}</div>
                    <div class="font-normal text-gray-300">{{ \Carbon\Carbon::parse($data->created_at)->format('g:i A') }}</div>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center text-center justify-center">
                        <span class="font-semibold text-white pr-2">{{ number_format($amount, 2) }} {{ $currency }}</span>
                        @if(!empty($rate))
                            |  <span class="text-blue-400 font-black pl-2">{{ $rate }}</span>
                        @endif
                    </div>
                </td>
                <td class="py-4 px-6">
                    <span class="inline-block font-medium text-blue-400">{{ number_format($amount, 2) }} {{ $currency }}</span>
                </td>
                <td class="py-4 px-6">
                    @if($status === 'completed' || $data->status === 1)
                        <div class="text-center bg-green-900/30 text-green-300 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-green-700">Completed</div>
                    @elseif($status === 'cancelled' || $status === 'rejected' || $data->status === 2)
                        <div class="text-center bg-red-900/30 text-red-300 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-red-700">Cancelled</div>
                    @elseif($status === 'failed')
                        <div class="text-center bg-red-900/30 text-red-300 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-red-700">Failed</div>
                    @else
                        <div class="text-center bg-yellow-900/30 text-yellow-300 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-yellow-700">Pending</div>
                    @endif
                </td>
            </tr>


                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">No Transaction Available</td>
                    </tr>
           @endforelse
        </tbody>
    </table>
    <div class="px-4 sm:px-6 pb-4 text-gray-300">
        {{ $transactionsTable->links() }}
    </div>
</div>

<!-- Modal (vanilla JS) -->
<div id="txModal" class="fixed inset-0 z-[70] items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-black/70" id="txModalBackdrop"></div>
    <div class="relative w-full max-w-lg bg-gray-900 border border-gray-700 rounded-xl shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-700">
            <h3 class="text-white font-semibold text-sm">Transaction Details</h3>
            <button class="text-gray-400 hover:text-gray-200" id="txModalClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 text-sm text-gray-300">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <div class="text-gray-400 text-xs">Description</div>
                    <div class="text-white" id="txDesc"></div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs">Type</div>
                    <div class="text-white uppercase" id="txType"></div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs">Amount</div>
                    <div class="text-white" id="txAmount"></div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs">Currency</div>
                    <div class="text-white" id="txCurrency"></div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs">Rate</div>
                    <div class="text-white" id="txRate"></div>
                </div>
                <div>
                    <div class="text-gray-400 text-xs">Status</div>
                    <div class="text-white capitalize" id="txStatus"></div>
                </div>
                <div class="sm:col-span-2">
                    <div class="text-gray-400 text-xs">When</div>
                    <div class="text-white" id="txWhen"></div>
                </div>
                <div class="sm:col-span-2 hidden" id="txMetaWrap">
                    <div class="text-gray-400 text-xs">Metadata</div>
                    <pre class="text-gray-200 bg-gray-800/70 border border-gray-700 rounded p-2 overflow-x-auto" id="txMeta"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
  if (window.__txModalBound) return; // avoid double-binding
  window.__txModalBound = true;
  const modal = document.getElementById('txModal');
  if (!modal) return;
  const closeBtn = document.getElementById('txModalClose');
  const backdrop = document.getElementById('txModalBackdrop');
  const setText = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v ?? '-'; };
  const setMeta = (meta) => {
    const wrap = document.getElementById('txMetaWrap');
    const pre = document.getElementById('txMeta');
    if (!wrap || !pre) return;
    if (meta && Object.keys(meta).length){ wrap.classList.remove('hidden'); pre.textContent = JSON.stringify(meta, null, 2); }
    else { wrap.classList.add('hidden'); pre.textContent = ''; }
  };
  const openModal = (tx) => {
    setText('txDesc', tx.description);
    setText('txType', (tx.type||'').toUpperCase());
    setText('txAmount', tx.amount);
    setText('txCurrency', tx.currency);
    setText('txRate', tx.rate ?? '-');
    setText('txStatus', tx.status);
    setText('txWhen', tx.when);
    setMeta(tx.metadata||{});
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };
  const closeModal = () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  };
  document.addEventListener('click', function(e){
    const row = e.target.closest('.js-open-tx');
    if (row && row.dataset && row.dataset.tx){
      try { const tx = JSON.parse(row.dataset.tx); openModal(tx); } catch(_){}
    }
  });
  closeBtn && closeBtn.addEventListener('click', closeModal);
  backdrop && backdrop.addEventListener('click', closeModal);
})();
</script>
</section>

