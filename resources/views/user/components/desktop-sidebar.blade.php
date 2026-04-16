<nav aria-label="Options" class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl">
    <!-- Logo -->
    <div class="flex-shrink-0 py-4">
        <a href="{{ route('user') }}"> 
            <img class="w-18 h-auto" src="/images/logo.png" alt="" />
        </a>
    </div>
    <div class="flex flex-col items-center flex-1 p-2 space-y-4">
        <!-- Menu button -->
        <button
            @click="(isSidebarOpen &amp;&amp; currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
            class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2 text-gray-500 bg-white"
            :class="(isSidebarOpen &amp;&amp; currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
        >
            <span class="sr-only">Toggle sidebar</span>
            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
        </button>
       
        <!-- Notifications button -->
        <button
            @click="(isSidebarOpen &amp;&amp; currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
            class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2 text-gray-500 bg-white"
            :class="(isSidebarOpen &amp;&amp; currentSidebarTab == 'notificationsTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
        >

            <span class="sr-only">Toggle notifications panel</span>
            <div class="relative">
            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                ></path>
            </svg>
          
            
            @if ($notificationSidebar === 0)

            <span class="hidden top-0 left-7 absolute  w-3.5 h-3.5 bg-white border-2 border-white dark:border-gray-800 rounded-full"></span>
                
                    
        
                @else
         
                    <span class="top-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
        
            
             @endif
       
           
            </div>
        </button>
    </div>

    <!-- User avatar -->
    <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
        <button
            @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
            class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
        >
            
        </button>
        <div
            x-show="isOpen"
            @click.away="isOpen = false"
            @keydown.escape="isOpen = false"
            x-ref="userMenu"
            tabindex="-1"
            class="absolute w-48 py-1 mt-2 origin-bottom-left bg-red-600 rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-label="user menu"
            style="display: none;"
        >
            

            <a
                href="/"
                class="block px-4 py-2 text-sm text-white hover:text-black hover:font-extrabold"
            >
                Sign out
            </a>
            
        </div>
    </div>
</nav>
