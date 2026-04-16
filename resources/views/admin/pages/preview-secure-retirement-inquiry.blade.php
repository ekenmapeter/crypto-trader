@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">Secure Retirement Inquiry Preview #{{ $inquiry->id }}</h2>
        <a href="{{ route('admin.secure-retirement.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Inquiries</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Inquiry Information -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Inquiry Information</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">User:</span>
                        <span class="text-white">{{ optional($inquiry->user)->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Full Name:</span>
                        <span class="text-white">{{ $inquiry->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Email:</span>
                        <span class="text-white">{{ $inquiry->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Phone:</span>
                        <span class="text-white">{{ $inquiry->phone ?: '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Account Type:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-600/20 text-blue-300">
                            {{ $inquiry->account_type }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Current Balance:</span>
                        <span class="text-white">{{ $inquiry->current_balance ? '$'.number_format($inquiry->current_balance, 2) : '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Rollover Amount:</span>
                        <span class="text-white">{{ $inquiry->rollover_amount ? '$'.number_format($inquiry->rollover_amount, 2) : '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($inquiry->status === 'pending') bg-yellow-600/20 text-yellow-300
                            @elseif($inquiry->status === 'approved') bg-green-600/20 text-green-300
                            @else bg-red-600/20 text-red-300 @endif">
                            {{ ucfirst($inquiry->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submitted:</span>
                        <span class="text-white">{{ $inquiry->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($inquiry->processed_at)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Processed:</span>
                        <span class="text-white">{{ $inquiry->processed_at->format('M d, Y H:i') }}</span>
                    </div>
                    @endif
                </div>

                <!-- Additional Details with Copy Functionality -->
                <div>
                    <h4 class="text-md font-medium text-white mb-4">Additional Details</h4>
                    <div class="space-y-4">
                        @if($inquiry->employer_name)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Employer Name</span>
                                <button onclick="copyToClipboard('employer-name')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="employer-name" class="text-white text-sm bg-gray-700 p-2 rounded">{{ $inquiry->employer_name }}</div>
                        </div>
                        @endif

                        @if($inquiry->employer_phone)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Employer Phone</span>
                                <button onclick="copyToClipboard('employer-phone')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="employer-phone" class="text-white text-sm bg-gray-700 p-2 rounded">{{ $inquiry->employer_phone }}</div>
                        </div>
                        @endif

                        @if($inquiry->employer_email)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Employer Email</span>
                                <button onclick="copyToClipboard('employer-email')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="employer-email" class="text-white text-sm bg-gray-700 p-2 rounded">{{ $inquiry->employer_email }}</div>
                        </div>
                        @endif

                        @if($inquiry->additional_notes)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Additional Notes</span>
                                <button onclick="copyToClipboard('additional-notes')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="additional-notes" class="text-white text-sm bg-gray-700 p-2 rounded whitespace-pre-wrap">{{ $inquiry->additional_notes }}</div>
                        </div>
                        @endif

                        @if($inquiry->preferred_contact_method)
                        <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm font-medium">Preferred Contact Method</span>
                                <button onclick="copyToClipboard('contact-method')" class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
                                    <i class="fas fa-copy"></i>
                                    <span>Copy</span>
                                </button>
                            </div>
                            <div id="contact-method" class="text-white text-sm bg-gray-700 p-2 rounded">{{ $inquiry->preferred_contact_method }}</div>
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

                @if($inquiry->status !== 'approved')
                    <form method="post" action="{{ route('admin.secure-retirement.approve', $inquiry->id) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                            <i class="fas fa-check"></i>
                            <span>Approve Inquiry</span>
                        </button>
                    </form>
                @endif

                @if($inquiry->status !== 'rejected')
                    <form method="post" action="{{ route('admin.secure-retirement.reject', $inquiry->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                            <i class="fas fa-times"></i>
                            <span>Reject Inquiry</span>
                        </button>
                    </form>
                @endif

                @if($inquiry->status === 'approved')
                    <div class="mt-4 p-4 bg-green-900/30 border border-green-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-green-300 mb-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-medium">Inquiry Approved</span>
                        </div>
                        <p class="text-sm text-green-200">
                            This secure retirement inquiry has been approved.
                        </p>
                    </div>
                @endif

                @if($inquiry->status === 'rejected')
                    <div class="mt-4 p-4 bg-red-900/30 border border-red-500/30 rounded-md">
                        <div class="flex items-center gap-2 text-red-300 mb-2">
                            <i class="fas fa-times-circle"></i>
                            <span class="font-medium">Inquiry Rejected</span>
                        </div>
                        <p class="text-sm text-red-200">
                            This secure retirement inquiry has been rejected.
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
