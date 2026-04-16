@php($title = 'QPhone')
@include('user.components.user_head')

<!-- Alpine.js for the template -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@include('user.components.top-navbar')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
  <div class="flex flex-col md:flex-row -mx-4">
    <div class="md:flex-1 px-4">
      <div x-data="{ image: 0, imgs: ['{{ asset('images/qphone.webp') }}','{{ asset('images/qphone2.webp') }}','{{ asset('images/qphone3.webp') }}','{{ asset('images/qphone4.webp') }}','{{ asset('images/qphone5.webp') }}','{{ asset('images/qphone6.webp') }}','{{ asset('images/qphone7.webp') }}','{{ asset('images/qphone8.webp') }}'] }" x-cloak>
        <div class="h-64 md:h-80 rounded-lg bg-white border mb-4 flex items-center justify-center">
          <img :src="imgs[image]" alt="QPhone" class="w-full h-full object-contain" />
        </div>
        <div class="flex -mx-2 mb-4">
          <template x-for="(src, idx) in imgs" :key="idx">
            <div class="w-1/4 px-2 mb-2">
              <button type="button" x-on:click="image = idx" :class="{ 'ring-2 ring-indigo-300 ring-inset': image === idx }" class="focus:outline-none w-full rounded-lg h-24 md:h-16 bg-white border flex items-center justify-center">
                <img :src="src" class="w-full h-1/2 object-contain" />
              </button>
            </div>
          </template>
        </div>
      </div>
    </div>
    <div class="md:flex-1 px-4 bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4">
      <h2 class="mb-2 leading-tight tracking-tight font-bold text-black text-2xl md:text-3xl">{{ $product['name'] }}</h2>

      @if(isset($latestOrder))
      <div class="mb-3">
        @php($status = $latestOrder->status)
        @php($bg = 'bg-slate-700')
        @php($text = 'text-slate-300')
        @php($label = ucfirst($status))
        @if($status === 'pending')
          @php($bg = 'bg-yellow-500/10')
          @php($text = 'text-yellow-400')
          @php($label = 'Pending review')
        @elseif($status === 'approved')
          @php($bg = 'bg-green-500/10')
          @php($text = 'text-green-400')
          @php($label = 'Approved')
        @elseif($status === 'rejected')
          @php($bg = 'bg-red-500/10')
          @php($text = 'text-red-400')
          @php($label = 'Rejected')
        @elseif($status === 'paid')
          @php($bg = 'bg-black/10')
          @php($text = 'text-blue-400')
          @php($label = 'Paid')
        @endif
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full {{ $bg }} {{ $text }} text-xs font-semibold">
          <i class="fa-regular fa-clock"></i>
          <span>Latest order: {{ $label }}</span>
        </div>
      </div>
      @endif


      <p class="text-gray-500">Secure your crypto with Ledger-grade hardware. Curved E Ink® touchscreen, clear-signing and private backup included.</p>
      <div class="flex items-center gap-2 text-slate-200 mt-3">
        <i class="fa-solid fa-shield-halved text-indigo-400"></i>
        <span class="font-medium">Magnet Shell protection included</span>
      </div>
      <div class="mt-4 space-y-3 text-sm">

        <div class="flex items-center gap-2 text-slate-200">
          <i class="fa-solid fa-truck-fast text-indigo-400"></i>
          <span class="font-medium">Free shipping</span>
        </div>
        <div class="flex items-center gap-2 text-slate-200">
          <i class="fa-regular fa-clock text-indigo-400"></i>
          <span class="font-medium">Usually ships within 24 hours</span>
        </div>
      </div>

      <div class="mt-5 space-y-3 text-slate-300 leading-relaxed text-sm">
        <p>
          Ledger Stax™ was made for the day-to-day use of your crypto & NFTs with clarity and comfort. Clear-sign your transactions with ease on the world's first curved E Ink® touchscreen. Name it, customize the lock screen with your favorite NFT or photo – make Ledger Stax™ yours. Entrust your peace of mind to Ledger’s uncompromising security.
        </p>
        <p>
          Now includes your own, private backup. Ledger Recovery Key, the Secure Element and PIN-protected smart card only you can use.
        </p>
      </div>

      <div class="flex py-4 items-end">
        @if(isset($latestOrder) && $latestOrder->status === 'pending')
          <button type="button" disabled class="flex items-center justify-center block w-full h-14 px-6 py-2 font-semibold rounded-xl bg-yellow-500/20 text-yellow-300 cursor-not-allowed">
            <i class="fa-regular fa-clock mr-2"></i> Pending review
          </button>
        @else
          <button id="buyNowBtn" type="button" class="flex items-center justify-center block w-full h-14 px-6 py-2 font-semibold rounded-xl bg-white hover:bg-indigo-500 text-black">
            Buy now
          </button>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Payment form (reused, with proof upload) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 bg-white text-black border border-gray-200 shadow-md rounded-xl border border-slate-700 p-6">
