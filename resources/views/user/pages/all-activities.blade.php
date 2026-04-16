@include('user.components.header') 


<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
      <div class="flex h-screen antialiased text-gray-900 md:bg-white dark:bg-dark dark:text-light  mb-6">
        
        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
          <div
            x-show="isSidebarOpen"
            @click="isSidebarOpen = false"
            class="fixed inset-0 z-10 bg-[#F5A623] text-black font-bold bg-opacity-50 lg:hidden"></div>
          <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

          <!-- Mobile bottom bar -->
          @include('user.components.mobile-sidebar') 

          <!-- Left mini bar -->
          @include('user.components.desktop-sidebar') 

          @include('user.components.sidebar-pages') 
        </div>
        <div class="flex flex-col flex-1">
          
          @include('user.components.navbar-header') 

         
          @include('user.components.desktop-all-recent-activities')
          @include('user.components.mobile-all-recent-activities')


      </div>


    </div>
 @include('user.components.auth-footer') 
