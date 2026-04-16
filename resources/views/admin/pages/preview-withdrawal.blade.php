@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">Withdrawal Preview #{{ $withdrawal->id }}</h2>
        <a href="{{ route('admin.withdrawals.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Withdrawals</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Withdrawal Information -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Withdrawal Information</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">User:</span>
                        <span class="text-white">{{ optional($withdrawal->user)->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Method:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($withdrawal->method === 'crypto') bg-blue-600/20 text-blue-300
                            @elseif($withdrawal->method === 'bank') bg-green-600/20 text-green-300
                            @else bg-purple-600/20 text-purple-300 @endif">
                            {{ strtoupper($withdrawal->method) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Coin:</span>
                        <div class="flex items-center gap-2">
                            @if($withdrawal->walletType && $withdrawal->walletType->logo)
                                <img src="/images/crypto_logo/{{ $withdrawal->walletType->logo }}"
                                     alt="{{ $withdrawal->walletType->coin_name }}"
                                     class="w-6 h-6 rounded-full">
                            @endif
                            <span class="text-white">{{ optional($withdrawal->walletType)->coin_name }} ({{ optional($withdrawal->walletType)->short_code }})</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Amount:</span>
                        <span class="text-white">{{ number_format($withdrawal->amount, 8) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($withdrawal->status === 0) bg-yellow-600/20 text-yellow-300
                            @elseif($withdrawal->status === 1) bg-green-600/20 text-green-300
                            @else bg-red-600/20 text-red-300 @endif">
                            @if($withdrawal->status === 0) Pending
                            @elseif($withdrawal->status === 1) Approved
                            @else Rejected
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submitted:</span>
                        <span class="text-white">{{ $withdrawal->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($withdrawal->approved_at)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Approved:</span>
                        <span class="text-white">
                            @if($withdrawal->approved_at instanceof \Carbon\Carbon)
                                {{ $withdrawal->approved_at->format('M d, Y H:i') }}
                            @else
                                {{ \Carbon\Carbon::parse($withdrawal->approved_at)->format('M d, Y H:i') }}
                            @endif
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Method-Specific Details -->
                <div>
                    <h4 class="text-md font-medium text-white mb-4">
                        @if($withdrawal->method === 'crypto')
                            Destination Address
                        @elseif($withdrawal->method === 'bank')
                            Bank Account Details
                        @else
                            Wire Transfer Details
                        @endif
                    </h4>
                    <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                        @if($withdrawal->method === 'crypto')
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Address:</span>
                                    <span class="text-white break-all font-mono text-sm">{{ $withdrawal->destination_address }}</span>
                                </div>
                            </div>
                        @elseif($withdrawal->method === 'bank')
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Bank Name:</span>
                                    <span class="text-white">{{ $withdrawal->bank_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Account Name:</span>
                                    <span class="text-white">{{ $withdrawal->account_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Account Number:</span>
                                    <span class="text-white font-mono">{{ $withdrawal->account_number }}</span>
                                </div>
                            </div>
                        @else
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Wire Details:</span>
                                    <span class="text-white">{{ $withdrawal->wire_details }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="lg:col-span-1">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Actions</h3>

                @if($withdrawal->status !== 1)
                    <form method="post" action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                            <i class="fas fa-check"></i>
                            <span>Approve & Debit Wallet</span>
                        </button>
                    </form>
                @endif

                @if($withdrawal->status !== 2)
                    <form method="post" action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                            <i class="fas fa-times"></i>
                            <span>Reject Withdrawal</span>
                        </button>
                    </form>
                @endif

                @if($withdrawal->status === 1)
                    <div class="mt-4 p-4 bg-green-900/30 border border-green-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-green-300 mb-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-medium">Wallet Debited</span>
                        </div>
                        <p class="text-sm text-green-200">
                            User's {{ optional($withdrawal->walletType)->coin_name }} wallet has been debited by {{ number_format($withdrawal->amount, 8) }} coins.
                        </p>
                    </div>
                @endif

                @if($withdrawal->status === 2)
                    <div class="mt-4 p-4 bg-red-900/30 border border-red-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-red-300 mb-2">
                            <i class="fas fa-times-circle"></i>
                            <span class="font-medium">Withdrawal Rejected</span>
                        </div>
                        <p class="text-sm text-red-200">
                            This withdrawal has been rejected and no funds were debited from the user's wallet.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
