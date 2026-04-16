@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">User Deposits</h2>
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

    <div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-800/60">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">User</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Coin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submitted</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($deposits as $d)
                    <tr>
                        <td class="px-4 py-3 text-gray-300">{{ $d->id }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ optional($d->user)->email }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ optional($d->walletType)->coin_name }} ({{ optional($d->walletType)->short_code }})</td>
                        <td class="px-4 py-3 text-gray-100">{{ $d->amount ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if($d->status === 'pending')
                                <span class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                            @elseif($d->status === 'approved')
                                <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-300">{{ $d->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.deposits.preview', $d->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </a>
                                @if($d->status !== 'approved')
                                    <form action="{{ route('admin.deposit.approve', $d->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-green-600 hover:bg-green-500 text-white text-xs">
                                            <i class="fas fa-check"></i>
                                            <span>Approve</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.deposit.reject', $d->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-500 text-white text-xs">
                                            <i class="fas fa-times"></i>
                                            <span>Reject</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Credited</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-400">No deposits found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($deposits->hasPages())
        <div class="mt-4 flex justify-center">
            {{ $deposits->links() }}
        </div>
    @endif
</div>
@endsection


