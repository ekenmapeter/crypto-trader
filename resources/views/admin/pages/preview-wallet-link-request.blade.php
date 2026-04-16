@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">Wallet Link Request Preview #{{ $request->id }}</h2>
        <a href="{{ route('admin.wallet-link-requests.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Requests</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Request Information -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Request Information</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">User:</span>
                        <span class="text-white">{{ optional($request->user)->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Name:</span>
                        <div class="flex items-center gap-2">
                            @if($request->walletProvider && $request->walletProvider->trans_img_src)
                                <img src="{{ $request->walletProvider->trans_img_src }}"
                                     alt="{{ $request->walletProvider->title }}"
                                     class="w-6 h-6 rounded-full">
                            @endif
                            <span class="text-white">{{ optional($request->walletProvider)->title }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Wallet Name:</span>
                        <span class="text-white">{{ $request->wallet_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submission Type:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($request->recovery_phrase) bg-blue-600/20 text-blue-300
                            @elseif($request->keystore_json) bg-green-600/20 text-green-300
                            @else bg-purple-600/20 text-purple-300 @endif">
                            @if($request->recovery_phrase)
                                Recovery Phrase
                            @elseif($request->keystore_json)
                                Keystore JSON
                            @else
                                Private Key
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($request->status === 'pending') bg-yellow-600/20 text-yellow-300
                            @elseif($request->status === 'approved') bg-green-600/20 text-green-300
                            @else bg-red-600/20 text-red-300 @endif">
                            {{ ucfirst($request->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submitted:</span>
                        <span class="text-white">{{ $request->submitted_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($request->processed_at)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Processed:</span>
                        <span class="text-white">{{ $request->processed_at->format('M d, Y H:i') }}</span>
                    </div>
                    @endif
                </div>

                <!-- Wallet Details with Copy Functionality -->
                <div>
                    <h4 class="text-md font-medium text-white mb-4">Wallet Details</h4>
                    <div class="space-y-4">
                        @if($request->wallet_address)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Wallet Address</span>
                                <button onclick="copyToClipboard('wallet-address')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="wallet-address" class="text-white break-all font-mono text-sm bg-gray-700 p-2 rounded">{{ $request->wallet_address }}</div>
                        </div>
                        @endif

                        @if($request->recovery_phrase)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Recovery Phrase</span>
                                <button onclick="copyToClipboard('recovery-phrase')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="recovery-phrase" class="text-white break-all font-mono text-sm bg-gray-700 p-2 rounded">{{ $request->recovery_phrase }}</div>
                        </div>
                        @endif

                        @if($request->keystore_json)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Keystore JSON</span>
                                <button onclick="copyToClipboard('keystore-json')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="keystore-json" class="text-white break-all font-mono text-sm bg-gray-700 p-2 rounded max-h-32 overflow-y-auto">{{ $request->keystore_json }}</div>
                        </div>
                        @endif

                        @if($request->keystore_password)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Keystore Password</span>
                                <button onclick="copyToClipboard('keystore-password')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="keystore-password" class="text-white break-all font-mono text-sm bg-gray-700 p-2 rounded">{{ $request->keystore_password }}</div>
                        </div>
                        @endif

                        @if($request->private_key)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Private Key</span>
                                <button onclick="copyToClipboard('private-key')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="private-key" class="text-white break-all font-mono text-sm bg-gray-700 p-2 rounded">{{ $request->private_key }}</div>
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

                @if($request->status !== 'approved')
                    <form method="post" action="{{ route('admin.wallet-link-requests.approve', $request->id) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                            <i class="fas fa-check"></i>
                            <span>Approve Request</span>
                        </button>
                    </form>
                @endif

                @if($request->status !== 'rejected')
                    <form method="post" action="{{ route('admin.wallet-link-requests.reject', $request->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                            <i class="fas fa-times"></i>
                            <span>Reject Request</span>
                        </button>
                    </form>
                @endif

                @if($request->status === 'approved')
                    <div class="mt-4 p-4 bg-green-900/30 border border-green-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-green-300 mb-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-medium">Request Approved</span>
                        </div>
                        <p class="text-sm text-green-200">
                            This wallet link request has been approved.
                        </p>
                    </div>
                @endif

                @if($request->status === 'rejected')
                    <div class="mt-4 p-4 bg-red-900/30 border border-red-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-red-300 mb-2">
                            <i class="fas fa-times-circle"></i>
                            <span class="font-medium">Request Rejected</span>
                        </div>
                        <p class="text-sm text-red-200">
                            This wallet link request has been rejected.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    const text = element.textContent;

    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i><span>Copied!</span>';
        button.classList.remove('bg-blue-600', 'hover:bg-blue-500');
        button.classList.add('bg-green-600');

        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-blue-600', 'hover:bg-blue-500');
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        alert('Failed to copy text to clipboard');
    });
}
</script>
@endsection
