@include('admin.components.header')
@include('admin.components.image-preview')

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light mb-6">

        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
            <div
                x-show="isSidebarOpen"
                @click="isSidebarOpen = false"
                class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
            <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

            <!-- Mobile bottom bar -->
            @include('admin.components.mobile-sidebar')

            <!-- Left mini bar -->
            @include('admin.components.desktop-sidebar')

            @include('admin.components.sidebar-pages')
        </div>
        <div class="flex flex-col flex-1">

            @include('admin.components.navbar-header')

            <div class="max-w-4xl mx-auto px-4 py-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">User Profile #{{ $previewUser->id }}</h2>
                    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>

                <div class="rounded-lg border border-gray-800 bg-gray-900 overflow-hidden">
                    <div class="bg-gray-800/60 px-6 py-4 border-b border-gray-800">
                        <h3 class="text-lg font-medium text-white">User Information</h3>
                    </div>

                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-4">
                                <h4 class="text-md font-medium text-white mb-4">Personal Details</h4>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">First Name</span>
                                    <span class="text-white font-semibold">{{ $previewUser->firstname }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Last Name</span>
                                    <span class="text-white font-semibold">{{ $previewUser->lastname }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Username</span>
                                    <span class="text-white font-semibold">{{ $previewUser->username }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Email</span>
                                    <span class="text-white font-semibold">{{ $previewUser->email }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Mobile Number</span>
                                    <span class="text-white font-semibold">{{ $previewUser->mobile_number }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Gender</span>
                                    <span class="text-white font-semibold">{{ $previewUser->sex }}</span>
                                </div>
                            </div>

                            <!-- Banking Information -->
                            <div class="space-y-4">
                                <h4 class="text-md font-medium text-white mb-4">Banking Details</h4>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Account Number</span>
                                    <span class="text-white font-mono text-sm">{{ $previewUser->account_number }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Account Name</span>
                                    <span class="text-white font-semibold">{{ $previewUser->account_name }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Bank Name</span>
                                    <span class="text-white font-semibold">{{ $previewUser->bank_name }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Registration Date</span>
                                    <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($previewUser->created_at)->format('M d, Y') }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Member Since</span>
                                    <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($previewUser->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Wallet Balances Section -->
                        <div class="mt-10 border-t border-gray-800 pt-8">
                            <h4 class="text-lg font-medium text-white mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-wallet text-blue-500"></i>
                                Managed Asset Balances
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($userWallets as $wallet)
                                    <div class="p-5 rounded-2xl bg-gray-800/40 border border-gray-700 hover:border-gray-600 transition-all group">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-gray-700 p-2 border border-gray-600">
                                                    <img src="/images/crypto_logo/{{ $wallet->walletType->logo }}" class="w-full h-full object-contain">
                                                </div>
                                                <div>
                                                    <p class="text-xs font-black text-white leading-none mb-1">{{ $wallet->walletType->coin_name }}</p>
                                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $wallet->walletType->short_code }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-black text-blue-400">{{ (float)$wallet->amount }}</p>
                                                <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">Available Balance</p>
                                            </div>
                                        </div>

                                        {{-- Update Balance Form --}}
                                        <form action="{{ route('update-user-balance') }}" method="POST" class="flex gap-2">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $previewUser->id }}">
                                            <input type="hidden" name="wallet_type_id" value="{{ $wallet->wallet_type_id }}">
                                            <div class="relative flex-1">
                                                <label class="absolute -top-2 left-3 px-1 bg-[#1a1c23] text-[8px] font-black text-gray-500 uppercase tracking-widest">New Balance</label>
                                                <input type="number" step="0.00000001" name="amount" value="{{ (float)$wallet->amount }}" 
                                                    class="w-full bg-gray-900 border border-gray-700 rounded-xl px-4 py-2.5 text-xs font-black text-white focus:border-blue-500 focus:ring-0 outline-none transition-all">
                                            </div>
                                            <button type="submit" class="bg-blue-600 hover:bg-black text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg active:scale-95">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="col-span-full py-10 text-center bg-gray-800/20 rounded-2xl border border-dashed border-gray-700">
                                        <i class="fa-solid fa-box-open text-gray-600 text-3xl mb-2"></i>
                                        <p class="text-[12px] font-black text-gray-500 uppercase tracking-widest">No active asset wallets found for this user.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Edit User Details Section -->
                        <div id="edit-section" class="mt-10 border-t border-gray-800 pt-8">
                            <h4 class="text-xl font-black text-white mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-user-pen text-blue-500"></i>
                                Control User account
                            </h4>

                            <form action="{{ route('admin.update-user-details') }}" method="POST" class="space-y-6 bg-gray-800/20 p-8 rounded-3xl border border-gray-800">
                                @csrf
                                <input type="hidden" name="id" value="{{ $previewUser->id }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-white/40">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest ml-1 text-gray-500">First Name</label>
                                        <input type="text" name="firstname" value="{{ $previewUser->firstname }}" required
                                            class="w-full px-5 py-4 bg-gray-900 border border-gray-700 rounded-2xl text-sm font-bold text-white focus:ring-2 focus:ring-blue-500/20 transition-all outline-none" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest ml-1 text-gray-500">Last Name</label>
                                        <input type="text" name="lastname" value="{{ $previewUser->lastname }}" required
                                            class="w-full px-5 py-4 bg-gray-900 border border-gray-700 rounded-2xl text-sm font-bold text-white focus:ring-2 focus:ring-blue-500/20 transition-all outline-none" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest ml-1 text-gray-500">Username</label>
                                        <input type="text" name="username" value="{{ $previewUser->username }}" required
                                            class="w-full px-5 py-4 bg-gray-900 border border-gray-700 rounded-2xl text-sm font-bold text-white focus:ring-2 focus:ring-blue-500/20 transition-all outline-none" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest ml-1 text-gray-500">Email Address</label>
                                        <input type="email" name="email" value="{{ $previewUser->email }}" required
                                            class="w-full px-5 py-4 bg-gray-900 border border-gray-700 rounded-2xl text-sm font-bold text-white focus:ring-2 focus:ring-blue-500/20 transition-all outline-none" />
                                    </div>
                                    <div class="space-y-2 md:col-span-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest ml-1 text-gray-500">Reset Password (leave blank to keep current)</label>
                                        <div class="relative">
                                            <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-gray-600"></i>
                                            <input type="password" name="password" placeholder="••••••••"
                                                class="w-full pl-11 pr-5 py-4 bg-gray-900 border border-gray-700 rounded-2xl text-sm font-bold text-white focus:ring-2 focus:ring-blue-500/20 transition-all outline-none" />
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 flex items-center justify-between">
                                    <a href="{{ route('delete-user', $previewUser->id) }}" onclick="return confirm('Destructive Action: Are you sure?')" 
                                        class="text-xs font-black text-red-500 hover:text-red-400 transition-colors uppercase tracking-widest">
                                        Delete Forever
                                    </a>
                                    <button type="submit" class="bg-blue-600 hover:bg-black text-white px-10 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl active:scale-95">
                                        Apply Alterations
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.auth-footer')



