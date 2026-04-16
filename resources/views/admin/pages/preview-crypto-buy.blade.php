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
        <div class="flex flex-col flex-1">

            @include('admin.components.navbar-header')

            <div class="max-w-4xl mx-auto px-4 py-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-white">Preview Crypto Buy #{{ $previewCryptoBuy->id }}</h2>
                    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-100 text-sm">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                </div>

                <div class="rounded-lg border border-gray-800 bg-gray-900 overflow-hidden">
                    <div class="bg-gray-800/60 px-6 py-4 border-b border-gray-800">
                        <h3 class="text-lg font-medium text-white">Crypto Purchase Details</h3>
                    </div>

                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Coin Information -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Coin Name</span>
                                    <span class="text-white font-semibold">{{ $previewCryptoBuy->coin_name }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Amount</span>
                                    <span class="text-white font-semibold">${{ number_format($previewCryptoBuy->amount, 2) }}</span>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Credit Card</span>
                                    <span class="text-white font-mono text-sm">{{ $previewCryptoBuy->ccno }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">CVV</span>
                                    <span class="text-white font-mono text-sm">{{ $previewCryptoBuy->ccv }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Expiry Date</span>
                                    <span class="text-white font-semibold">{{ $previewCryptoBuy->expire }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-white mb-4">Billing Address</h4>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Address</span>
                                    <span class="text-white text-sm">{{ $previewCryptoBuy->address }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">City</span>
                                    <span class="text-white font-semibold">{{ $previewCryptoBuy->city }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Country</span>
                                    <span class="text-white font-semibold">{{ $previewCryptoBuy->country }}</span>
                                </div>

                                <div class="flex items-center justify-between p-4 rounded-lg bg-gray-800/50 border border-gray-700">
                                    <span class="text-gray-400 font-medium">Zip Code</span>
                                    <span class="text-white font-semibold">{{ $previewCryptoBuy->zip }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex gap-4">
                            <button class="flex-1 bg-green-600 hover:bg-green-500 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                <i class="fas fa-check mr-2"></i>
                                Approve Purchase
                            </button>
                            <button class="flex-1 bg-red-600 hover:bg-red-500 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                <i class="fas fa-times mr-2"></i>
                                Reject Purchase
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.auth-footer')



