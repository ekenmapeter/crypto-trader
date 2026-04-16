@include('admin.components.header') 
    @include('admin.components.image-preview')

<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
      <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light  mb-6">
        
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



        <div class="m-4">

            <h3 class="font-medium bg-indigo-300 font-bold text-black text-left px-6 p-6"><a href="{{ url()->previous() }}" class="bg-red-600 p-2 font-bold text-white pl-6 pr-3 rounded-lg">Back</a> Notification ID #{{ $previewNotification->id }}</h3>
                <div class="mt-5 w-full text-sm">
                    <div class="p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="grid items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{ $previewNotification->subject }}</h5>
                        </div>
                        <div class="flow-root">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $previewNotification->message }}
                            </p>
                            <div class="text-xs font-semibold float-right mt-4">
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-900">{{ \Carbon\Carbon::parse($previewNotification->created_at)->diffForHumans() }}</span>
                        </div>
                        </div>
                        
                              </div>
                    </div>
                </div>
        </div>   



                 
   
     
 
    </div>


 @include('admin.components.auth-footer') 



