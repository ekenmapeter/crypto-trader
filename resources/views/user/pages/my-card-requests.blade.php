@php($title = 'My Card Requests')
@include('user.components.user_head')

  <!-- Header -->
  @include('user.components.top-navbar')

  <div class="max-w-6xl mx-auto px-4 mt-6 mb-24">
    <div class="grid gap-6">
      @forelse($cardRequests as $request)
        <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-xl shadow-lg p-6 text-black">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
              <div class="w-12 h-12 bg-black/20 border border-indigo-600/30 rounded-full flex items-center justify-center">
                <i class="fas fa-credit-card text-indigo-400 text-xl"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold">{{ $request->card_type }}</h3>
                <p class="text-sm text-gray-400">Requested on {{ $request->created_at->format('M j, Y') }}</p>
              </div>
            </div>

            <div class="text-right">
              @if($request->status === 'pending')
                <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                  <i class="fas fa-clock mr-1"></i> Pending
                </span>
              @elseif($request->status === 'approved')
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

          <div class="grid md:grid-cols-2 gap-6 mb-4">
            <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4 border border-slate-700">
              <h4 class="font-medium text-gray-200 mb-3">Request Details</h4>
              <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                  <span class="text-gray-400">Cardholder:</span>
                  <span class="font-medium">{{ $request->cardholder_name }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-400">Email:</span>
                  <span class="font-medium">{{ $request->email }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-400">Phone:</span>
                  <span class="font-medium">{{ $request->phone_number }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-400">Address:</span>
                  <span class="font-medium">{{ Str::limit($request->address, 40) }}</span>
                </div>
              </div>
            </div>

            @if($request->status === 'approved')
              <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4 border border-slate-700">
                <h4 class="font-medium text-gray-200 mb-3">Card Details</h4>
                <div class="space-y-2 text-sm">
                  <div class="flex justify-between">
                    <span class="text-gray-400">Card Number:</span>
                    <span class="font-mono font-medium">{{ $request->getMaskedCardNumber() }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-400">Expiry:</span>
                    <span class="font-mono font-medium">{{ $request->expiry_date }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-400">CVV:</span>
                    <span class="font-mono font-medium">{{ $request->cvv }}</span>
                  </div>
                </div>
              </div>
            @endif
          </div>

          @if($request->admin_notes)
            <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl rounded-lg p-4 mb-4 border border-slate-700">
              <h4 class="font-medium text-gray-200 mb-2">Admin Notes</h4>
              <p class="text-sm text-gray-300">{{ $request->admin_notes }}</p>
            </div>
          @endif

          <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="text-sm text-gray-400">
              @if($request->status === 'pending')
                <i class="fas fa-info-circle mr-1"></i>
                Your request is under review. We'll notify you once processed.
              @elseif($request->status === 'approved')
                <i class="fas fa-check-circle mr-1 text-green-400"></i>
                Approved on
                @if($request->approved_at instanceof \Carbon\Carbon)
                    {{ $request->approved_at->format('M j, Y \a\t g:i A') }}
                @else
                    {{ \Carbon\Carbon::parse($request->approved_at)->format('M j, Y \a\t g:i A') }}
                @endif
              @else
                <i class="fas fa-times-circle mr-1 text-red-400"></i>
                Rejected on
                @if($request->rejected_at instanceof \Carbon\Carbon)
                    {{ $request->rejected_at->format('M j, Y \a\t g:i A') }}
                @else
                    {{ \Carbon\Carbon::parse($request->rejected_at)->format('M j, Y \a\t g:i A') }}
                @endif
              @endif
            </div>

            <a href="{{ route('user.card-request.show', $request->id) }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">
              View Details <i class="fas fa-arrow-right ml-1"></i>
            </a>
          </div>
        </div>
      @empty
        <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl border border-gray-200 rounded-xl shadow-lg p-12 text-center text-black">
          <div class="w-24 h-24 bg-gray-800 border border-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-credit-card text-gray-400 text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">No Card Requests Yet</h3>
          <p class="text-gray-400 mb-6">You haven't submitted any card requests yet.</p>
          <a href="{{ route('user.card-request.create') }}" class="bg-[#F5A623] text-black font-bold text-black px-6 py-3 rounded-lg hover:bg-[#F5A623] text-black font-bold transition-colors">
            Apply for Your First Card
          </a>
        </div>
      @endforelse
    </div>
  </div>

  @include('user.components.user')
</body>
</html>
