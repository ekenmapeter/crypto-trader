@php($title = 'Card Request')
@include('user.components.user_head')

<style>
  .card-option.selected {
    border-color: #3b82f6 !important;
    background-color: rgba(59, 130, 246, 0.1) !important;
    transform: scale(1.02);
  }

  .card-option:hover {
    border-color: #3b82f6 !important;
    transform: scale(1.05);
  }

  .card-option.selected:hover {
    transform: scale(1.02);
  }
</style>

  <!-- Header -->
  @include('user.components.top-navbar')

  <div class="max-w-4xl mx-auto px-4 mt-6">
    <!-- Virtual Card Display -->
    <div class="mb-8">
      <div class="relative max-w-md mx-auto">
        <!-- Card Background -->
        <div class="card-preview rounded-[32px] p-8 text-white shadow-2xl bg-gradient-to-br from-gray-900 via-gray-800 to-black relative overflow-hidden border border-white/10 group">
          <div class="absolute top-0 right-0 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl -mr-24 -mt-24 group-hover:bg-blue-500/20 transition-all"></div>
          
          <!-- Card Header -->
          <div class="flex justify-between items-start mb-12 relative">
            <div class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60">Global Asset Card</div>
            <div class="text-lg font-black tracking-tighter">{{ strtoupper($setting->site_name ?? 'NANOXLEDGER') }}</div>
          </div>

          <!-- Card Number -->
          <div class="mb-8 relative">
            <div class="text-[10px] font-black uppercase tracking-[0.2em] opacity-40 mb-3 text-white">Encrypted Card Number</div>
            <div class="text-2xl font-mono tracking-[0.3em] flex gap-2">
                <span>8050</span>
                <span>••••</span>
                <span>••••</span>
                <span>3020</span>
            </div>
          </div>

          <!-- Card Footer -->
          <div class="flex justify-between items-end relative">
            <div>
              <div class="text-[10px] font-black uppercase tracking-[0.2em] opacity-40 mb-1 text-white">Valid Thru</div>
              <div class="text-lg font-mono tracking-widest text-white/90">05/28</div>
            </div>
            <div class="flex flex-col items-end">
                <i class="fa-brands fa-cc-visa text-4xl opacity-80 mb-1"></i>
                <div class="text-[8px] font-black uppercase tracking-widest opacity-40 uppercase">International Debit</div>
            </div>
          </div>
        </div>

        <!-- Card Overlay -->
        <div class="absolute inset-0 bg-[#F5A623] text-black font-bold bg-opacity-20 rounded-2xl pointer-events-none"></div>
      </div>
    </div>

    <!-- Request Form -->
    <div class="section-card rounded-2xl shadow-xl p-8">
      <form action="{{ route('user.card-request.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Shipping Details Section -->
        <div class="mb-8 bg-white dark:bg-slate-800 text-black dark:text-white border border-gray-200 dark:border-slate-700 shadow-md rounded-2xl p-8 transition-colors">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Shipping Details</h2>

          <!-- Cardholder Name -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Cardholder Name</label>
            <div class="relative">
              <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input type="text" name="cardholder_name" value="{{ $user->firstname }} {{ $user->lastname }}"
                     class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 font-bold form-input w-full pl-12 pr-4 py-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
            </div>
          </div>

          <!-- Select Card Type with Pricing -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Select Card Type</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <!-- Visa Card Option -->
              <div class="card-option border-2 border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/30 rounded-2xl p-6 cursor-pointer hover:border-blue-500 transition-all duration-300" data-card-type="Visa Card" data-price="50">
                <div class="text-center">
                  <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-credit-card text-blue-600 text-xl"></i>
                  </div>
                  <h3 class="text-gray-900 dark:text-white font-black text-sm mb-1">Visa Card</h3>
                  <div class="text-2xl font-black text-blue-600 mb-1">$50</div>
                  <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Standard</div>
                </div>
              </div>

              <!-- Master Card Option -->
              <div class="card-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-all duration-200 hover:scale-105" data-card-type="Master Card" data-price="75">
                <div class="text-center">
                  <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-credit-card text-black text-xl"></i>
                  </div>
                  <h3 class="text-black font-semibold mb-2">Master Card</h3>
                  <div class="text-2xl font-bold text-red-400 mb-1">$75</div>
                  <div class="text-sm text-gray-400">Enhanced Master</div>
                  <div class="text-xs text-gray-500 mt-2">Premium features included</div>
                </div>
              </div>

              <!-- Premium Card Option -->
              <div class="card-option border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition-all duration-200 hover:scale-105" data-card-type="Premium card" data-price="150">
                <div class="text-center">
                  <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-crown text-black text-xl"></i>
                  </div>
                  <h3 class="text-black font-semibold mb-2">Premium Card</h3>
                  <div class="text-2xl font-bold text-purple-400 mb-1">$150</div>
                  <div class="text-sm text-gray-400">Ultimate Premium</div>
                  <div class="text-xs text-gray-500 mt-2">All premium features</div>
                </div>
              </div>
            </div>
            <input type="hidden" name="card_type" id="card_type_input" required>
            <input type="hidden" name="card_price" id="card_price_input" required>
            <div class="mt-3 text-sm text-gray-400">
              <i class="fas fa-info-circle mr-1"></i>
              Click on a card type above to see pricing and payment details
            </div>
          </div>

          <!-- Payment Coin (Dropdown) -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">Payment Coin</label>
            <div class="relative" id="payment-coin-dropdown">
              <input type="hidden" name="payment_coin" id="payment_coin_input" required>
              <button type="button" class="w-full bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 py-4 px-4 rounded-xl flex items-center justify-between focus:ring-2 focus:ring-blue-500 transition-all">
                <span class="flex items-center gap-3" id="payment_coin_selected_label">
                  <span class="w-6 h-6 bg-gray-200 dark:bg-slate-700 rounded-lg"></span>
                  <span class="text-gray-500 font-bold">Select a payment coin</span>
                </span>
                <i class="fas fa-chevron-down text-gray-400"></i>
              </button>
              <div class="absolute z-50 mt-2 w-full bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-lg shadow-xl max-h-64 overflow-auto hidden" id="payment_coin_menu">
                @foreach($activeWalletTypes as $walletType)
                <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-800 flex items-center gap-3 payment-coin-option-item" data-short="{{ $walletType->short_code }}" data-name="{{ $walletType->coin_name }}" data-logo="{{ $walletType->logo }}" data-qr="{{ $walletType->payment_qr_code }}" data-address="{{ $walletType->payment_wallet_address }}" data-instructions="{{ htmlspecialchars($walletType->payment_instructions ?? '', ENT_QUOTES) }}">
                  @if($walletType->logo)
                    <img src="/images/crypto_logo/{{ $walletType->logo }}" class="w-6 h-6 rounded" alt="{{ $walletType->coin_name }}">
                  @else
                    <span class="w-6 h-6 rounded bg-gray-700 inline-block"></span>
                  @endif
                  <span class="text-black text-sm">{{ $walletType->coin_name }} <span class="text-gray-400">({{ $walletType->short_code }})</span></span>
                </button>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Email</label>
            <div class="relative">
              <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input type="email" name="email" value="{{ $user->email }}"
                     class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 font-bold form-input w-full pl-12 pr-4 py-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
            </div>
          </div>

          <!-- Phone Number -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
            <div class="relative">
              <i class="fas fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input type="tel" name="phone_number" value="{{ $user->mobile_number }}"
                     class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 font-bold form-input w-full pl-12 pr-4 py-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required>
            </div>
          </div>

          <!-- Address -->
          <div class="mb-6">
            <label class="block text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">Address</label>
            <div class="relative">
              <i class="fas fa-map-marker-alt absolute left-4 top-5 transform text-gray-400"></i>
              <textarea name="address" placeholder="Detail your full delivery address" rows="3"
                        class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-900/50 border border-gray-200 dark:border-slate-700 font-bold form-input w-full pl-12 pr-4 py-4 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" required></textarea>
            </div>
          </div>

          <!-- Upload Proof of Address -->
          <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-300 mb-3">UPLOAD PROOF OF ADDRESS</label>
            <div class="upload-area rounded-lg p-8 text-center hover:border-blue-500 transition-colors">
              <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
              <div class="text-gray-300 mb-2">Drag and drop a file here or click</div>
              <div class="text-sm text-gray-500 mb-4">No file chosen</div>
              <input type="file" name="proof_of_address" accept=".pdf,.jpg,.jpeg,.png"
                     class="hidden" id="proof_of_address" required>
              <label for="proof_of_address" class="btn-primary px-6 py-2 rounded-lg cursor-pointer">
                Choose File
              </label>
            </div>
          </div>
        </div>

        <!-- Payment Details Section -->
        <div class="mb-8 bg-white dark:bg-slate-800 text-black dark:text-white border border-gray-200 dark:border-slate-700 shadow-md rounded-2xl p-8 transition-colors">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Payment Details</h2>

          <!-- Payment Information -->
          <div id="payment-info" class="hidden">
            <div class="bg-gray-50 dark:bg-slate-900/50 border border-gray-100 dark:border-slate-700 rounded-2xl p-6 mb-6">
              <h3 class="text-lg font-black text-gray-900 dark:text-white mb-4">Payment Information</h3>

              <!-- Selected Card Summary -->
              <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-xl p-4 mb-6">
                <div class="flex justify-between items-center">
                  <div>
                    <h4 class="text-blue-900 dark:text-blue-100 font-black" id="payment-card-type">Card Type</h4>
                    <p class="text-blue-700 dark:text-blue-300 text-xs font-bold uppercase tracking-wider">Total Amount: <span class="text-blue-600 dark:text-blue-400 font-black ml-1" id="payment-total-amount">$0.00</span></p>
                  </div>
                  <div class="text-right">
                    <div class="text-2xl font-black text-blue-600 dark:text-blue-400" id="payment-card-price">$0.00</div>
                    <div class="text-[10px] text-blue-500 font-bold uppercase tracking-widest">+ $10.00 fee</div>
                  </div>
                </div>
              </div>

              <!-- QR Code and Address -->
              <div class="text-center mb-6">
                <div id="qr-code-container" class="mb-4 bg-white dark:bg-white p-4 rounded-2xl inline-block shadow-sm">
                  <!-- QR code will be displayed here -->
                </div>
                <p class="text-[10px] text-gray-400 dark:text-gray-500 font-black uppercase tracking-[0.2em] mb-3">Wallet Address</p>
                <div class="relative max-w-sm mx-auto">
                  <input type="text" id="wallet-address" class="font-bold text-gray-900 dark:text-white bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 form-input w-full pr-12 py-3 rounded-xl focus:ring-2 focus:ring-blue-500" readonly>
                  <button type="button" onclick="copyAddress()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-600 transition-colors">
                    <i class="fas fa-copy"></i>
                  </button>
                </div>
              </div>

              <!-- Payment Instructions -->
              <div id="payment-instructions" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                <!-- Payment instructions will be displayed here -->
              </div>
            </div>
          </div>

          <!-- Select Card Type First Message -->
          <div id="select-card-message" class="text-center py-12">
            <div class="w-16 h-16 bg-gray-100 dark:bg-slate-900/50 rounded-2xl flex items-center justify-center mx-auto mb-4">
               <i class="fas fa-credit-card text-2xl text-gray-400"></i>
            </div>
            <p class="text-gray-400 dark:text-gray-500 font-bold">Please select a card type and payment coin above</p>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="mb-8 bg-white dark:bg-slate-800 text-black dark:text-white border border-gray-200 dark:border-slate-700 shadow-md rounded-2xl p-8 transition-colors">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Order Summary</h2>
          <div class="space-y-4">
            <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-slate-700">
              <span class="text-gray-500 dark:text-gray-400 font-bold text-xs uppercase tracking-wider">Card Type:</span>
              <span class="text-gray-900 dark:text-white font-black" id="summary-card-type">Not selected</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-slate-700">
              <span class="text-gray-500 dark:text-gray-400 font-bold text-xs uppercase tracking-wider">Card Price:</span>
              <span class="text-gray-900 dark:text-white font-black" id="summary-card-price">$0.00</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100 dark:border-slate-700">
              <span class="text-gray-500 dark:text-gray-400 font-bold text-xs uppercase tracking-wider">Processing Fee:</span>
              <span class="text-gray-900 dark:text-white font-black">$10.00</span>
            </div>
            <div class="flex justify-between items-center py-6">
              <span class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tighter">Total Amount</span>
              <span class="text-3xl font-black text-blue-600 dark:text-blue-400" id="summary-total">$0.00</span>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" id="submit-btn" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-black px-12 py-5 rounded-2xl text-lg shadow-xl shadow-blue-500/20 disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:-translate-y-1" disabled>
            PRE-ORDER NOW - <span id="submit-btn-text">Select Card Type</span>
          </button>
        </div>
      </form>
    </div>
  </div>
  <script>
    // Create animated particles
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 30;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');

        // Random position
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;

        particle.style.left = `${posX}vw`;
        particle.style.top = `${posY}vh`;

        // Random size
        const size = Math.random() * 3 + 1;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;

        // Random animation
        const duration = Math.random() * 10 + 5;
        const delay = Math.random() * 5;

        particle.style.animation = `float ${duration}s linear ${delay}s infinite`;

        particlesContainer.appendChild(particle);
      }
    }

    // Initialize particles
    createParticles();

    document.addEventListener('DOMContentLoaded', function() {
      // Card type selection
      const cardTypeDropdown = document.getElementById('card-type-dropdown');
      const paymentCoinDropdown = document.getElementById('payment-coin-dropdown');
      const cardTypeInput = document.getElementById('card_type_input');
      const cardPriceInput = document.getElementById('card_price_input');
      const paymentCoinInput = document.getElementById('payment_coin_input');
      const paymentInfo = document.getElementById('payment-info');
      const selectCardMessage = document.getElementById('select-card-message');
      const cardTypeMenu = document.getElementById('card_type_menu');
      const paymentCoinMenu = document.getElementById('payment_coin_menu');

      // Card selection handling
      const cardOptions = document.querySelectorAll('.card-option');
      const submitBtn = document.getElementById('submit-btn');
      const submitBtnText = document.getElementById('submit-btn-text');
      const summaryCardType = document.getElementById('summary-card-type');
      const summaryCardPrice = document.getElementById('summary-card-price');
      const summaryTotal = document.getElementById('summary-total');

              // Handle card option selection
        cardOptions.forEach(option => {
          option.addEventListener('click', function() {
            // Remove active class from all options
            cardOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add active class to selected option
            this.classList.add('selected');

          // Get card details
          const cardType = this.getAttribute('data-card-type');
          const cardPrice = parseFloat(this.getAttribute('data-price'));
          const processingFee = 10.00;
          const total = cardPrice + processingFee;

          // Update hidden inputs
          cardTypeInput.value = cardType;
          cardPriceInput.value = cardPrice;

                    // Update summary
          summaryCardType.textContent = cardType;
          summaryCardPrice.textContent = `$${cardPrice.toFixed(2)}`;
          summaryTotal.textContent = `$${total.toFixed(2)}`;

          // Update payment info section
          document.getElementById('payment-card-type').textContent = cardType;
          document.getElementById('payment-card-price').textContent = `$${cardPrice.toFixed(2)}`;
          document.getElementById('payment-total-amount').textContent = `$${total.toFixed(2)}`;

          // Enable submit button
          submitBtn.disabled = false;
          submitBtnText.textContent = `$${total.toFixed(2)}`;

          // Show payment info section
          document.getElementById('select-card-message').classList.add('hidden');
          document.getElementById('payment-info').classList.remove('hidden');
        });
      });

      // Store wallet type data
      const walletTypes = @json($activeWalletTypes);

      // Function to update dropdowns
      function updateDropdowns() {
        const selectedCardType = walletTypes.find(wt => wt.short_code === cardTypeInput.value);
        const selectedPaymentCoin = walletTypes.find(wt => wt.short_code === paymentCoinInput.value);

        if (selectedCardType) {
          paymentCoinDropdown.querySelector('.w-6').style.backgroundImage = `url(/images/crypto_logo/${selectedCardType.logo})`;
          paymentCoinDropdown.querySelector('.text-gray-300').textContent = `${selectedCardType.coin_name} (${selectedCardType.short_code})`;
          paymentCoinDropdown.querySelector('.w-6').style.backgroundImage = `url(/images/crypto_logo/${selectedCardType.logo})`;
        } else {
          paymentCoinDropdown.querySelector('.w-6').style.backgroundImage = 'none';
          paymentCoinDropdown.querySelector('.text-gray-300').textContent = 'Select a payment coin';
        }
      }

      // Initial update
      updateDropdowns();

      // Event listeners for card type dropdown (guarded - may not exist)
      if (cardTypeDropdown && cardTypeMenu) {
        cardTypeDropdown.addEventListener('click', function() {
          cardTypeMenu.classList.toggle('hidden');
        });

        cardTypeMenu.addEventListener('click', function(e) {
          const selectedItem = e.target.closest('.card-type-option-item');
          if (selectedItem) {
            cardTypeInput.value = selectedItem.dataset.short;
            updateDropdowns();
            cardTypeMenu.classList.add('hidden');
          }
        });
      }

      // Payment coin toggle is handled by setupDropdown below; removing duplicate handlers

      // Dropdown helpers
      function setupDropdown(rootId, inputId, labelId, menuId, itemClass, onSelect) {
        const root = document.getElementById(rootId)
        const input = document.getElementById(inputId)
        const label = document.getElementById(labelId)
        const menu = document.getElementById(menuId)
        const btn = root.querySelector('button')
        const items = root.querySelectorAll('.' + itemClass)

        function closeMenu(){ menu.classList.add('hidden') }
        function openMenu(){ menu.classList.remove('hidden') }

        btn.addEventListener('click', (e)=>{
          e.stopPropagation()
          if (menu.classList.contains('hidden')) openMenu(); else closeMenu()
        })
        document.addEventListener('click', closeMenu)

        items.forEach(it=>{
          it.addEventListener('click', () => {
            const short = it.getAttribute('data-short')
            const name = it.getAttribute('data-name')
            const logo = it.getAttribute('data-logo')
            input.value = short
            label.innerHTML = `${logo ? `<img src="/images/crypto_logo/${logo}" class='w-6 h-6 rounded'>` : `<span class='w-6 h-6 rounded bg-gray-700 inline-block'></span>`} <span class='text-white'>${name} <span class='text-gray-400'>(${short})</span></span>`
            closeMenu()
            if (onSelect) onSelect(it)
          })
        })
      }

      // Setup card type dropdown (only if present)
      if (document.getElementById('card-type-dropdown')) {
        setupDropdown(
          'card-type-dropdown',
          'card_type_input',
          'card_type_selected_label',
          'card_type_menu',
          'card-type-option-item',
          null
        )
      }

      // Setup payment coin dropdown (updates payment details)
      setupDropdown(
        'payment-coin-dropdown',
        'payment_coin_input',
        'payment_coin_selected_label',
        'payment_coin_menu',
        'payment-coin-option-item',
        function(item){
          const wt = {
            short: item.getAttribute('data-short'),
            name: item.getAttribute('data-name'),
            logo: item.getAttribute('data-logo'),
            qr: item.getAttribute('data-qr'),
            address: item.getAttribute('data-address'),
            instructions: item.getAttribute('data-instructions')
          }
          // toggle sections
          document.getElementById('select-card-message').classList.add('hidden')
          document.getElementById('payment-info').classList.remove('hidden')
          // set QR
          const qrContainer = document.getElementById('qr-code-container')
          if (wt.qr) {
            qrContainer.innerHTML = `<img src="/images/crypto_logo/${wt.qr}" alt="QR Code" class="mx-auto w-48 h-48">`
          } else {
            qrContainer.innerHTML = `<div class='w-48 h-48 mx-auto bg-gray-700 rounded-lg flex items-center justify-center'><i class='fas fa-qrcode text-4xl text-gray-500'></i></div>`
          }
          // set address
          const walletAddressInput = document.getElementById('wallet-address')
          walletAddressInput.value = wt.address || 'No wallet address configured'
          // set instructions
          const instructionsDiv = document.getElementById('payment-instructions')
          if (wt.instructions && wt.instructions.length) {
            instructionsDiv.innerHTML = wt.instructions
          } else {
            instructionsDiv.innerHTML = `
              <div class="space-y-2">
                <p><strong>Note:</strong></p>
                <ul class="list-disc list-inside space-y-1">
                  <li>Send only ${wt.name} to this wallet address.</li>
                  <li>Other assets sent here may be lost.</li>
                  <li>Wait for 3-5 confirmations after payment.</li>
                </ul>
              </div>`
          }
        }
      )

      // Copy address function
      window.copyAddress = function() {
        const walletAddressInput = document.getElementById('wallet-address');
        walletAddressInput.select();
        walletAddressInput.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');

        // Show feedback
        const copyButton = document.querySelector('button[onclick="copyAddress()"]');
        const originalIcon = copyButton.innerHTML;
        copyButton.innerHTML = '<i class="fas fa-check text-green-400"></i>';
        setTimeout(() => {
          copyButton.innerHTML = originalIcon;
        }, 2000);
      };

      // File upload handling
      const fileInput = document.getElementById('proof_of_address');
      const uploadArea = fileInput.parentElement;
      const noFileText = uploadArea.querySelector('.text-sm.text-gray-500');

      fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
          noFileText.textContent = this.files[0].name;
          uploadArea.classList.add('border-blue-500', 'bg-blue-900');
        } else {
          noFileText.textContent = 'No file chosen';
          uploadArea.classList.remove('border-blue-500', 'bg-blue-900');
        }
      });

      // Drag and drop functionality
      uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-blue-500', 'bg-blue-900');
      });

      uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-900');
      });

      uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-blue-500', 'bg-blue-900');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
          fileInput.files = files;
          noFileText.textContent = files[0].name;
        }
      });
    });
  </script>
  @include('user.components.user')
</body>
</html>
