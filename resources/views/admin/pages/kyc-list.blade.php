@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">KYC Verifications</h2>
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
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Country</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Type</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submitted</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($verifications as $v)
                    <tr>
                        <td class="px-4 py-3 text-gray-300">{{ $v->id }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ optional($v->user)->email }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ $v->country }}</td>
                        <td class="px-4 py-3 text-gray-100">{{ $v->document_type }}</td>
                        <td class="px-4 py-3">
                            @if($v->status === 'pending')
                                <span class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
                            @elseif($v->status === 'approved')
                                <span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-300">
                            @if($v->submitted_at)
                                {{ $v->submitted_at->format('M d, Y H:i') }}
                            @else
                                {{ $v->created_at->format('M d, Y H:i') }}
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.kyc.show', $v->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                <i class="fas fa-eye"></i>
                                <span>Preview</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-400">No KYC verifications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($verifications->hasPages())
        <div class="mt-4 flex justify-center">
            {{ $verifications->links() }}
        </div>
    @endif
</div>
@endsection


