@php($title = 'Card Request Details')
@include('user.components.user_head')

  <!-- Header -->
  @include('user.components.top-navbar')

  <div class="max-w-5xl mx-auto px-4 mt-6 mb-24">
    <div class="grid md:grid-cols-2 gap-6">
      <!-- Request Summary -->
      <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-xl shadow-lg p-6 text-black">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Request Summary</h2>
          <div>
            @if($cardRequest->status === 'pending')
              <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                <i class="fas fa-clock mr-1"></i> Pending
              </span>
            @elseif($cardRequest->status === 'approved')
              <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                <i class="fas fa-check mr-1"></i> Approved
              </span>
            @else
              <span class="px-3 py-1 rounded-full text-sm font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                <i class="fas fa-times mr-1"></i> Rejected
              </span>
            @endif
          </div>
        </div>

        <div class="space-y-3 text-sm">
          <div class="flex justify-between">
            <span class="text-gray-400">Card Type:</span>
            <span class="font-medium">{{ $cardRequest->card_type }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-400">Cardholder:</span>
            <span class="font-medium">{{ $cardRequest->cardholder_name }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-400">Email:</span>
            <span class="font-medium">{{ $cardRequest->email }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-400">Phone:</span>
            <span class="font-medium">{{ $cardRequest->phone_number }}</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-400">Submitted:</span>
            <span class="font-medium">{{ $cardRequest->created_at->format('M j, Y \a\t g:i A') }}</span>
          </div>
          @if($cardRequest->status === 'approved')
            <div class="flex justify-between">
              <span class="text-gray-400">Approved:</span>
              <span class="font-medium">{{ optional($cardRequest->approved_at)->format('M j, Y \a\t g:i A') }}</span>
            </div>
          @elseif($cardRequest->status === 'rejected')
            <div class="flex justify-between">
              <span class="text-gray-400">Rejected:</span>
              <span class="font-medium">{{ optional($cardRequest->rejected_at)->format('M j, Y \a\t g:i A') }}</span>
            </div>
          @endif
        </div>

        <div class="mt-4">
          <h3 class="text-sm font-semibold text-gray-300 mb-2">Shipping Address</h3>
          <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4 border border-slate-700 text-sm text-gray-200">
            {{ $cardRequest->address }}
          </div>
        </div>

        @if($cardRequest->admin_notes)
          <div class="mt-4">
            <h3 class="text-sm font-semibold text-gray-300 mb-2">Admin Notes</h3>
            <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4 border border-slate-700 text-sm text-gray-200">
              {{ $cardRequest->admin_notes }}
            </div>
          </div>
        @endif
      </div>

      <!-- Card / Payment Details -->
      <div class="space-y-6">
        <!-- Virtual Card Preview (show full details if approved) -->
        <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-xl shadow-lg p-6 text-black">
          <h2 class="text-lg font-semibold mb-4">Card Preview</h2>
          <div class="card-preview rounded-2xl p-6">
            <div class="flex justify-between items-start mb-6">
              <div class="text-sm opacity-80">XXXXX Card</div>
              <div class="text-lg font-bold">NANOXLEDGER</div>
            </div>
            <div class="mb-6">
              <div class="text-sm opacity-80 mb-2">Card Number</div>
              <div class="text-xl font-mono tracking-wider">
                @if($cardRequest->isApproved() && $cardRequest->card_number)
                  {{ $cardRequest->card_number }}
                @else
                  {{ $cardRequest->getMaskedCardNumber() }}
                @endif
              </div>
            </div>
            <div class="flex justify-between items-end">
              <div>
                <div class="text-sm opacity-80 mb-1">Valid Thru</div>
                <div class="text-lg font-mono">{{ $cardRequest->isApproved() && $cardRequest->expiry_date ? $cardRequest->expiry_date : 'MM/YY' }}</div>
              </div>
              <div class="text-right">
                <div class="text-sm opacity-80 mb-1">CVV</div>
                <div class="text-lg font-mono">{{ $cardRequest->isApproved() && $cardRequest->cvv ? $cardRequest->cvv : '***' }}</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Details (if any were recorded with the request) -->
        <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-xl shadow-lg p-6 text-black">
          <h2 class="text-lg font-semibold mb-4">Payment Details</h2>
          <div class="space-y-4">
            @if(!empty($cardRequest->wallet_address))
              <div>
                <div class="text-sm text-gray-400 mb-1">Wallet Address</div>
                <div class="relative">
                  <input type="text" value="{{ $cardRequest->wallet_address }}" class="form-input w-full pr-12" readonly>
                  <button type="button" onclick="(function(el){el.select();document.execCommand('copy')})(this.previousElementSibling)" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-400 hover:text-blue-300">
                    <i class="fas fa-copy"></i>
                  </button>
                </div>
              </div>
            @else
              <div class="text-sm text-gray-400">No payment address stored with this request.</div>
            @endif

            @if(!empty($cardRequest->proof_of_address_file))
              <div>
                <div class="text-sm text-gray-400 mb-1">Proof of Address</div>
                <a href="{{ asset('storage/'.$cardRequest->proof_of_address_file) }}" target="_blank" class="text-indigo-400 hover:text-indigo-300">View uploaded file</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('user.components.user')
</body>
</html>
