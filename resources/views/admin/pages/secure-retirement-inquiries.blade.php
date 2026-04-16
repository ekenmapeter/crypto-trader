@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex items-center bg-blue-500 rounded-lg justify-between mb-6">
            <h2 class="text-xl font-semibold text-white">Secure Retirement Inquiries</h2>
            <a href="{{ route('administrator') }}"
                class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">
                {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-800/60">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Email
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Rollover
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submitted
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($inquiries as $inq)
                        <tr>
                            <td class="px-4 py-3 text-gray-100">{{ $inq->full_name }}</td>
                            <td class="px-4 py-3 text-gray-100">{{ $inq->email }}</td>
                            <td class="px-4 py-3 text-gray-100">{{ $inq->account_type }}</td>
                            <td class="px-4 py-3 text-gray-100">
                                {{ $inq->rollover_amount ? '$' . number_format($inq->rollover_amount, 2) : '—' }}</td>
                            <td class="px-4 py-3">
                                @if ($inq->status === 'pending')
                                    <span
                                        class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                                @elseif($inq->status === 'approved')
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-300">{{ $inq->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.secure-retirement.preview', $inq->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                        <i class="fas fa-eye"></i>
                                        <span>View</span>
                                    </a>
                                    @if ($inq->status === 'pending')
                                        <form method="POST"
                                            action="{{ route('admin.secure-retirement.approve', $inq->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-green-600 hover:bg-green-500 text-white text-xs">
                                                <i class="fas fa-check"></i>
                                                <span>Approve</span>
                                            </button>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('admin.secure-retirement.reject', $inq->id) }}"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-500 text-white text-xs">
                                                <i class="fas fa-times"></i>
                                                <span>Reject</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">No actions</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">No secure retirement inquiries
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($inquiries->hasPages())
            <div class="mt-4 flex justify-center">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection
