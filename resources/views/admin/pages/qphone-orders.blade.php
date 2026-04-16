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

    <div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-800/60">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">User</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Product</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Qty</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Paid At</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($orders as $o)
                    <tr>
                        <td class="px-4 py-3 text-gray-300">{{ $o->id }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ $o->user->email }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ $o->product_name }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $o->quantity }}</td>
                        <td class="px-4 py-3 text-gray-100">${{ number_format($o->price,2) }}</td>
                        <td class="px-4 py-3">
                            @if($o->status === 'pending')
                                <span class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                            @elseif($o->status === 'approved')
                                <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-300">{{ optional($o->paid_at)->format('M j, Y g:i A') ?: '—' }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.qphone.preview',$o->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                <i class="fas fa-eye"></i>
                                <span>Preview</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-400">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="mt-4 flex justify-center">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
