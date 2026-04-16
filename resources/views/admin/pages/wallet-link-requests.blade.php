@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">{{ $title }}</h2>
        <a href="{{ route('administrator') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    @if($requests->count() > 0)
        <div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-800/60">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Wallet Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submission Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submitted</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($requests as $request)
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-4 py-3">
                                <div>
                                    <div class="font-medium text-white">{{ $request->user->username ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-400">{{ $request->user->email ?? 'N/A' }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    @if($request->walletProvider)
                                        <img src="{{ $request->walletProvider->trans_img_src }}"
                                             alt="{{ $request->walletProvider->title }}"
                                             class="w-6 h-6 rounded-full">
                                        <span class="text-white">{{ $request->walletProvider->title }}</span>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-white">{{ $request->wallet_name }}</div>
                                @if($request->wallet_address)
                                    <div class="text-sm text-gray-400 truncate max-w-xs" title="{{ $request->wallet_address }}">
                                        {{ $request->wallet_address }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($request->recovery_phrase)
                                    <span class="inline-flex items-center rounded-full bg-blue-600/20 px-2.5 py-0.5 text-xs font-medium text-blue-300">
                                        Recovery Phrase
                                    </span>
                                @elseif($request->keystore_json)
                                    <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">
                                        Keystore JSON
                                    </span>
                                @elseif($request->private_key)
                                    <span class="inline-flex items-center rounded-full bg-purple-600/20 px-2.5 py-0.5 text-xs font-medium text-purple-300">
                                        Private Key
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($request->status === 'pending')
                                    <span class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
                                @elseif($request->status === 'rejected')
                                    <span class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-300">
                                {{ $request->submitted_at->format('M d, Y H:i') }}
                            </td>
                                                    <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.wallet-link-requests.preview', $request->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </a>
                                @if($request->status === 'pending')
                                    <form action="{{ route('admin.wallet-link-requests.approve', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-green-600 hover:bg-green-500 text-white text-xs">
                                            <i class="fas fa-check"></i>
                                            <span>Approve</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.wallet-link-requests.reject', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-500 text-white text-xs">
                                            <i class="fas fa-times"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>
                                @else
                                    <div class="text-sm text-gray-400">
                                        {{ $request->processed_at ? $request->processed_at->format('M d, Y H:i') : 'N/A' }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
            <div class="mt-4 flex justify-center">
                {{ $requests->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 text-lg mb-4">
                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-2">No wallet link requests</h3>
            <p class="text-gray-400">When users submit wallet linking requests, they will appear here.</p>
        </div>
    @endif
</div>
@endsection
