@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">Deposit Preview #{{ $deposit->id }}</h2>
        <a href="{{ route('admin.deposits.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Deposits</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Deposit Information -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Deposit Information</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">User:</span>
                        <span class="text-white">{{ optional($deposit->user)->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Coin:</span>
                        <div class="flex items-center gap-2">
                            @if($deposit->walletType && $deposit->walletType->logo)
                                <img src="/images/crypto_logo/{{ $deposit->walletType->logo }}"
                                     alt="{{ $deposit->walletType->coin_name }}"
                                     class="w-6 h-6 rounded-full">
                            @endif
                            <span class="text-white">{{ optional($deposit->walletType)->coin_name }} ({{ optional($deposit->walletType)->short_code }})</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Amount:</span>
                        <span class="text-white">{{ $deposit->amount ? number_format($deposit->amount, 8) : '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">TX Reference:</span>
                        <span class="text-white break-all">{{ $deposit->tx_reference ?: '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($deposit->status === 'pending') bg-yellow-600/20 text-yellow-300
                            @elseif($deposit->status === 'approved') bg-green-600/20 text-green-300
                            @else bg-red-600/20 text-red-300 @endif">
                            {{ ucfirst($deposit->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submitted:</span>
                        <span class="text-white">{{ $deposit->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($deposit->credited_at)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Credited:</span>
                        <span class="text-white">
                            @if($deposit->credited_at instanceof \Carbon\Carbon)
                                {{ $deposit->credited_at->format('M d, Y H:i') }}
                            @else
                                {{ \Carbon\Carbon::parse($deposit->credited_at)->format('M d, Y H:i') }}
                            @endif
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Payment Proof -->
                @if($deposit->payment_proof)
                <div>
                    <h4 class="text-md font-medium text-white mb-4">Payment Proof</h4>
                    <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                        @php $isImage = \Illuminate\Support\Str::endsWith($deposit->payment_proof, ['.png','.jpg','.jpeg']); @endphp
                        @if($isImage)
                            <img src="{{ Storage::url($deposit->payment_proof) }}" alt="Payment Proof" class="w-full max-w-md h-auto rounded-md">
                        @else
                            <div class="flex items-center justify-center h-32 bg-gray-700 rounded-md">
                                <a href="{{ Storage::url($deposit->payment_proof) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-sm">
                                    <i class="fas fa-file-alt"></i>
                                    <span>View Payment Proof</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="lg:col-span-1">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Actions</h3>

                @if($deposit->status !== 'approved')
                    <form method="post" action="{{ route('admin.deposit.approve', $deposit->id) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                            <i class="fas fa-check"></i>
                            <span>Approve & Credit Wallet</span>
                        </button>
                    </form>
                @endif

                @if($deposit->status !== 'rejected')
                    <form method="post" action="{{ route('admin.deposit.reject', $deposit->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                            <i class="fas fa-times"></i>
                            <span>Reject Deposit</span>
                        </button>
                    </form>
                @endif

                @if($deposit->status === 'approved')
                    <div class="mt-4 p-4 bg-green-900/30 border border-green-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-green-300 mb-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-medium">Wallet Credited</span>
                        </div>
                        <p class="text-sm text-green-200">
                            User's {{ optional($deposit->walletType)->coin_name }} wallet has been credited with {{ number_format($deposit->amount, 8) }} coins.
                        </p>
                    </div>
                @endif

                @if($deposit->status === 'rejected')
                    <div class="mt-4 p-4 bg-red-900/30 border border-red-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-red-300 mb-2">
                            <i class="fas fa-times-circle"></i>
                            <span class="font-medium">Deposit Rejected</span>
                        </div>
                        <p class="text-sm text-red-200">
                            This deposit has been rejected and no funds were credited to the user's wallet.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