<form action="{{ route('user.qphone.store') }}" method="POST" enctype="multipart/form-data" id="payForm" class="hidden mt-2 mb-6 space-y-6">
  @csrf
  <input type="hidden" name="product_name" value="{{ $product['name'] }}">
  <input type="hidden" name="product_image" value="{{ $product['image'] }}">
  <input type="hidden" name="price" value="{{ $product['price'] }}">
  <input type="hidden" name="quantity" id="qtyInput" value="1">

  <div class="flex items-center justify-between">
    <div>
      <h3 class="text-black text-xl font-semibold">Payment</h3>
      <p class="text-slate-400 text-sm">Select coin, scan QR or copy address, upload proof and submit.</p>
    </div>
    <div class="hidden md:flex items-center gap-2 text-slate-400 text-xs">
      <i class="fa-solid fa-shield-halved"></i>
      <span>Secure checkout</span>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Left column: coin dropdown + address + proof -->
    <div class="space-y-5">
      <!-- Payment coin dropdown (active wallet types) -->
      <div>
        <label class="block text-sm font-semibold mb-2 text-slate-200">Payment coin</label>
        <div class="relative" id="payment-coin-dropdown">
          <input type="hidden" name="payment_coin" id="payment_coin_input" required>
          <button type="button" class="w-full bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 hover:border-slate-500 rounded-lg px-4 py-3 flex items-center justify-between transition-colors">
            <span class="flex items-center gap-3" id="payment_coin_selected_label">
              <span class="w-7 h-7 bg-slate-700 rounded"></span>
              <span class="text-slate-200">Select a payment coin</span>
            </span>
            <i class="fas fa-chevron-down text-slate-400"></i>
          </button>
          <div class="absolute z-50 mt-2 w-full bg-white text-black border border-gray-200 shadow-md rounded-xl border border-slate-600 rounded-lg shadow-xl max-h-64 overflow-auto hidden" id="payment_coin_menu">
            @foreach($activeWalletTypes as $walletType)
            <button type="button" class="w-full text-left px-4 py-2 hover:bg-slate-700 flex items-center gap-3 payment-coin-option-item" data-short="{{ $walletType->short_code }}" data-name="{{ $walletType->coin_name }}" data-logo="{{ $walletType->logo }}" data-qr="{{ $walletType->payment_qr_code }}" data-address="{{ $walletType->payment_wallet_address }}" data-instructions="{{ htmlspecialchars($walletType->payment_instructions ?? '', ENT_QUOTES) }}">
              @if($walletType->logo)
                <img src="/images/crypto_logo/{{ $walletType->logo }}" class="w-6 h-6 rounded" alt="{{ $walletType->coin_name }}">
              @else
                <span class="w-6 h-6 rounded bg-slate-700 inline-block"></span>
              @endif
              <span class="text-sm text-slate-100 font-medium">{{ $walletType->coin_name }} <span class="text-slate-400">({{ $walletType->short_code }})</span></span>
            </button>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Wallet address field with copy -->
      <div>
        <label class="block text-sm font-semibold mb-2 text-slate-200">Wallet address</label>
        <div class="relative">
          <input type="text" name="wallet_address" id="wallet_address" class="w-full bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 rounded-lg px-3 py-3 text-slate-100 pr-12" readonly>
          <button type="button" onclick="(function(){const el=document.getElementById('wallet_address');el.select();el.setSelectionRange(0,99999);document.execCommand('copy');const b=document.getElementById('copyBtn');b.classList.add('text-green-400');setTimeout(()=>b.classList.remove('text-green-400'),1200)})()" id="copyBtn" class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-300">
            <i class="fas fa-copy"></i>
          </button>
        </div>
        <p class="text-xs text-slate-400 mt-2">Send only the selected coin to this address. Other assets may be lost.</p>
      </div>

      <!-- Payment proof upload -->
      <div>
        <label class="block text-sm font-semibold mb-2 text-slate-200">Upload payment proof (screenshot or PDF)</label>
        <input type="file" name="payment_proof" accept="image/*,.pdf" class="w-full bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 rounded-lg px-3 py-3 text-slate-100">
      </div>

      <!-- Optional TX reference -->
      <div>
        <label class="block text-sm font-semibold mb-2 text-slate-200">Transaction reference (optional)</label>
        <input type="text" name="tx_reference" class="w-full bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 rounded-lg px-3 py-3 text-slate-100">
      </div>
    </div>

    <!-- Right column: QR + instructions card -->
    <div class="space-y-5">
      <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-2 text-slate-200">
            <i class="fa-solid fa-qrcode"></i>
            <h4 class="font-semibold">Scan to Pay</h4>
          </div>
          <span class="text-xs px-2 py-1 rounded bg-slate-700 text-slate-300">Auto-filled</span>
        </div>
        <div id="qrWrap" class="text-center hidden">
          <div class="inline-block rounded-xl overflow-hidden border border-slate-600 bg-white p-2">
            <img id="qrImg" src="" alt="QR code" class="w-48 h-48 object-contain">
          </div>
          <p class="text-slate-400 text-xs mt-3">Use your wallet app to scan this QR and send the exact amount.</p>
        </div>
        <div id="noQr" class="text-slate-400 text-sm">Select a payment coin to view QR code and address.</div>
      </div>

      <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl/80 border border-slate-600 rounded-xl p-6">
        <div class="flex items-center gap-2 text-slate-200 mb-2"><i class="fa-regular fa-circle-question"></i><h4 class="font-semibold">Tips</h4></div>
        <ul class="list-disc list-inside text-slate-300 text-sm space-y-1">
          <li>Confirm network and coin before sending.</li>
          <li>Upload clear screenshot or PDF as payment proof.</li>
          <li>Keep your transaction reference for faster approval.</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="flex items-center justify-end">
    <button type="submit" class="px-6 py-3 rounded-lg bg-[#F5A623] text-black font-bold hover:bg-indigo-500 text-black font-semibold transition-colors">Submit payment</button>
  </div>
