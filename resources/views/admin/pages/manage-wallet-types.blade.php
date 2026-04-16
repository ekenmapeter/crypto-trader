@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6" x-data="{ openCreate: false }">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white">{{ $title }}</h2>
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
            <div class="flex items-center justify-end p-3">
                <button type="button" @click="openCreate=true"
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white text-sm">
                    <i class="fas fa-plus"></i>
                    <span>Add Coin</span>
                </button>
            </div>
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-gray-800/60">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Logo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Coin Name
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Short
                            Code</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Status
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($walletTypes as $walletType)
                        <tr x-data="{ openEdit: false }">
                            <td class="px-4 py-3 text-gray-300">{{ $walletType->id }}</td>
                            <td class="px-4 py-3">
                                @if ($walletType->logo)
                                    <img src="/images/crypto_logo/{{ $walletType->logo }}"
                                        alt="{{ $walletType->coin_name }}" class="h-8 w-8 rounded object-cover">
                                @else
                                    <span class="text-gray-400 text-sm">No logo</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-100">{{ $walletType->coin_name }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-flex items-center rounded-full bg-blue-600/20 px-2.5 py-0.5 text-xs font-medium text-blue-300">{{ $walletType->short_code }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if ($walletType->active)
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-600/20 px-2.5 py-0.5 text-xs font-medium text-green-300">Active</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-red-600/20 px-2.5 py-0.5 text-xs font-medium text-red-300">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.wallet-types.toggle', $walletType->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to {{ $walletType->active ? 'deactivate' : 'activate' }} {{ $walletType->coin_name }}?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs {{ $walletType->active ? 'bg-yellow-600 hover:bg-yellow-500 text-white' : 'bg-green-600 hover:bg-green-500 text-white' }}">
                                            <i class="fas {{ $walletType->active ? 'fa-times' : 'fa-check' }}"></i>
                                            <span>{{ $walletType->active ? 'Deactivate' : 'Activate' }}</span>
                                        </button>
                                    </form>
                                    <button type="button" @click="openEdit=true"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white text-xs">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </button>
                                </div>

                                <!-- Edit Modal -->
                                <div x-show="openEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-black/60" @click="openEdit=false"></div>
                                    <div
                                        class="relative w-full max-w-lg rounded-lg bg-gray-900 border border-gray-800 shadow-xl p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <h3 class="text-white font-semibold text-sm">Edit {{ $walletType->coin_name }}
                                            </h3>
                                            <button type="button" class="text-gray-400 hover:text-gray-200"
                                                @click="openEdit=false"><i class="fas fa-times"></i></button>
                                        </div>
                                        <form action="{{ route('admin.wallet-types.update', $walletType->id) }}"
                                            method="POST" enctype="multipart/form-data" class="space-y-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-2 gap-4">
                                                <label class="block">
                                                    <span class="block text-xs text-gray-400 mb-1">Coin Name</span>
                                                    <input type="text" name="coin_name"
                                                        value="{{ $walletType->coin_name }}" required
                                                        class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                                                </label>
                                                <label class="block">
                                                    <span class="block text-xs text-gray-400 mb-1">Short Code</span>
                                                    <input type="text" name="short_code"
                                                        value="{{ $walletType->short_code }}" required
                                                        class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                                                </label>
                                            </div>
                                            <label class="block">
                                                <span class="block text-xs text-gray-400 mb-1">Logo</span>
                                                <input type="file" name="logo" accept="image/*"
                                                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                                            </label>
                                            <label class="block">
                                                <span class="block text-xs text-gray-400 mb-1">Status</span>
                                                <select name="active"
                                                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                                    <option value="1" {{ $walletType->active ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ !$walletType->active ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </label>
                                            <label class="block">
                                                <span class="block text-xs text-gray-400 mb-1">Payment Wallet Address</span>
                                                <input type="text" name="payment_wallet_address"
                                                    value="{{ $walletType->payment_wallet_address }}"
                                                    placeholder="Enter wallet address for payments"
                                                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                                            </label>
                                            <label class="block">
                                                <span class="block text-xs text-gray-400 mb-1">Payment QR Code</span>
                                                <input type="file" name="payment_qr_code" accept="image/*"
                                                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                                                @if ($walletType->payment_qr_code)
                                                    <div class="mt-1 flex items-center gap-2">
                                                        <img src="/images/crypto_logo/{{ $walletType->payment_qr_code }}"
                                                            alt="QR Code"
                                                            class="h-10 w-10 border border-gray-700 rounded">
                                                        <span
                                                            class="text-[10px] text-gray-500">{{ $walletType->payment_qr_code }}</span>
                                                    </div>
                                                @endif
                                            </label>
                                            <label class="block">
                                                <span class="block text-xs text-gray-400 mb-1">Payment Instructions</span>
                                                <textarea name="payment_instructions" rows="3" placeholder="Enter payment instructions"
                                                    class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">{{ $walletType->payment_instructions }}</textarea>
                                            </label>
                                            <div class="flex items-center justify-end gap-2 pt-1">
                                                <button type="button"
                                                    class="px-3 py-2 rounded-md text-sm bg-gray-700 hover:bg-gray-600 text-gray-100"
                                                    @click="openEdit=false">Close</button>
                                                <button type="submit"
                                                    class="px-3 py-2 rounded-md text-sm bg-indigo-600 hover:bg-indigo-500 text-white">Save
                                                    Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">No wallet types found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Modal -->
        <div x-show="openCreate" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60" @click="openCreate=false"></div>
            <div class="relative w-full max-w-lg rounded-lg bg-gray-900 border border-gray-800 shadow-xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-white font-semibold text-sm">Add New Coin</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-200" @click="openCreate=false"><i
                            class="fas fa-times"></i></button>
                </div>
                <form action="{{ route('admin.wallet-types.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <label class="block">
                            <span class="block text-xs text-gray-400 mb-1">Coin Name</span>
                            <input type="text" name="coin_name" required
                                class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                        </label>
                        <label class="block">
                            <span class="block text-xs text-gray-400 mb-1">Short Code</span>
                            <input type="text" name="short_code" required
                                class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                        </label>
                    </div>
                    <label class="block">
                        <span class="block text-xs text-gray-400 mb-1">Logo</span>
                        <input type="file" name="logo" accept="image/*"
                            class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                    </label>
                    <label class="block">
                        <span class="block text-xs text-gray-400 mb-1">Status</span>
                        <select name="active"
                            class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="block text-xs text-gray-400 mb-1">Payment Wallet Address</span>
                        <input type="text" name="payment_wallet_address"
                            class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                    </label>
                    <label class="block">
                        <span class="block text-xs text-gray-400 mb-1">Payment QR Code</span>
                        <input type="file" name="payment_qr_code" accept="image/*"
                            class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
                    </label>
                    <label class="block">
                        <span class="block text-xs text-gray-400 mb-1">Payment Instructions</span>
                        <textarea name="payment_instructions" rows="3"
                            class="w-full rounded-md bg-gray-800 border border-gray-700 text-gray-100 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                    </label>
                    <div class="flex items-center justify-end gap-2 pt-1">
                        <button type="button"
                            class="px-3 py-2 rounded-md text-sm bg-gray-700 hover:bg-gray-600 text-gray-100"
                            @click="openCreate=false">Close</button>
                        <button type="submit"
                            class="px-3 py-2 rounded-md text-sm bg-indigo-600 hover:bg-indigo-500 text-white">Create
                            Coin</button>
                    </div>
                </form>
            </div>
        </div>

        @if (
            $walletTypes instanceof \Illuminate\Contracts\Pagination\Paginator ||
                $walletTypes instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            <div class="mt-4 flex justify-center">
                {{ $walletTypes->links() }}
            </div>
        @endif
    </div>
@endsection
