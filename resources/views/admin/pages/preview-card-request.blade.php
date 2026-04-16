@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
	<div class="flex items-center justify-between mb-6">
		<h2 class="text-2xl font-bold text-white">Preview Card Request</h2>
		<a href="{{ route('admin.card-requests.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm transition-colors">
			<i class="fas fa-arrow-left"></i>
			<span>Back to Requests</span>
		</a>
	</div>

	@if(session('success'))
		<div class="mb-6 rounded-lg border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">
			<i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
		</div>
	@endif
	@if(session('error'))
		<div class="mb-6 rounded-lg border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">
			<i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
		</div>
	@endif

	<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
		<!-- Left: Request + User -->
		<div class="xl:col-span-2 space-y-6">
			<!-- Request Details Card -->
			<div class="rounded-xl border border-gray-800 bg-gray-900 p-6 shadow-xl">
				<div class="flex items-center gap-3 mb-6">
					<div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-lg font-bold shadow-lg">
						<i class="fas fa-credit-card"></i>
					</div>
					<h3 class="text-lg font-semibold text-gray-200">Request Details</h3>
				</div>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Request ID</div>
						<div class="text-gray-100 font-mono font-semibold text-lg">#{{ $cardRequest->id }}</div>
					</div>
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Card Type</div>
						<div class="text-gray-100 font-semibold text-lg">{{ $cardRequest->card_type }}</div>
					</div>
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Status</div>
						<div>
							@php
								$status = $cardRequest->status;
							@endphp
							<span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium border
							{{ $status === 'pending' ? 'bg-yellow-600/20 text-yellow-300 border-yellow-500/30' : ($status === 'approved' ? 'bg-green-600/20 text-green-300 border-green-500/30' : 'bg-red-600/20 text-red-300 border-red-500/30') }}">
								@if($status === 'pending')
									<i class="fas fa-clock mr-2"></i>
								@elseif($status === 'approved')
									<i class="fas fa-check mr-2"></i>
								@else
									<i class="fas fa-times mr-2"></i>
								@endif
								{{ ucfirst($status) }}
							</span>
						</div>
					</div>
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Submitted</div>
						<div class="text-gray-100 font-semibold">{{ $cardRequest->created_at->format('M j, Y g:i A') }}</div>
					</div>
					<div class="sm:col-span-2 space-y-2">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Admin Notes</div>
						<div class="text-gray-100 whitespace-pre-line bg-gray-800/50 rounded-lg p-3 border border-gray-700">
							{{ $cardRequest->admin_notes ?: 'No admin notes available.' }}
						</div>
					</div>
					<div class="sm:col-span-2 space-y-3">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Proof of Address</div>
						@if(!empty($cardRequest->proof_of_address_file))
							<div class="relative group">
								<img src="{{ asset('storage/'.$cardRequest->proof_of_address_file) }}" alt="Proof of Address" class="rounded-lg border border-gray-700 max-w-full h-auto shadow-lg cursor-pointer transition-transform group-hover:scale-105" />
								<div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
									<button type="button" @click="$dispatch('open-image-modal', { src: '{{ $cardRequest->proof_of_address_file }}', title: 'Proof of Address - {{ $cardRequest->cardholder_name }}' })" class="text-white bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg transition-colors">
										<i class="fas fa-expand mr-2"></i>View Full Size
									</button>
								</div>
							</div>
						@else
							<div class="text-gray-500 bg-gray-800/50 rounded-lg p-8 text-center border border-gray-700">
								<i class="fas fa-file-image text-3xl mb-3 block"></i>
								<p class="text-sm">No proof of address file uploaded</p>
							</div>
						@endif
					</div>
				</div>
			</div>

			<!-- Cardholder Information Card -->
			<div class="rounded-xl border border-gray-800 bg-gray-900 p-6 shadow-xl">
				<div class="flex items-center gap-3 mb-6">
					<div class="h-10 w-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white text-lg font-bold shadow-lg">
						<i class="fas fa-user"></i>
					</div>
					<h3 class="text-lg font-semibold text-gray-200">Cardholder Information</h3>
				</div>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Cardholder Name</div>
						<div class="text-gray-100 font-semibold text-lg">{{ $cardRequest->cardholder_name }}</div>
					</div>
					<div class="space-y-1">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">Email Address</div>
						<div class="text-gray-100 font-semibold">{{ $cardRequest->email }}</div>
					</div>
					<div class="sm:col-span-2 space-y-2">
						<div class="text-gray-400 text-xs font-medium uppercase tracking-wider">User Account</div>
						<div class="flex items-center gap-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700">
							<div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
								{{ substr($cardRequest->user->firstname, 0, 1) }}{{ substr($cardRequest->user->lastname, 0, 1) }}
					</div>
					<div>
								<div class="text-gray-100 font-semibold">{{ $cardRequest->user->firstname }} {{ $cardRequest->user->lastname }}</div>
								<div class="text-gray-400 text-sm">{{ $cardRequest->user->email }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Right: Virtual Card Preview -->
		<div class="xl:col-span-1">
			<div class="sticky top-6">
				<div class="rounded-2xl bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 border border-gray-700 p-6 shadow-2xl">
					<div class="text-gray-400 text-xs font-medium uppercase tracking-wider mb-4">Virtual Card Preview</div>
					<div class="rounded-xl bg-gradient-to-br from-gray-700/80 to-gray-800/80 p-5 border border-gray-600/50">
						<div class="flex items-center justify-between mb-4">
							<div class="text-gray-200 text-sm font-semibold">{{ $cardRequest->card_type }}</div>
						<div class="text-gray-400 text-xs">{{ strtoupper(\Illuminate\Support\Str::slug($cardRequest->card_type, ' ')) }}</div>
					</div>
						<div class="mt-6 text-gray-100 tracking-widest text-xl font-mono">
						{{ ($cardRequest->status === 'approved' && $cardRequest->card_number)
							? $cardRequest->card_number
							: ($cardRequest->card_number ? preg_replace('/\d(?!\d{0,3}$)/', '•', $cardRequest->card_number) : '•••• •••• •••• ••••') }}
					</div>
						<div class="mt-6 flex items-center justify-between text-xs text-gray-300">
							<div class="space-y-1">
								<div class="text-gray-400">Cardholder</div>
								<div class="text-gray-100 font-semibold text-sm">{{ $cardRequest->cardholder_name }}</div>
							</div>
							<div class="space-y-1">
								<div class="text-gray-400">Expiry</div>
								<div class="text-gray-100 font-semibold text-sm">{{ $cardRequest->expiry ?? 'MM/YY' }}</div>
						</div>
							<div class="space-y-1">
								<div class="text-gray-400">CVV</div>
								<div class="text-gray-100 font-semibold text-sm">{{ ($cardRequest->status === 'approved' && $cardRequest->cvv) ? $cardRequest->cvv : '•••' }}</div>
						</div>
						</div>
					</div>

				@if($cardRequest->status === 'pending')
						<div class="mt-6 space-y-3">
							<div class="text-gray-400 text-xs font-medium uppercase tracking-wider text-center">Quick Actions</div>
							<div class="flex flex-col gap-2">
								<form action="{{ route('admin.card-request.approve', $cardRequest->id) }}" method="POST" class="w-full">
							@csrf
							@method('PATCH')
									<button type="submit" class="w-full px-4 py-3 rounded-lg bg-green-600 hover:bg-green-500 text-white text-sm font-semibold transition-colors shadow-lg">
										<i class="fas fa-check mr-2"></i>Approve Request
									</button>
						</form>
								<form action="{{ route('admin.card-request.reject', $cardRequest->id) }}" method="POST" class="w-full">
							@csrf
							@method('PATCH')
							<input type="hidden" name="admin_notes" value="Rejected from preview" />
									<button type="submit" class="w-full px-4 py-3 rounded-lg bg-red-600 hover:bg-red-500 text-white text-sm font-semibold transition-colors shadow-lg">
										<i class="fas fa-times mr-2"></i>Reject Request
									</button>
						</form>
							</div>
					</div>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Image Modal -->
<div x-data="{
	show: false,
	imageSrc: '',
	imageTitle: ''
}"
@open-image-modal.window="show = true; imageSrc = $event.detail.src; imageTitle = $event.detail.title"
x-show="show"
x-cloak
class="fixed inset-0 z-[60] flex items-center justify-center p-4">
	<div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="show = false"></div>
	<div class="relative max-w-5xl max-h-[90vh] bg-gray-900 rounded-xl border border-gray-700 shadow-2xl overflow-hidden">
		<div class="flex items-center justify-between p-4 border-b border-gray-700 bg-gray-800/50">
			<h3 class="text-white font-semibold text-lg">{{ $imageTitle ?? 'Image Preview' }}</h3>
			<button type="button" class="text-gray-400 hover:text-gray-200 transition-colors" @click="show = false">
				<i class="fas fa-times text-xl"></i>
			</button>
		</div>
		<div class="p-4">
			<img :src="imageSrc" :alt="imageTitle" class="max-w-full max-h-[70vh] object-contain rounded-lg mx-auto">
		</div>
	</div>
</div>
@endsection



