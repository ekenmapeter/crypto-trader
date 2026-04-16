@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">{{ $title }}</h2>
        <a href="{{ route('admin.qphone.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Orders</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Order Information -->
        <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
            <h3 class="text-lg font-medium text-white mb-4">Order Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-400">User:</span>
                    <span class="text-white">{{ $order->user->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Product:</span>
                    <span class="text-white">{{ $order->product_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Quantity:</span>
                    <span class="text-white">{{ $order->quantity }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Price:</span>
                    <span class="text-white">${{ number_format($order->price, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Payment Coin:</span>
                    <span class="text-white">{{ $order->payment_coin }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Wallet Address:</span>
                    <span class="text-white break-all">{{ $order->wallet_address ?: '—' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">TX Reference:</span>
                    <span class="text-white break-all">{{ $order->tx_reference ?: '—' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Status:</span>
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                        @if($order->status === 'pending') bg-yellow-600/20 text-yellow-300
                        @elseif($order->status === 'approved') bg-green-600/20 text-green-300
                        @else bg-red-600/20 text-red-300 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Submitted:</span>
                    <span class="text-white">{{ $order->created_at->format('M d, Y H:i') }}</span>
                </div>
                @if($order->payment_proof)
                <div class="flex justify-between">
                    <span class="text-gray-400">Payment Proof:</span>
                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                        View Proof
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
            <h3 class="text-lg font-medium text-white mb-4">Actions</h3>

            @if($order->status !== 'approved')
                <form class="mb-6" method="POST" action="{{ route('admin.qphone.approve', $order->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Admin Notes (optional)</label>
                        <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                        <i class="fas fa-check"></i>
                        <span>Approve Order</span>
                    </button>
                </form>
            @endif

            @if($order->status !== 'rejected')
                <form method="POST" action="{{ route('admin.qphone.reject', $order->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Rejection Reason <span class="text-red-400">*</span></label>
                        <textarea name="admin_notes" rows="3" required class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                        <i class="fas fa-times"></i>
                        <span>Reject Order</span>
                    </button>
                </form>
            @endif

            @if($order->status === 'approved' || $order->status === 'rejected')
                <div class="mt-4 p-4 bg-gray-800/50 rounded-md">
                    <p class="text-sm text-gray-400">
                        <strong>Processed:</strong>
                        @if($order->approved_at)
                            @if($order->approved_at instanceof \Carbon\Carbon)
                                {{ $order->approved_at->format('M d, Y H:i') }}
                            @else
                                {{ \Carbon\Carbon::parse($order->approved_at)->format('M d, Y H:i') }}
                            @endif
                        @elseif($order->rejected_at)
                            @if($order->rejected_at instanceof \Carbon\Carbon)
                                {{ $order->rejected_at->format('M d, Y H:i') }}
                            @else
                                {{ \Carbon\Carbon::parse($order->rejected_at)->format('M d, Y H:i') }}
                            @endif
                        @else
                            N/A
                        @endif
                    </p>
                    @if($order->admin_notes)
                        <p class="text-sm text-gray-400 mt-2">
                            <strong>Notes:</strong> {{ $order->admin_notes }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
