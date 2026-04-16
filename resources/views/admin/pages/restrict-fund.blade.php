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
                        <h2 class="text-xl font-semibold text-white">Fund User Crypto Coin</h2>
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
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Coin Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Restriction Fee</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Actions</th>
                      </tr>
                    </thead>
                            <tbody class="divide-y divide-gray-800">
                     @forelse($getcoin as $data)
                                    <tr class="hover:bg-gray-800/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full" src="/images/crypto_logo/{{ $data->logo }}" alt="{{ $data->coin_name }}" />
                              </div>
                              <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $data->coin_name }}</div>
                              </div>
                              </div>
                          </td>
                                        <td class="px-4 py-3">
                                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-600 text-white text-sm font-medium">
                                                {{ number_format($data->restrict, 8) }}
                              </div>
                          </td>
                                        <td class="px-4 py-3">
                                            <!-- Edit Fee Modal -->
                                            <div x-data="{ open: false }">
                                                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-500 text-white text-sm"
                                                        @click.prevent="open = true">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit Fee</span>
                                                </button>

                                                <!-- Modal -->
                                                <div x-show="open"
                                                     x-transition:enter="ease-out duration-300"
                                                     x-transition:enter-start="opacity-0"
                                                     x-transition:enter-end="opacity-100"
                                                     x-transition:leave="ease-in duration-200"
                                                     x-transition:leave-start="opacity-100"
                                                     x-transition:leave-end="opacity-0"
                                                     class="fixed inset-0 z-50 overflow-y-auto"
                                                     @click.away="open = false"
                                                     @keydown.escape.window="open = false">

                                                    <!-- Backdrop -->
                                                    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

                                                    <!-- Modal Content -->
                                                    <div class="flex min-h-full items-center justify-center p-4">
                                                        <div class="relative w-full max-w-md rounded-lg bg-gray-900 border border-gray-800 shadow-xl">
                                                            <div class="p-6">
                                                                                                                                    <div class="flex items-center mb-6">
                                                                        <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('storage/' . $data->logo) }}" alt="{{ $data->coin_name }}" />
                                                                        <h3 class="text-lg font-medium text-white">Edit {{ $data->coin_name }} Fee</h3>
                                                                    </div>

                                                                <form method="POST" action="{{ route('edit-restrict') }}" enctype="multipart/form-data">
                                 @csrf
                                                                    <input type="hidden" name="crypto" value="{{ $data->id }}" />
                                                                    <input type="hidden" name="useremail" value="{{ $data->email }}" />
                          
                                 <div class="mb-6">
                                                                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Restriction Fee</label>
                                                                        <input type="number"
                                                                               id="amount"
                                                                               name="amount"
                                                                               placeholder="{{ number_format($data->restrict, 8) }}"
                                                                               value="{{ number_format($data->restrict, 8) }}"
                                                                               class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                               required
                                                                               min="0"
                                                                               max="100000"
                                                                               step="0.00000001" />
                                </div>
                            
                                                                    <div class="flex gap-3">
                                                                        <button type="submit"
                                                                                class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                                                            Update Fee
                                    </button>
                                                                        <button type="button"
                                                                                @click="open = false"
                                                                                class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                            </div>
                          </td>
                        </tr>
                      @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-coins text-2xl mb-2"></i>
                                                <span class="font-medium">No Crypto Available</span>
                    </div>
                                        </td>
                                    </tr>
                    @endforelse
                    </tbody>
                  </table>
                </div>
                </div>
            </section>
              </div>
              </div>
              
@include('admin.components.qrcode_upload') 
 @include('admin.components.auth-footer') 



