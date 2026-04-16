@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-white">KYC Preview #{{ $verification->id }}</h2>
        <a href="{{ route('admin.kyc.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
            <i class="fas fa-arrow-left"></i>
            <span>Back to KYC List</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- KYC Information -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Verification Information</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">User:</span>
                        <span class="text-white">{{ optional($verification->user)->email ?: 'User not found' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Country:</span>
                        <span class="text-white">{{ $verification->country ?: 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Document Type:</span>
                        <span class="text-white">{{ $verification->document_type ?: 'Not specified' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">SSN Last 4:</span>
                        <span class="text-white">{{ $verification->ssn_last4 ?: 'Not provided' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($verification->status === 'pending') bg-yellow-600/20 text-yellow-300
                            @elseif($verification->status === 'approved') bg-green-600/20 text-green-300
                            @else bg-red-600/20 text-red-300 @endif">
                            {{ ucfirst($verification->status ?: 'Unknown') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Submitted:</span>
                        <span class="text-white">
                            @if($verification->submitted_at)
                                {{ $verification->submitted_at->format('M d, Y H:i') }}
                            @else
                                {{ $verification->created_at->format('M d, Y H:i') }}
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Documents -->
                <div>
                    <h4 class="text-md font-medium text-white mb-4">Uploaded Documents</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($verification->documents ?? [] as $doc)
                            <div class="border border-gray-700 rounded-lg p-4 bg-gray-800/50">
                                <div class="mb-3 text-gray-400 text-xs font-medium uppercase tracking-wider">{{ $doc->type }}</div>
                                @php $isImage = \Illuminate\Support\Str::endsWith($doc->path, ['.png','.jpg','.jpeg']); @endphp
                                @if($isImage)
                                    <img src="{{ Storage::url($doc->path) }}" alt="{{ $doc->type }}" class="w-full h-48 object-cover rounded-md">
                                @else
                                    <div class="flex items-center justify-center h-32 bg-gray-700 rounded-md">
                                        <a href="{{ Storage::url($doc->path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-sm">
                                            <i class="fas fa-file-alt"></i>
                                            <span>View Document</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-8 text-gray-400">
                                <i class="fas fa-file-upload text-2xl mb-2"></i>
                                <p>No documents uploaded</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="lg:col-span-1">
            <div class="rounded-lg border border-gray-800 bg-gray-900 p-6">
                <h3 class="text-lg font-medium text-white mb-4">Actions</h3>

                @if($verification->status !== 'approved')
                    <form method="post" action="{{ route('admin.kyc.approve', $verification->id) }}" class="mb-4">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Admin Notes (optional)</label>
                            <textarea name="admin_notes" rows="4" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('admin_notes', $verification->admin_notes) }}</textarea>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-green-600 hover:bg-green-500 text-white text-sm">
                            <i class="fas fa-check"></i>
                            <span>Approve KYC</span>
                        </button>
                    </form>
                @endif

                @if($verification->status !== 'rejected')
                    <form method="post" action="{{ route('admin.kyc.reject', $verification->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white text-sm">
                            <i class="fas fa-times"></i>
                            <span>Reject KYC</span>
                        </button>
                    </form>
                @endif

                @if($verification->status === 'approved' || $verification->status === 'rejected')
                    <div class="mt-4 p-4 bg-gray-800/50 rounded-md">
                        <p class="text-sm text-gray-400">
                            <strong>Processed:</strong>
                            @if($verification->reviewed_at)
                                {{ $verification->reviewed_at->format('M d, Y H:i') }}
                            @else
                                N/A
                            @endif
                        </p>
                        @if($verification->admin_notes)
                            <p class="text-sm text-gray-400 mt-2">
                                <strong>Notes:</strong> {{ $verification->admin_notes }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


