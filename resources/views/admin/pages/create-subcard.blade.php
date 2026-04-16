@include('admin.components.header') 

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
    <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light mb-6">
        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
            <div x-show="isSidebarOpen" @click="isSidebarOpen = false" class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
            <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

            <!-- Mobile bottom bar -->
          @include('admin.components.mobile-sidebar') 

          <!-- Left mini bar -->
          @include('admin.components.desktop-sidebar') 

          @include('admin.components.sidebar-pages') 
        </div>
        <div class="flex flex-col flex-1 pb-12">
           @include('admin.components.navbar-header') 

            <div class="w-5/6 md:w-5/6 lg:w-4/6 xl:w-3/6 mx-auto">

                <div class="mb-16 bg-white border-b shadow-lg roundedshadow-blue-500/50">
                    <div class="flex m-2">
                        <a href="{{ url()->previous() }}" class="bg-red-600 p-2 font-bold text-white pl-6 pr-3 mb-4 mt-4 rounded-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> 
                    </div>
                    
                    <div class="w-full">
                        <h3 class="font-medium text-gray-900 text-left px-6">Create New {{ $cardID->card_name }}</h3>
                             <form method="POST" action="{{ route('create-subcard') }}">
                                 @csrf
                    
                        <div class="mt-5 w-full text-sm">
                            <div class="grid md:grid-cols-1 md:gap-6">
                
                                <input
                                    type="hidden"
                                    name="card_logo"
                                    id="default-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $cardID->logo }}"
                                    readonly
                                />
                           
                                <input
                                    type="hidden"
                                    name="card_id"
                                    id="default-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $subId }}"
                                    readonly
                                />
                     
                            
                            
                                <input
                                    type="hidden"
                                    name="card_name"
                                    id="default-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $cardID->card_name }}"
                                    readonly
                                />


                            <a  class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card Country Name</p>
                                <input
                                    type="text"
                                    name="card_country_name"
                                    id="default-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value=""
                                />
                            </a>

                            <a  class="w-full border-t border-gray-100 text-gray-600 py-4 pl-6 pr-3 w-full block hover:bg-gray-100 transition duration-150">
                                <p class="font-bold text-black">Card Country Rate</p>
                                <input
                                    type="number"
                                    name="card_country_rate"
                                    id="default-input"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value=""
                                />
                            </a>
                        </div>
                        </div>
                        <div class="flex items-center gap-2 justify-center pb-6 pt-4">
                        <button type="submit" class="p-2 items-center text-center justify-center bg-indigo-700 rounded-lg text-white font-bold">Create {{ $cardID->card_name }}</button>
                    </div>
                </form>

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
 @include('admin.components.auth-footer') 
</div>