</form>
</div>

<script>
  const buyBtn = document.getElementById('buyNowBtn');
  if (buyBtn) {
    buyBtn.addEventListener('click', function(){
      document.getElementById('payForm').classList.remove('hidden');
      window.scrollTo({ top: document.getElementById('payForm').offsetTop - 80, behavior: 'smooth' });
    });
  }

  function setupDropdown(rootId, inputId, labelId, menuId, itemClass) {
    const root = document.getElementById(rootId);
    const input = document.getElementById(inputId);
    const label = document.getElementById(labelId);
    const menu = document.getElementById(menuId);
    const btn = root.querySelector('button');
    const items = root.querySelectorAll('.' + itemClass);
    function closeMenu(){ menu.classList.add('hidden') }
    btn.addEventListener('click', (e)=>{ e.stopPropagation(); menu.classList.toggle('hidden') });
    document.addEventListener('click', closeMenu);
    items.forEach(it=>{
      it.addEventListener('click', ()=>{
        const short = it.getAttribute('data-short');
        const name = it.getAttribute('data-name');
        const logo = it.getAttribute('data-logo');
        const address = it.getAttribute('data-address');
        const qr = it.getAttribute('data-qr');
        input.value = short;
        label.innerHTML = `${logo ? `<img src="/images/crypto_logo/${logo}" class='w-6 h-6 rounded'>` : `<span class='w-6 h-6 rounded bg-gray-200 inline-block'></span>`} <span>${name} <span class='text-gray-400'>(${short})</span></span>`;
        document.getElementById('wallet_address').value = address || '';
        if (qr) { document.getElementById('qrImg').src = `/images/crypto_logo/${qr}`; document.getElementById('qrWrap').classList.remove('hidden'); }
        else { document.getElementById('qrWrap').classList.add('hidden'); }
        closeMenu();
      })
    })
  }
  setupDropdown('payment-coin-dropdown','payment_coin_input','payment_coin_selected_label','payment_coin_menu','payment-coin-option-item');
</script>

@include('user.components.user')
</body>
</html>
