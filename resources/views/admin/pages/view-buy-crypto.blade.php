@include('admin.components.header')

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
        <div class="w-full">

            @include('admin.components.navbar-header')

            <section>
                <div class="max-w-7xl mx-auto px-4 py-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-white">View Buy Crypto</h2>
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
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Coin</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @forelse($view_buy_crypto as $data)
                                    <tr class="hover:bg-gray-800/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img
                                                        class="w-10 h-10 rounded-full"
                                                        src="/images/category_logo/{{ $data->logo }}"
                                                        alt="{{ $data->coin_name }}"
                                                    />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $data->coin_name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="/preview-crypto-buy/{{ $data->id }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-sm">
                                                <i class="fas fa-eye"></i>
                                                <span>Preview Buy Crypto Card</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-6 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-coins text-2xl mb-2"></i>
                                                <span class="font-medium">No Buy Crypto Available</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($view_buy_crypto->hasPages())
                        <div class="mt-4 flex justify-center">
                            {{ $view_buy_crypto->links() }}
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    @include('admin.components.auth-footer')
</div>



