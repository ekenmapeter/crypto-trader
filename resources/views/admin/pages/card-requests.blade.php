@extends('layouts.admin')

@section('content')
<div class="p-6" x-data="{ tab: 'all' }">
	<div class="flex items-center justify-between mb-6">
		<h2 class="text-xl font-semibold text-white">{{ $title }}</h2>
		<a href="{{ route('administrator') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
			<i class="fas fa-arrow-left"></i>
			<span>Back to Dashboard</span>
		</a>
	</div>

	@if(session('success'))
		<div class="mb-4 rounded-md border border-green-500/30 bg-green-900/30 text-green-200 px-4 py-3">
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="mb-4 rounded-md border border-red-500/30 bg-red-900/30 text-red-200 px-4 py-3">
			{{ session('error') }}
		</div>
	@endif

	<div class="mb-4 inline-flex rounded-lg bg-gray-800 p-1">
		<button @click="tab='all'" :class="tab==='all' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white'" class="px-3 py-2 text-sm rounded-md">
			All Requests <span class="ml-2 inline-flex items-center justify-center min-w-[1.5rem] px-1 rounded bg-gray-600 text-xs">{{ $cardRequests->total() }}</span>
		</button>
		<button @click="tab='pending'" :class="tab==='pending' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white'" class="px-3 py-2 text-sm rounded-md">
			Pending <span class="ml-2 inline-flex items-center justify-center min-w-[1.5rem] px-1 rounded bg-yellow-600 text-xs">{{ $cardRequests->where('status', 'pending')->count() }}</span>
		</button>
		<button @click="tab='approved'" :class="tab==='approved' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white'" class="px-3 py-2 text-sm rounded-md">
			Approved <span class="ml-2 inline-flex items-center justify-center min-w-[1.5rem] px-1 rounded bg-green-600 text-xs">{{ $cardRequests->where('status', 'approved')->count() }}</span>
		</button>
		<button @click="tab='rejected'" :class="tab==='rejected' ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white'" class="px-3 py-2 text-sm rounded-md">
			Rejected <span class="ml-2 inline-flex items-center justify-center min-w-[1.5rem] px-1 rounded bg-red-600 text-xs">{{ $cardRequests->where('status', 'rejected')->count() }}</span>
		</button>
	</div>

	<div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900">
		<table class="min-w-full divide-y divide-gray-800">
			<thead class="bg-gray-800/60">
				<tr>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">User</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Card Type</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Cardholder</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Email</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Attachment</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Submitted</th>
					<th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
				</tr>
			</thead>
			<tbody class="divide-y divide-gray-800" x-data>
				@forelse($cardRequests as $request)
					<tr x-show="tab==='all' || tab==={{ json_encode($request->status) }}">
						<td class="px-4 py-3">
							<div class="flex items-center gap-3">

								<div>
									<div class="text-sm font-medium text-gray-100">{{ $request->user->firstname }} {{ $request->user->lastname }}</div>
									<div class="text-xs text-gray-400">{{ $request->user->email }}</div>
								</div>
							</div>
						</td>
						<td class="px-4 py-3">
							<span class="inline-flex items-center rounded-full bg-blue-600/20 px-2.5 py-0.5 text-xs font-medium text-blue-300">{{ $request->card_type }}</span>
						</td>
						<td class="px-4 py-3 text-gray-300">{{ $request->cardholder_name }}</td>
						<td class="px-4 py-3 text-gray-300">{{ $request->email }}</td>
						<td class="px-4 py-3">
							@php
								$hasAttachment = !empty($request->proof_of_address_file ?? null);
							@endphp
							@if($hasAttachment)
								<span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">
									<i class="fas fa-paperclip mr-1"></i> Attached
								</span>
							@else
								<span class="inline-flex items-center rounded-full bg-gray-600/20 px-2.5 py-0.5 text-xs font-medium text-gray-300">None</span>
							@endif
						</td>
						<td class="px-4 py-3">
							@if($request->status === 'pending')
								<span class="inline-flex items-center rounded-full bg-yellow-600/20 px-2.5 py-0.5 text-xs font-medium text-yellow-300">Pending</span>
							@elseif($request->status === 'approved')
								<span class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Approved</span>
							@else
								<span class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Rejected</span>
							@endif
						</td>
						<td class="px-4 py-3 text-xs text-gray-300">{{ $request->created_at->format('M j, Y g:i A') }}</td>
						<td class="px-4 py-3">
							<div class="flex items-center gap-2" x-data="{ openApprove: false, openReject: false }">
								<a href="{{ route('admin.card-request.preview', $request->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-xs">
									<i class="fas fa-eye"></i>
									<span>Preview</span>
								</a>
								@if($request->status === 'pending')
									<button type="button" @click="openApprove = true" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-green-600 hover:bg-green-500 text-white text-xs">
										<i class="fas fa-check"></i>
										<span>Approve</span>
									</button>
									<button type="button" @click="openReject = true" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-500 text-white text-xs">
										<i class="fas fa-times"></i>
										<span>Reject</span>
									</button>
								@endif

								<!-- Approve Modal -->
								<div x-show="openApprove" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
									<div class="absolute inset-0 bg-black/60" @click="openApprove=false"></div>
									<div class="relative w-full max-w-md rounded-lg bg-gray-900 border border-gray-800 shadow-xl p-4">
										<div class="flex items-center justify-between mb-3">
											<h3 class="text-white font-semibold text-sm">Approve Card Request</h3>
											<button type="button" class="text-gray-400 hover:text-gray-200" @click="openApprove=false">
												<i class="fas fa-times"></i>
											</button>
										</div>
										<form action="{{ route('admin.card-request.approve', $request->id) }}" method="POST" class="space-y-3">
											@csrf
											@method('PATCH')
											<p class="text-gray-300 text-sm">Are you sure you want to approve this card request for <span class="font-medium text-white">{{ $request->cardholder_name }}</span>?</p>
											<label class="block">
												<span class="block text-xs text-gray-400 mb-1">Admin Notes (Optional)</span>
												<textarea name="admin_notes" rows="3" class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Add any notes about this approval..."></textarea>
											</label>
											<div class="flex items-center justify-end gap-2 pt-1">
												<button type="button" class="px-3 py-2 rounded-md text-sm bg-gray-700 hover:bg-gray-600 text-gray-100" @click="openApprove=false">Cancel</button>
												<button type="submit" class="px-3 py-2 rounded-md text-sm bg-green-600 hover:bg-green-500 text-white">Approve Request</button>
											</div>
										</form>
									</div>
								</div>

								<!-- Reject Modal -->
								<div x-show="openReject" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
									<div class="absolute inset-0 bg-black/60" @click="openReject=false"></div>
									<div class="relative w-full max-w-md rounded-lg bg-gray-900 border border-gray-800 shadow-xl p-4">
										<div class="flex items-center justify-between mb-3">
											<h3 class="text-white font-semibold text-sm">Reject Card Request</h3>
											<button type="button" class="text-gray-400 hover:text-gray-200" @click="openReject=false">
												<i class="fas fa-times"></i>
											</button>
										</div>
										<form action="{{ route('admin.card-request.reject', $request->id) }}" method="POST" class="space-y-3">
											@csrf
											@method('PATCH')
											<p class="text-gray-300 text-sm">Are you sure you want to reject this card request for <span class="font-medium text-white">{{ $request->cardholder_name }}</span>?</p>
											<label class="block">
												<span class="block text-xs text-gray-400 mb-1">Rejection Reason <span class="text-red-400">*</span></span>
												<textarea name="admin_notes" rows="3" required class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600" placeholder="Please provide a reason for rejection..."></textarea>
											</label>
											<div class="flex items-center justify-end gap-2 pt-1">
												<button type="button" class="px-3 py-2 rounded-md text-sm bg-gray-700 hover:bg-gray-600 text-gray-100" @click="openReject=false">Cancel</button>
												<button type="submit" class="px-3 py-2 rounded-md text-sm bg-red-600 hover:bg-red-500 text-white">Reject Request</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="9" class="px-4 py-6 text-center text-gray-400">No card requests found.</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		@if($cardRequests->hasPages())
			<div class="mt-4 flex justify-center">
				{{ $cardRequests->links() }}
			</div>
		@endif
</div>
@include('admin.components.qrcode_upload')
@endsection
