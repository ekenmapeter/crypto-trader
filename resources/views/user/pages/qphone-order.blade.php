@php($title = 'Order Qphone')
@include('user.components.user_head')

<style>
  .phone-gallery {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    border-radius: 20px;
    padding: 40px;
    position: relative;
    overflow: hidden;
  }

  .phone-gallery::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="circuit" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><path d="M0 10h20M10 0v20" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23circuit)"/></svg>');
    opacity: 0.3;
  }

  .phone-display {
    position: relative;
    z-index: 2;
  }

  .action-btn {
    transition: all 0.3s ease;
    transform: translateY(0);
  }

  .action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  }

  .gradient-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  }

  .gradient-blue {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  }
</style>

<!-- Header -->
@include('user.components.top-navbar')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
  <!-- Main Phone Gallery -->
  <div class="phone-gallery mb-8">
    <div class="phone-display flex items-center justify-center space-x-8">
      <!-- Left Phone (Blue/Silver) -->
      <div class="text-center">
        <div class="w-32 h-64 bg-gradient-to-b from-blue-200 to-slate-300 rounded-3xl p-2 shadow-2xl">
          <div class="w-full h-full bg-gradient-to-b from-blue-100 to-slate-200 rounded-2xl flex items-center justify-center">
            <div class="w-16 h-20 bg-slate-600 rounded-lg"></div>
          </div>
        </div>
        <div class="mt-4 text-black text-sm opacity-80">Quad Camera</div>
      </div>

      <!-- Center Phone (White with Q Logo) -->
      <div class="text-center">
        <div class="w-32 h-64 bg-white rounded-3xl p-2 shadow-2xl">
          <div class="w-full h-full bg-white rounded-2xl flex flex-col items-center justify-center relative">
            <!-- Punch-hole camera -->
            <div class="absolute top-4 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-[#F5A623] text-black font-bold rounded-full"></div>
            <!-- Q Logo and Text -->
            <div class="text-center">
              <div class="text-2xl font-bold text-gray-400 mb-1">Q</div>
              <div class="text-xs text-gray-500 mb-1">SKT 5GX</div>
              <div class="text-sm font-bold text-blue-600 mb-1">QUANTUM</div>
              <div class="text-xs text-gray-400">Secured by Swiss Quantum</div>
            </div>
          </div>
        </div>
        <div class="mt-4 text-black text-sm opacity-80">Front Display</div>
      </div>

      <!-- Right Phone (Silver/White) -->
      <div class="text-center">
        <div class="w-32 h-64 bg-gradient-to-b from-slate-200 to-white rounded-3xl p-2 shadow-2xl">
          <div class="w-full h-full bg-gradient-to-b from-slate-100 to-white rounded-2xl flex items-center justify-center">
            <div class="w-16 h-20 bg-slate-600 rounded-lg"></div>
          </div>
        </div>
        <div class="mt-4 text-black text-sm opacity-80">Quad Camera</div>
      </div>
    </div>
  </div>


  <!-- Action Buttons -->
  <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
    <button onclick="window.location.href='{{ route('user') }}'" class="action-btn gradient-green text-black px-8 py-4 rounded-xl font-semibold text-lg shadow-lg">
      <i class="fas fa-home mr-2"></i>
      BACK TO DASHBOARD
    </button>

    <button onclick="proceedToOrder()" class="action-btn gradient-blue text-black px-8 py-4 rounded-xl font-semibold text-lg shadow-lg">
      <i class="fas fa-arrow-right mr-2"></i>
      PROCEED TO PAYMENT
    </button>
  </div>

</div>

<script>
  function proceedToOrder() {
    // Redirect to the payment/order form page
    window.location.href = '{{ route("user.qphone.show") }}';
  }
</script>

@include('user.components.user')
</body>
</html>
